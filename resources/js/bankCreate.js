let path = window.path;
let bankImagePath = '';

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

setupFileUpload('bank_image', 'progressBarBankImage', 'statusBankImage', 'bank_image', function(path) {
    bankImagePath = path;
});

document.getElementById('saveButton').addEventListener('click', function() {

    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    const bankData = {
        name: document.getElementById('name').value.trim(),
        bank_image: bankImagePath || null,
    };

    if (!bankData.name)
        {
        document.getElementById('errorBox').classList.remove('d-none');
        document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
        return;
    }

    axios.post(window.bankStoreRoute, bankData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Bank created successfully!';
            setTimeout(() => window.location.href = "{{ route('banks.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error creating bank.';
            }
        });
});