@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Couple</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Couple Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Bride Name</label>
        <input type="text" id="bride_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Father's Bride Name</label>
        <input type="text" id="father_bride_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Mother's Bride Name</label>
        <input type="text" id="mother_bride_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Groom Name</label>
        <input type="text" id="groom_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Father's Groom Name</label>
        <input type="text" id="father_groom_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Mother's Groom Name</label>
        <input type="text" id="mother_groom_name" class="form-control" required>
      </div>

      <hr class="bg-white">

      <!-- Bride Image Upload -->
      <div class="form-group">
        <label class="text-white">Bride Image</label>
        <input id="bride_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarBride" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusBride"></p>
      </div>

      <!-- Groom Image Upload -->
      <div class="form-group">
        <label class="text-white">Groom Image</label>
        <input id="groom_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarGroom" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusGroom"></p>
      </div>

      <a href="{{ route('couples.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<script>
let path = @json($path);
let brideImagePath = '';
let groomImagePath = '';

// Generic file upload with progress
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

// Setup both inputs
setupFileUpload('bride_image', 'progressBarBride', 'statusBride', 'bride_image', function(path) {
    brideImagePath = path;
});
setupFileUpload('groom_image', 'progressBarGroom', 'statusGroom', 'groom_image', function(path) {
    groomImagePath = path;
});

// Save button handler
document.getElementById('saveButton').addEventListener('click', function() {

    // Clear alerts
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    // Collect all fields
    const coupleData = {
        bride_name: document.getElementById('bride_name').value.trim(),
        father_bride_name: document.getElementById('father_bride_name').value.trim(),
        mother_bride_name: document.getElementById('mother_bride_name').value.trim(),
        groom_name: document.getElementById('groom_name').value.trim(),
        father_groom_name: document.getElementById('father_groom_name').value.trim(),
        mother_groom_name: document.getElementById('mother_groom_name').value.trim(),
        bride_image: brideImagePath || null,
        groom_image: groomImagePath || null
    };

    // Check required fields
    if (!coupleData.bride_name ||
        !coupleData.father_bride_name ||
        !coupleData.mother_bride_name ||
        !coupleData.groom_name ||
        !coupleData.father_groom_name ||
        !coupleData.mother_groom_name)
        {
        document.getElementById('errorBox').classList.remove('d-none');
        document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
        return;
    }

    // Post to Laravel
    axios.post('{{ route('couples.store') }}', coupleData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Couple created successfully!';
            setTimeout(() => window.location.href = "{{ route('couples.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error creating couple.';
            }
        });
});
</script>
@endsection





