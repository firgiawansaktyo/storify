document.addEventListener('DOMContentLoaded', () => {
    const metaEl = document.getElementById('gift-update-data');
    if (!metaEl) return;

    const path = metaEl.dataset.path;
    const updateRoute = metaEl.dataset.updateRoute;
    const indexRoute = metaEl.dataset.indexRoute;

    let qrisImagePath = metaEl.dataset.qrisImage || '';

    const errorBox = document.getElementById('errorBox');
    const successBox = document.getElementById('successBox');

    function setupFileUpload(inputId, progressId, statusId, fieldName, storeCallback, previewId) {
        const input = document.getElementById(inputId);
        const progressBar = document.getElementById(progressId);
        const status = document.getElementById(statusId);
        const preview = previewId ? document.getElementById(previewId) : null;

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

    // QRIS image upload
    setupFileUpload(
        'qris_image',
        'progressBarQrisImage',
        'statusQrisImage',
        'qris_image',
        function (uploadedPath) {
            qrisImagePath = uploadedPath;
        },
        'qrisImagePreview'
    );

    const saveButton = document.getElementById('saveButton');
    if (!saveButton) return;

    saveButton.addEventListener('click', function () {
        errorBox.classList.add('d-none');
        successBox.classList.add('d-none');

        const payload = {
            bank_id: document.getElementById('bank_id').value,
            account_number: document.getElementById('account_number').value.trim(),
            account_holder: document.getElementById('account_holder').value.trim(),
            qris_image: qrisImagePath || null,
        };

        if (!payload.bank_id || !payload.account_number || !payload.account_holder) {
            errorBox.classList.remove('d-none');
            errorBox.textContent = 'Please fill in all required fields.';
            return;
        }

        axios.put(updateRoute, payload)
            .then(function () {
                successBox.classList.remove('d-none');
                successBox.textContent = 'Gift updated successfully!';
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
                    errorBox.textContent = 'Error updating gift.';
                }
            });
    });
});
