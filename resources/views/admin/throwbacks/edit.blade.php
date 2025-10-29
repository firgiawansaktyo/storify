@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <h1 class="h3 text-white">Edit Throwback Image</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Throwback Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Throwback Image Title</label>
        <input type="text" id="wedding_throwback_title" class="form-control" value="{{ old('wedding_throwback_title', $throwback->wedding_throwback_title) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Throwback Image Description</label>
        <textarea type="text" id="wedding_throwback_description" class="form-control" value="{{ old('wedding_throwback_description', $throwback->wedding_throwback_description) }}" required>{{ old('wedding_throwback_description', $throwback->wedding_throwback_description) }}</textarea>
      </div>

      <hr class="bg-white">

      <!-- Throwback Image Upload -->
      <div class="form-group">
        <label class="text-white">Throwback Image</label>
        <input id="wedding_throwback_image" type="file" accept="image/*" class="form-control" value="{{ old('wedding_throwback_image', $throwback->wedding_throwback_image) }}">
        <progress id="progressBarThrowbackImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusThrowbackImage"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalThrowbackImage"
          src="{{ old('wedding_throwback_image') ? asset('storage/' . old('wedding_throwback_image')) : (isset($throwback) && $throwback->wedding_throwback_image ? asset('storage/' . $throwback->wedding_throwback_image) : '') }}">
        <div class="modal fade" id="imageModalThrowbackImage" tabindex="-1" aria-labelledby="imageModalLabelThrowbackImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <img src="{{ asset('storage/' . $throwback->wedding_throwback_image) }}" alt="Full Image">
              </div>
          </div>
        </div>
      </div>

      <a href="{{ route('throwbacks.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<script>
let path = @json($path);
let throwbackImagePath = '';

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
setupFileUpload('wedding_throwback_image', 'progressBarThrowbackImage', 'statusThrowbackImage', 'wedding_throwback_image', function(path) {
    throwbackImagePath = path;
});

// Save button handler
document.getElementById('saveButton').addEventListener('click', function() {
    // Clear alerts
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    // Collect all fields
    const throwbackData = {
        wedding_throwback_title: document.getElementById('wedding_throwback_title').value.trim(),
        wedding_throwback_description: document.getElementById('wedding_throwback_description').value.trim(),
        wedding_throwback_image: throwbackImagePath || null,
    };

    // Check required fields
    if (!throwbackData.wedding_throwback_title ||
        !throwbackData.wedding_throwback_description)
        {
        document.getElementById('errorBox').classList.remove('d-none');
        document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
        return;
    }

    // Post to Laravel
    axios.put('{{ route('throwbacks.update', $throwback->id) }}', throwbackData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Throwback Image updated successfully!';
            setTimeout(() => window.location.href = "{{ route('throwbacks.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error updating throwback image.';
            }
        });
});
</script>
@endsection