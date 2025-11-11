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
        <input
          type="text"
          id="wedding_title"
          name="wedding_title"
          class="form-control"
          value="{{ old('wedding_title', $wedding->wedding_title) }}"
          required
        />
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Sub Title</label>
        <input
          type="text"
          id="wedding_sub_title"
          name="wedding_sub_title"
          class="form-control"
          value="{{ old('wedding_sub_title', $wedding->wedding_sub_title) }}"
          required
        />
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Description</label>
        <textarea
          id="wedding_description"
          name="wedding_description"
          class="form-control h-24"
          required
        >{{ old('wedding_description', $wedding->wedding_description) }}</textarea>
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Prayer Verse</label>
        <textarea
          id="wedding_prayer_verse"
          name="wedding_prayer_verse"
          class="form-control h-24"
        >{{ old('wedding_prayer_verse', $wedding->wedding_prayer_verse) }}</textarea>
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Message Template</label>
        <textarea
          id="wedding_message_template"
          name="wedding_message_template"
          class="form-control h-24"
          required
        >{{ old('wedding_message_template', $wedding->wedding_message_template) }}</textarea>
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Landing Title</label>
        <input
          type="text"
          id="wedding_landing_title"
          name="wedding_landing_title"
          class="form-control"
          value="{{ old('wedding_landing_title', $wedding->wedding_landing_title) }}"
          required
        >
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Hot News Description</label>
        <textarea
          id="wedding_hotnews_description"
          name="wedding_hotnews_description"
          class="form-control h-24"
          required
        >{{ old('wedding_hotnews_description', $wedding->wedding_hotnews_description) }}</textarea>
      </div>

      <hr class="bg-white">

      {{-- Wedding Image --}}
      <div class="form-group">
        <label class="text-white">Wedding Image</label>
        <input
          type="file"
          accept="image/*"
          id="wedding_image"
          name="wedding_image"
          class="form-control"
        >
        <progress
          id="progressBarWeddingImage"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusWeddingImage"></p>

        <p class="text-center pt-2">Current Image</p>
        <img
          id="weddingImagePreview"
          class="mx-auto d-block max-w-sm cursor-pointer"
          data-toggle="modal"
          data-target="#imageModalWeddingImage"
          src="{{ old('wedding_image') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('wedding_image')) : ($wedding->wedding_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_image) : '') }}"
          alt="Wedding Image"
        >
        <div class="modal fade" id="imageModalWeddingImage" tabindex="-1" aria-labelledby="imageModalLabelWeddingImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              @if($wedding->wedding_image)
                <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_image) }}" alt="Full Wedding Image">
              @endif
            </div>
          </div>
        </div>
      </div>

      {{-- Wedding Video --}}
      <div class="form-group">
        <label class="text-white">Wedding Video</label>
        <input
          type="file"
          accept="video/*"
          id="wedding_video"
          name="wedding_video"
          class="form-control"
        >
        <progress
          id="progressBarWeddingVideo"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusWeddingVideo"></p>

        <p class="text-center pt-2">Current Video</p>
        <video
          id="weddingVideoPreview"
          class="mx-auto max-w-sm d-block"
          controls
          src="{{ old('wedding_video') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('wedding_video')) : ($wedding->wedding_video ? Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_video) : '') }}"
        ></video>
      </div>

      {{-- Wedding Audio --}}
      <div class="form-group">
        <label class="text-white">Wedding Audio</label>
        <input
          type="file"
          accept="audio/*"
          id="wedding_audio"
          name="wedding_audio"
          class="form-control"
        >
        <progress
          id="progressBarWeddingAudio"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusWeddingAudio"></p>

        <p class="text-center pt-2">Current Audio</p>
        <audio
          id="weddingAudioPreview"
          class="mx-auto d-block"
          controls
          src="{{ old('wedding_audio') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('wedding_audio')) : ($wedding->wedding_audio ? Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_audio) : '') }}"
        ></audio>
      </div>

      {{-- Wedding Landing Image --}}
      <div class="form-group">
        <label class="text-white">Wedding Landing Image</label>
        <input
          type="file"
          accept="image/*"
          id="wedding_landing_image"
          name="wedding_landing_image"
          class="form-control"
        >
        <progress
          id="progressBarLandingImage"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusLandingImage"></p>

        <p class="text-center pt-2">Current Landing Image</p>
        <img
          id="weddingLandingPreview"
          class="mx-auto d-block max-w-sm cursor-pointer"
          data-toggle="modal"
          data-target="#imageModalWeddingLandingImage"
          src="{{ old('wedding_landing_image') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('wedding_landing_image')) : ($wedding->wedding_landing_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_landing_image) : '') }}"
          alt="Wedding Landing Image"
        >
        <div class="modal fade" id="imageModalWeddingLandingImage" tabindex="-1" aria-labelledby="imageModalLabelWeddingLandingImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              @if($wedding->wedding_landing_image)
                <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_landing_image) }}" alt="Full Landing Image">
              @endif
            </div>
          </div>
        </div>
      </div>

      {{-- Wedding Hot News Image --}}
      <div class="form-group">
        <label class="text-white">Wedding Hot News Image</label>
        <input
          type="file"
          accept="image/*"
          id="wedding_hotnews_image"
          name="wedding_hotnews_image"
          class="form-control"
        >
        <progress
          id="progressBarHotNewsImage"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusHotNewsImage"></p>

        <p class="text-center pt-2">Current Hot News Image</p>
        <img
          id="weddingHotNewsPreview"
          class="mx-auto d-block max-w-sm cursor-pointer"
          data-toggle="modal"
          data-target="#imageModalWeddingHotNewsImage"
          src="{{ old('wedding_hotnews_image') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('wedding_hotnews_image')) : ($wedding->wedding_hotnews_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_hotnews_image) : '') }}"
          alt="Wedding Hot News Image"
        >
        <div class="modal fade" id="imageModalWeddingHotNewsImage" tabindex="-1" aria-labelledby="imageModalLabelWeddingHotNewsImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              @if($wedding->wedding_hotnews_image)
                <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_hotnews_image) }}" alt="Full Hot News Image">
              @endif
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

<span
  id="wedding-update-data"
  data-path="{{ $path }}"
  data-update-route="{{ route('weddings.update', $wedding->id) }}"
  data-index-route="{{ route('weddings.index') }}"
  data-wedding-image="{{ $wedding->wedding_image }}"
  data-wedding-video="{{ $wedding->wedding_video }}"
  data-wedding-audio="{{ $wedding->wedding_audio }}"
  data-wedding-landing-image="{{ $wedding->wedding_landing_image }}"
  data-wedding-hotnews-image="{{ $wedding->wedding_hotnews_image }}"
  class="d-none"
></span>

@vite('resources/js/weddingUpdate.js')
@endsection
