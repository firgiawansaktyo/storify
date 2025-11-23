document.addEventListener('DOMContentLoaded', () => {
    const metaEl = document.getElementById('album-create-data');
    if (!metaEl) return;

    const path = metaEl.dataset.path;
    const storeRoute = metaEl.dataset.storeRoute;
    const indexRoute = metaEl.dataset.indexRoute;

    let albumImagePath = '';

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
                        'Cache-Control': 'public, max-age=31536000, immutable',
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
            })
            .catch(function (err) {
                console.error(err);
                status.textContent = 'Error during upload.';
            });
        });
    }

    setupFileUpload(
        'wedding_album_image',
        'progressBarAlbumImage',
        'statusAlbumImage',
        'wedding_album_image',
        function (uploadedInfo) {
            albumImagePath = uploadedInfo.public_url;
        },
    );

    const saveButton = document.getElementById('saveButton');
    if (!saveButton) return;

    saveButton.addEventListener('click', function () {
        errorBox.classList.add('d-none');
        successBox.classList.add('d-none');

        const title = document.getElementById('wedding_album_title').value.trim();
        const description = document.getElementById('wedding_album_description').value.trim();

        const albumData = {
            wedding_album_title: title,
            wedding_album_description: description,
            wedding_album_image: albumImagePath || null,
        };

        if (!title || !description) {
            errorBox.classList.remove('d-none');
            errorBox.textContent = 'Please fill in all required fields.';
            return;
        }

        axios.post(storeRoute, albumData)
            .then(function () {
                successBox.classList.remove('d-none');
                successBox.textContent = 'Album Image created successfully!';
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
                    errorBox.textContent = 'Error creating album image.';
                }
            });
    });
});
