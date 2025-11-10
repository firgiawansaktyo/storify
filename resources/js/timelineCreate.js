let path = window.path;
let vowPath = '';
let receptionPath = '';

function setupFileUpload(inputId, progressId, statusId, fieldName, storeCallback) {
    const input = document.getElementById(inputId);
    const progressBar = document.getElementById(progressId);
    const status = document.getElementById(statusId);

    input.addEventListener('change', function() {
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
            }
        })
        .then(function(res) {
            if (res.data.paths && res.data.paths[fieldName]) {
                storeCallback(res.data.paths[fieldName]);
                status.textContent = 'Upload complete!';
            } else {
                status.textContent = 'Error: path not returned.';
            }
        })
        .catch(function(err) {
            status.textContent = 'Error during upload.';
        });
    });
}

setupFileUpload('wedding_vow_image', 'progressBarVow', 'statusVow', 'wedding_vow_image', function(path) {
    vowPath = path;
});
setupFileUpload('wedding_reception_image', 'progressBarReception', 'statusReception', 'wedding_reception_image', function(path) {
    receptionPath = path;
});

document.getElementById('saveButton').addEventListener('click', function() {

    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

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
        wedding_reception_image: receptionPath || null
    };

    if (!timelineData.wedding_vow_date ||
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
        !timelineData.wedding_reception_iframe)
        {
        document.getElementById('errorBox').classList.remove('d-none');
        document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
        return;
    }

    axios.post(timelineStoreRoute, timelineData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Timeline created successfully!';
            setTimeout(() => window.location.href = "{{ route('timelines.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error creating timeline.';
            }
        });
});