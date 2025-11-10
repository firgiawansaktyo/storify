let path = @json($path);
let weddingImagePath = '';
let weddingVideoPath = '';
let weddingAudioPath = '';
let weddingLandingPath = '';
let weddingHotNewsPath = '';

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

document.getElementById('saveButton').addEventListener('click', function() {
    document.getElementById('errorBox').classList.add('d-none');
    document.getElementById('successBox').classList.add('d-none');

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