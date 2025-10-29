@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">

  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Timeline</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Timeline Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <div class="form-group">
        <label class="text-white">Wedding Vow Date</label>
        <input type="date" id="wedding_vow_date" class="form-control" value="{{ old('wedding_vow_date') }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Start Time</label>
        <input type="time" id="wedding_vow_start_time" class="form-control" value="{{ old('wedding_vow_start_time') }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow End Time</label>
        <input type="time" id="wedding_vow_end_time" class="form-control" value="{{ old('wedding_vow_end_time') }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Location</label>
        <textarea style="height: 100px;" type="text" id="wedding_vow_location" class="form-control" value="{{ old('wedding_vow_location') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Address</label>
        <textarea style="height: 100px;" type="text" id="wedding_vow_address" class="form-control" value="{{ old('wedding_vow_address') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Location Link</label>
        <textarea style="height: 100px;" type="text" id="wedding_vow_location_link" class="form-control" value="{{ old('wedding_vow_location_link') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Iframe</label>
        <textarea style="height: 100px;" type="text" id="wedding_vow_iframe" class="form-control" value="{{ old('wedding_vow_iframe') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Date</label>
        <input type="date" id="wedding_reception_date" class="form-control" value="{{ old('wedding_reception_date') }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Start Time</label>
        <input type="time" id="wedding_reception_start_time" class="form-control" value="{{ old('wedding_reception_start_time') }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception End Time</label>
        <input type="time" id="wedding_reception_end_time" class="form-control" value="{{ old('wedding_reception_end_time') }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Location</label>
        <textarea style="height: 100px;" type="text" id="wedding_reception_location" class="form-control" value="{{ old('wedding_reception_location') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Address</label>
        <textarea style="height: 100px;" type="text" id="wedding_reception_address" class="form-control" value="{{ old('wedding_reception_address') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Location Link</label>
        <textarea style="height: 100px;" type="text" id="wedding_reception_location_link" class="form-control" value="{{ old('wedding_reception_location_link') }}" required></textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Iframe</label>
        <textarea style="height: 100px;" type="text" id="wedding_reception_iframe" class="form-control" value="{{ old('wedding_reception_iframe') }}" required></textarea>
      </div>

      <hr class="bg-white">

      <!-- Vow Image Upload -->
      <div class="form-group">
        <label class="text-white">Vow Image</label>
        <input id="wedding_vow_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarVow" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusVow"></p>
      </div>

      <!-- Reception Image Upload -->
      <div class="form-group">
        <label class="text-white">Reception Image</label>
        <input id="wedding_reception_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarReception" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusReception"></p>
      </div>


      <a href="{{ route('timelines.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>

    </div>
  </div>
</div>

<script>
let path = @json($path);
let vowPath = '';
let receptionPath = '';

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
setupFileUpload('wedding_vow_image', 'progressBarVow', 'statusVow', 'wedding_vow_image', function(path) {
    vowPath = path;
});
setupFileUpload('wedding_reception_image', 'progressBarReception', 'statusReception', 'wedding_reception_image', function(path) {
    receptionPath = path;
});

// Save button handler
document.getElementById('saveButton').addEventListener('click', function() {

    // Clear alerts
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    // Collect all fields
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

    // Check required fields
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

    // Post to Laravel
    axios.post('{{ route('timelines.store') }}', timelineData)
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
</script>
@endsection





