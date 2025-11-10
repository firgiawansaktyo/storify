@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Wedding Invitation</h1>

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
        ></textarea>
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Prayer Verse</label>
        <textarea
          id="wedding_prayer_verse"
          name="wedding_prayer_verse"
          class="form-control h-24"
          required
        ></textarea>
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Message Template</label>
        <textarea
          id="wedding_message_template"
          name="wedding_message_template"
          class="form-control h-24"
          required
        ></textarea>
      </div>

      <div class="form-group">
        <label class="text-white">Wedding Landing Title</label>
        <input
          type="text"
          id="wedding_landing_title"
          name="wedding_landing_title"
          class="form-control"
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
        ></textarea>
      </div>

      <hr class="bg-white">

      <div class="form-group">
        <label class="text-white">Wedding Image</label>
        <input
          type="file"
          accept="image/*"
          id="wedding_image"
          name="wedding_image"
          class="form-control"
          required
        >
        <progress
          id="progressBarWeddingImage"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusWeddingImage"></p>
      </div>

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
      </div>

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
      </div>

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
      </div>

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
      </div>

      <a href="{{ route('weddings.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>

    </div>
  </div>
</div>

<span
  id="wedding-create-data"
  data-path="{{ $path }}"
  data-store-route="{{ route('weddings.store') }}"
  data-index-route="{{ route('weddings.index') }}"
  class="d-none"
></span>

@vite('resources/js/weddingCreate.js')
@endsection
