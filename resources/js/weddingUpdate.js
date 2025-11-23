document.addEventListener('DOMContentLoaded', () => {
    const metaEl = document.getElementById('wedding-update-data');
    if (!metaEl) return;

    const path = metaEl.dataset.path;
    const updateRoute = metaEl.dataset.updateRoute;
    const indexRoute = metaEl.dataset.indexRoute;

    let weddingImagePath = metaEl.dataset.weddingImage || '';
    let weddingVideoPath = metaEl.dataset.weddingVideo || '';
    let weddingAudioPath = metaEl.dataset.weddingAudio || '';
    let weddingLandingPath = metaEl.dataset.weddingLandingImage || '';
    let weddingHotNewsPath = metaEl.dataset.weddingHotnewsImage || '';

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

            status.textContent = 'Preparing upload...';
            progressBar.classList.remove('d-none');
            progressBar.value = 0;

            axios.post(`/admin/upload/${path}`, {
                [`${fieldName}_filename`]: file.name,
                [`${fieldName}_content_type`]: file.type || 'application/octet-stream',
            })
            .then(function (res) {
                if (!res.data.paths || !res.data.paths[fieldName]) {
                    status.textContent = 'Error: upload info not returned.';
                    throw new Error('No upload info for field ' + fieldName);
                }

                const info = res.data.paths[fieldName];

                status.textContent = 'Uploading...';

                return axios.put(info.upload_url, file, {
                    headers: {
                        'Content-Type': file.type || 'application/octet-stream',
                    },
                    onUploadProgress: function (e) {
                        if (e.total) {
                            const percent = Math.round((e.loaded * 100) / e.total);
                            progressBar.value = percent;
                            status.textContent = `Uploading: ${percent}%`;
                        }
                    },
                }).then(() => info);
            })
            .then(function (info) {
                storeCallback(info);
                status.textContent = 'Upload complete!';

                if (preview && info.public_url) {
                    preview.src = info.public_url;
                }
            })
            .catch(function () {
                status.textContent = 'Error during upload.';
            });
        });
    }

    // Wedding image
    setupFileUpload(
        'wedding_image',
        'progressBarWeddingImage',
        'statusWeddingImage',
        'wedding_image',
        function (uploadedInfo) {
            weddingImagePath = uploadedInfo.public_url;
        },
        'weddingImagePreview'
    );

    // Wedding video
    setupFileUpload(
        'wedding_video',
        'progressBarWeddingVideo',
        'statusWeddingVideo',
        'wedding_video',
        function (uploadedInfo) {
            weddingVideoPath = uploadedInfo.public_url;
        },
        'weddingVideoPreview'
    );

    // Wedding audio
    setupFileUpload(
        'wedding_audio',
        'progressBarWeddingAudio',
        'statusWeddingAudio',
        'wedding_audio',
        function (uploadedInfo) {
            weddingAudioPath = uploadedInfo.public_url;
        },
        'weddingAudioPreview'
    );

    // Wedding landing image
    setupFileUpload(
        'wedding_landing_image',
        'progressBarLandingImage',
        'statusLandingImage',
        'wedding_landing_image',
        function (uploadedInfo) {
            weddingLandingPath = uploadedInfo.public_url;
        },
        'weddingLandingPreview'
    );

    // Wedding hot news image
    setupFileUpload(
        'wedding_hotnews_image',
        'progressBarHotNewsImage',
        'statusHotNewsImage',
        'wedding_hotnews_image',
        function (uploadedInfo) {
            weddingHotNewsPath = uploadedInfo.public_url;
        },
        'weddingHotNewsPreview'
    );

    const saveButton = document.getElementById('saveButton');
    if (!saveButton) return;

    saveButton.addEventListener('click', function () {
        errorBox.classList.add('d-none');
        successBox.classList.add('d-none');

        const weddingData = {
            wedding_image: weddingImagePath || null,
            wedding_title: document.getElementById('wedding_title').value.trim(),
            wedding_sub_title: document.getElementById('wedding_sub_title').value.trim(),
            wedding_description: document.getElementById('wedding_description').value.trim(),
            wedding_prayer_verse: document.getElementById('wedding_prayer_verse').value.trim(),
            wedding_video: weddingVideoPath || null,
            wedding_audio: weddingAudioPath || null,
            wedding_message_template: document.getElementById('wedding_message_template').value.trim(),
            wedding_landing_image: weddingLandingPath || null,
            wedding_landing_title: document.getElementById('wedding_landing_title').value.trim(),
            wedding_hotnews_image: weddingHotNewsPath || null,
            wedding_hotnews_description: document.getElementById('wedding_hotnews_description').value.trim(),
        };

        if (
            !weddingData.wedding_title ||
            !weddingData.wedding_sub_title ||
            !weddingData.wedding_description ||
            !weddingData.wedding_prayer_verse ||
            !weddingData.wedding_message_template ||
            !weddingData.wedding_landing_title ||
            !weddingData.wedding_hotnews_description
        ) {
            errorBox.classList.remove('d-none');
            errorBox.textContent = 'Please fill in all required fields.';
            return;
        }

        axios.put(updateRoute, weddingData)
            .then(function () {
                successBox.classList.remove('d-none');
                successBox.textContent = 'Wedding Invitation updated successfully!';
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
                    errorBox.textContent = 'Error updating wedding invitation.';
                }
            });
    });
});
