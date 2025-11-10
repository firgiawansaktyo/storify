document.addEventListener('DOMContentLoaded', () => {
    const metaEl = document.getElementById('couple-update-data');
    if (!metaEl) return;

    const path = metaEl.dataset.path;
    const updateRoute = metaEl.dataset.updateRoute;
    const indexRoute = metaEl.dataset.indexRoute;

    let brideImagePath = metaEl.dataset.brideImage || '';
    let groomImagePath = metaEl.dataset.groomImage || '';

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

                        // Update preview image if available
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

    // Bride image upload
    setupFileUpload(
        'bride_image',
        'progressBarBride',
        'statusBride',
        'bride_image',
        function (uploadedPath) {
            brideImagePath = uploadedPath;
        },
        'brideImagePreview'
    );

    // Groom image upload
    setupFileUpload(
        'groom_image',
        'progressBarGroom',
        'statusGroom',
        'groom_image',
        function (uploadedPath) {
            groomImagePath = uploadedPath;
        },
        'groomImagePreview'
    );

    const saveButton = document.getElementById('saveButton');
    if (!saveButton) return;

    saveButton.addEventListener('click', function () {
        errorBox.classList.add('d-none');
        successBox.classList.add('d-none');

        const coupleData = {
            bride_name: document.getElementById('bride_name').value.trim(),
            father_bride_name: document.getElementById('father_bride_name').value.trim(),
            mother_bride_name: document.getElementById('mother_bride_name').value.trim(),
            groom_name: document.getElementById('groom_name').value.trim(),
            father_groom_name: document.getElementById('father_groom_name').value.trim(),
            mother_groom_name: document.getElementById('mother_groom_name').value.trim(),
            bride_image: brideImagePath || null,
            groom_image: groomImagePath || null,
        };

        if (
            !coupleData.bride_name ||
            !coupleData.father_bride_name ||
            !coupleData.mother_bride_name ||
            !coupleData.groom_name ||
            !coupleData.father_groom_name ||
            !coupleData.mother_groom_name
        ) {
            errorBox.classList.remove('d-none');
            errorBox.textContent = 'Please fill in all required fields.';
            return;
        }

        axios.put(updateRoute, coupleData)
            .then(function () {
                successBox.classList.remove('d-none');
                successBox.textContent = 'Couple updated successfully!';
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
                    errorBox.textContent = 'Error updating couple.';
                }
            });
    });
});
