@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Gift</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Gift Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Bank</label>
        <select id="bank_id" class="form-control" required>
          <option value="">-- Select Bank --</option>
          @foreach($banks as $bank)
            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label class="text-white">Account Number</label>
        <input type="text" id="account_number" class="form-control" maxlength="50" required>
      </div>

      <div class="form-group">
        <label class="text-white">Account Holder</label>
        <input type="text" id="account_holder" class="form-control" maxlength="100" required>
      </div>

      <hr class="bg-white">

      <!-- QRIS Image Upload -->
      <div class="form-group">
        <label class="text-white">QRIS Image</label>
        <input id="qris_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarQrisImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusQrisImage"></p>
      </div>

      <a href="{{ route('gifts.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<script>
let path = @json($path);
let qrisImagePath = '';

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

// Setup QRIS input
setupFileUpload('qris_image', 'progressBarQrisImage', 'statusQrisImage', 'qris_image', function(path) {
    qrisImagePath = path;
});

// Save button handler
document.getElementById('saveButton').addEventListener('click', function() {

    // Clear alerts
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    // Collect all fields
    const giftData = {
        bank_id: document.getElementById('bank_id').value,
        account_number: document.getElementById('account_number').value.trim(),
        account_holder: document.getElementById('account_holder').value.trim(),
        qris_image: qrisImagePath || null,
    };

    // Check required fields
    if (!giftData.bank_id || !giftData.account_number || !giftData.account_holder) {
        document.getElementById('errorBox').classList.remove('d-none');
        document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
        return;
    }

    axios.post('{{ route('gifts.store') }}', giftData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Gift created successfully!';
            setTimeout(() => window.location.href = "{{ route('gifts.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error creating gift.';
            }
        });
});
</script>
@endsection
