document.addEventListener('DOMContentLoaded', () => {
    const metaEl = document.getElementById('bank-update-data');
    if (!metaEl) return;

    const path = metaEl.dataset.path;
    const updateRoute = metaEl.dataset.updateRoute;
    const indexRoute = metaEl.dataset.indexRoute;
    const initialBankImage = metaEl.dataset.bankImage || '';

    let bankImagePath = initialBankImage;

    const errorBox = document.getElementById('errorBox');
    const successBox = document.getElementById('successBox');

    function setupFileUpload(inputId, progressId, statusId, fieldName, storeCallback) {
        const input = document.getElementById(inputId);
        const progressBar = document.getElementById(progressId);
        const status = document.getElementById(statusId);
        if (!input) return;

        input.addEventListener('change', function () {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append(fieldName, file);

            status.textContent = 'Starting upload...';
            progressBar.classList.remove('d-none');
            progressBar.value = 0;

            axios.post(`/admin/upload/${path}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress: function (e) {
                    const percent = Math.round((e.loaded * 100) / e.total);
                    progressBar.value = percent;
                    status.textContent = `Uploading: ${percent}%`;
                },
            })
                .then(function (res) {
                    if (res.data.paths && res.data.paths[fieldName]) {
                        const uploadedPath = res.data.paths[fieldName];
                        storeCallback(uploadedPath);
                        status.textContent = 'Upload complete!';

                        // Update preview if present
                        const preview = document.getElementById('imagePreview');
                        if (preview && uploadedPath) {
                            preview.src = `/storage/${uploadedPath}`;
                        }
                    } else {
                        status.textContent = 'Error: path not returned.';
                    }
                })
                .catch(function () {
                    status.textContent = 'Error during upload.';
                });
        });
    }

    setupFileUpload(
        'bank_image',
        'progressBarBankImage',
        'statusBankImage',
        'bank_image',
        function (uploadedPath) {
            bankImagePath = uploadedPath;
        },
    );

    const saveButton = document.getElementById('saveButton');
    if (!saveButton) return;

    saveButton.addEventListener('click', function () {
        errorBox.classList.add('d-none');
        successBox.classList.add('d-none');

        const name = document.getElementById('name').value.trim();

        const bankData = {
            name: name,
            bank_image: bankImagePath || null,
        };

        if (!name) {
            errorBox.classList.remove('d-none');
            errorBox.textContent = 'Please fill in all required fields.';
            return;
        }

        axios.put(updateRoute, bankData)
            .then(function () {
                successBox.classList.remove('d-none');
                successBox.textContent = 'Bank updated successfully!';
                setTimeout(() => {
                    window.location.href = indexRoute;
                }, 500);
            })
            .catch(function (error) {
                errorBox.classList.remove('d-none');
                if (error.response && error.response.data && error.response.data.errors) {
                    const errors = Object.values(error.response.data.errors).flat();
                    errorBox.innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
                } else {
                    errorBox.textContent = 'Error updating bank.';
                }
            });
    });
});
