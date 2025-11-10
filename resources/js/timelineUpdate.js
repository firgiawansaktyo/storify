document.addEventListener('DOMContentLoaded', () => {
    const metaEl = document.getElementById('timeline-update-data');
    if (!metaEl) return;

    const path = metaEl.dataset.path;
    const updateRoute = metaEl.dataset.updateRoute;
    const indexRoute = metaEl.dataset.indexRoute;

    let vowPath = metaEl.dataset.vowImage || '';
    let receptionPath = metaEl.dataset.receptionImage || '';

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

    // Vow image upload
    setupFileUpload(
        'wedding_vow_image',
        'progressBarVow',
        'statusVow',
        'wedding_vow_image',
        function (uploadedPath) {
            vowPath = uploadedPath;
        },
        'vowImagePreview'
    );

    // Reception image upload
    setupFileUpload(
        'wedding_reception_image',
        'progressBarReception',
        'statusReception',
        'wedding_reception_image',
        function (uploadedPath) {
            receptionPath = uploadedPath;
        },
        'receptionImagePreview'
    );

    const saveButton = document.getElementById('saveButton');
    if (!saveButton) return;

    saveButton.addEventListener('click', function () {
        errorBox.classList.add('d-none');
        successBox.classList.add('d-none');

        const timelineData = {
            wedding_vow_date: document.getElementById('wedding_vow_date').value.trim(),
            wedding_vow_start_time: document.getElementById('wedding_vow_start_time').value.trim(),
            wedding_vow_end_time: document.getElementById('wedding_vow_end_time').value.trim(),
            wedding_vow_location: document.getElementById('wedding_vow_location').value.trim(),
            wedding_vow_address: document.getElementById('wedding_vow_address').value.trim(),
            wedding_vow_location_link: document.getElementById('wedding_vow_location_link').value.trim(),
            wedding_vow_iframe: document.getElementById('wedding_vow_iframe').value.trim(),

            wedding_reception_date: document.getElementById('wedding_reception_date').value.trim(),
            wedding_reception_start_time: document.getElementById('wedding_reception_start_time').value.trim(),
            wedding_reception_end_time: document.getElementById('wedding_reception_end_time').value.trim(),
            wedding_reception_location: document.getElementById('wedding_reception_location').value.trim(),
            wedding_reception_address: document.getElementById('wedding_reception_address').value.trim(),
            wedding_reception_location_link: document.getElementById('wedding_reception_location_link').value.trim(),
            wedding_reception_iframe: document.getElementById('wedding_reception_iframe').value.trim(),

            wedding_vow_image: vowPath || null,
            wedding_reception_image: receptionPath || null,
        };

        if (
            !timelineData.wedding_vow_date ||
            !timelineData.wedding_vow_start_time ||
            !timelineData.wedding_vow_end_time ||
            !timelineData.wedding_vow_location ||
            !timelineData.wedding_vow_address ||
            !timelineData.wedding_vow_location_link ||
            !timelineData.wedding_vow_iframe ||
            !timelineData.wedding_reception_date ||
            !timelineData.wedding_reception_start_time ||
            !timelineData.wedding_reception_end_time ||
            !timelineData.wedding_reception_location ||
            !timelineData.wedding_reception_address ||
            !timelineData.wedding_reception_location_link ||
            !timelineData.wedding_reception_iframe
        ) {
            errorBox.classList.remove('d-none');
            errorBox.textContent = 'Please fill in all required fields.';
            return;
        }

        axios.put(updateRoute, timelineData)
            .then(function () {
                successBox.classList.remove('d-none');
                successBox.textContent = 'Timeline updated successfully!';
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
                    errorBox.textContent = 'Error updating timeline.';
                }
            });
    });
});
