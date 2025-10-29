@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Edit Wedding Invitation</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Wedding Invitation Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>


      <div class="form-group">
        <label class="text-white">Wedding Title</label>
        <input type="text" id="wedding_title" name="wedding_title" class="form-control" value="{{ old('wedding_title', $wedding->wedding_title) }}" required/>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Sub Title</label>
        <input type="text" id="wedding_sub_title" name="wedding_sub_title" class="form-control" value="{{ old('wedding_sub_title', $wedding->wedding_sub_title) }}" required/>
      </div>
      <div class="form-group">
        <label class="text-white  ">Wedding Description</label>
        <textarea style="height: 100px;" type="text" id="wedding_description" name="wedding_description" class="form-control" value="{{ old('wedding_description', $wedding->wedding_description) }}" required>{{ old('wedding_description', $wedding->wedding_description) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Prayer Verse</label>
        <textarea style="height: 100px;" type="text" id="wedding_prayer_verse" name="wedding_prayer_verse" class="form-control" value="{{ old('wedding_prayer_verse', $wedding->wedding_prayer_verse) }}">{{ old('wedding_prayer_verse', $wedding->wedding_prayer_verse) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white  ">Wedding Message Template</label>
        <textarea style="height: 100px;" type="text" id="wedding_message_template" name="wedding_message_template" class="form-control" value="{{ old('wedding_message_template', $wedding->wedding_message_template) }}" required>{{ old('wedding_message_template', $wedding->wedding_message_template) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Landing Title</label>
        <input type="text" id="wedding_landing_title" name="wedding_landing_title" class="form-control" value="{{ old('wedding_landing_title', $wedding->wedding_landing_title) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Hot News Description</label>
        <textarea style="height: 100px;" type="text" id="wedding_hotnews_description" name="wedding_hotnews_description" class="form-control" value="{{ old('wedding_hotnews_description', $wedding->wedding_hotnews_description) }}" required>{{ old('wedding_hotnews_description', $wedding->wedding_hotnews_description) }}</textarea>
      </div>

      <hr class="bg-white">

      <div class="form-group">
        <label class="text-white">Wedding Image</label>
        <input type="file" accept="image/*" id="wedding_image" name="wedding_image" class="form-control" value="{{ old('wedding_image', $wedding->wedding_image) }}" required>
        <progress id="progressBarWeddingImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusWeddingImage"></p>
                <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalWeddingImage"
          src="{{ old('wedding_image') ? asset('storage/' . old('wedding_image')) : (isset($wedding) && $wedding->wedding_image ? asset('storage/' . $wedding->wedding_image) : '') }}">
            <div class="modal fade" id="imageModalWeddingImage" tabindex="-1" aria-labelledby="imageModalLabelWeddingImage" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                      <img src="{{ asset('storage/' . $wedding->wedding_image) }}" alt="Full Image">
                  </div>
              </div>
            </div>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Video</label>
        <input type="file" accept="video/*" id="wedding_video" name="wedding_video" accept="video/*" class="form-control" value="{{ old('wedding_video', $wedding->wedding_video) }}">
        <progress id="progressBarWeddingVideo" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusWeddingVideo"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Video</p>
        <video    
          id="videoPreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          controls
          src="{{ old('wedding_video') ? asset('storage/' . old('wedding_video')) : (isset($wedding) && $wedding->wedding_video ? asset('storage/' . $wedding->wedding_video) : '') }}">
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Audio</label>
        <input type="file" accept="audio/*" id="wedding_audio" name="wedding_audio" accept="audio/*" class="form-control" value="{{ old('wedding_audio', $wedding->wedding_audio) }}">
        <progress id="progressBarWeddingAudio" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusWeddingAudio"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Audio</p>
        <audio    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          controls
          src="{{ old('wedding_audio') ? asset('storage/' . old('wedding_audio')) : (isset($wedding) && $wedding->wedding_audio ? asset('storage/' . $wedding->wedding_audio) : '') }}">
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Landing Image</label>
        <input type="file" accept="image/*" id="wedding_landing_image" name="wedding_landing_image" class="form-control" value="{{ old('wedding_landing_image', $wedding->wedding_landing_image) }}">
        <progress id="progressBarLandingImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusLandingImage"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalWeddingLandingImage"
          src="{{ old('wedding_landing_image') ? asset('storage/' . old('wedding_landing_image')) : (isset($wedding) && $wedding->wedding_landing_image ? asset('storage/' . $wedding->wedding_landing_image) : '') }}">
            <div class="modal fade" id="imageModalWeddingLandingImage" tabindex="-1" aria-labelledby="imageModalLabelWeddingLandingImage" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                      <img src="{{ asset('storage/' . $wedding->wedding_landing_image) }}" alt="Full Image">
                  </div>
              </div>
            </div>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Hot News Image</label>
        <input type="file" accept="image/*" id="wedding_hotnews_image" name="wedding_hotnews_image" class="form-control" value="{{ old('wedding_hotnews_image', $wedding->wedding_hotnews_image) }}">
        <progress id="progressBarHotNewsImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusHotNewsImage"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalWeddingHotNewsImage"
          src="{{ old('wedding_hotnews_image') ? asset('storage/' . old('wedding_hotnews_image')) : (isset($wedding) && $wedding->wedding_hotnews_image ? asset('storage/' . $wedding->wedding_hotnews_image) : '') }}">
            <div class="modal fade" id="imageModalWeddingHotNewsImage" tabindex="-1" aria-labelledby="imageModalLabelWeddingHotNewsImage" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                      <img src="{{ asset('storage/' . $wedding->wedding_hotnews_image) }}" alt="Full Image">
                  </div>
              </div>
            </div>
      </div>

      <a href="{{ route('weddings.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>

    </div>
  </div>
</div>

<script>
let path = @json($path);
let weddingImagePath = '';
let weddingVideoPath = '';
let weddingAudioPath = '';
let weddingLandingPath = '';
let weddingHotNewsPath = '';

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
  setupFileUpload('wedding_image', 'progressBarWeddingImage', 'statusWeddingImage', 'wedding_image', function(path) {
      weddingImagePath = path;
  });
  setupFileUpload('wedding_video', 'progressBarWeddingVideo', 'statusWeddingVideo', 'wedding_video', function(path) {
      weddingVideoPath = path;
  });

  setupFileUpload('wedding_audio', 'progressBarWeddingAudio', 'statusWeddingAudio', 'wedding_audio', function(path) {
      weddingAudioPath = path;
  });

  setupFileUpload('wedding_landing_image', 'progressBarLandingImage', 'statusLandingImage', 'wedding_landing_image', function(path) {
      weddingLandingPath = path;
  });

  setupFileUpload('wedding_hotnews_image', 'progressBarHotNewsImage', 'statusHotNewsImage', 'wedding_hotnews_image', function(path) {
      weddingHotNewsPath = path;
  });

// Save button handler
document.getElementById('saveButton').addEventListener('click', function() {
    // Clear alerts
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

    // Collect all fields
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
        wedding_hotnews_description: document.getElementById('wedding_hotnews_description').value.trim()
    };

    // Check required fields
    if (!weddingData.wedding_title ||
        !weddingData.wedding_sub_title ||
        !weddingData.wedding_description ||
        !weddingData.wedding_prayer_verse ||
        !weddingData.wedding_message_template ||
        !weddingData.wedding_landing_title ||
        !weddingData.wedding_hotnews_description)
        {
          document.getElementById('errorBox').classList.remove('d-none');
          document.getElementById('errorBox').textContent = 'Please fill in all required fields.';
          return;
        }

    // Post to Laravel
    axios.put('{{ route('weddings.update', $wedding->id) }}', weddingData)
        .then(function(response) {
            document.getElementById('successBox').classList.remove('d-none');
            document.getElementById('successBox').textContent = 'Wedding Invitation updated successfully!';
            setTimeout(() => window.location.href = "{{ route('weddings.index') }}", 500);
        })
        .catch(function(error) {
            document.getElementById('errorBox').classList.remove('d-none');
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = Object.values(error.response.data.errors).flat();
                document.getElementById('errorBox').innerHTML = '<ul>' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
            } else {
                document.getElementById('errorBox').textContent = 'Error updating wedding invitation.';
            }
        });
    });
</script>
@endsection











