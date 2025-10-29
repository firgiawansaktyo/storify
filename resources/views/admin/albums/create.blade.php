@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Album Image</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Album Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Album Image Title</label>
        <input type="text" id="wedding_album_title" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Album Image Description</label>
        <textarea type="text" id="wedding_album_description" class="form-control" required></textarea>
      </div>

      <hr class="bg-white">

      <!-- Album Image Upload -->
      <div class="form-group">
        <label class="text-white">Album Image</label>
        <input id="wedding_album_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarAlbumImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusAlbumImage"></p>
      </div>

      <a href="{{ route('albums.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<script>
let path = @json($path);
let albumImagePath = '';

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
setupFileUpload('wedding_album_image', 'progressBarAlbumImage', 'statusAlbumImage', 'wedding_album_image', function(path) {
    albumImagePath = path;
});

// Save button handler
document.getElementById('saveButton').addEventListener('click', function() {

    // Clear alerts
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    // Collect all fields
    const albumData = {
        wedding_album_title: document.getElementById('wedding_album_title').value.trim(),
        wedding_album_description: document.getElementById('wedding_album_description').value.trim(),
        wedding_album_image: albumImagePath || null,
    };

    // Check required fields
    if (!albumData.wedding_album_title ||
        !albumData.wedding_album_description)
        {
        document.getElementById('errorBox').classList.remove('d-none');
        document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
        return;
    }

    axios.post('{{ route('albums.store') }}', albumData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Album Image created successfully!';
            setTimeout(() => window.location.href = "{{ route('albums.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error creating album image.';
            }
        });
});
</script>
@endsection





