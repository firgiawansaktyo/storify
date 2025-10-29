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
        <input type="text" id="wedding_title" name="wedding_title" class="form-control" value="{{ old('wedding_title', $wedding->wedding_title) }}" disabled/>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Sub Title</label>
        <input type="text" id="wedding_sub_title" name="wedding_sub_title" class="form-control" value="{{ old('wedding_sub_title', $wedding->wedding_sub_title) }}" disabled/>
      </div>
      <div class="form-group">
        <label class="text-white  ">Wedding Description</label>
        <textarea style="height: 100px;" type="text" id="wedding_description" name="wedding_description" class="form-control" value="{{ old('wedding_description', $wedding->wedding_description) }}" disabled>{{ old('wedding_description', $wedding->wedding_description) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Prayer Verse</label>
        <textarea style="height: 100px;" type="text" id="wedding_prayer_verse" name="wedding_prayer_verse" class="form-control" value="{{ old('wedding_prayer_verse', $wedding->wedding_prayer_verse) }}" disabled>{{ old('wedding_prayer_verse', $wedding->wedding_prayer_verse) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white  ">Wedding Message Template</label>
        <textarea style="height: 100px;" type="text" id="wedding_message_template" name="wedding_message_template" class="form-control" value="{{ old('wedding_message_template', $wedding->wedding_message_template) }}" disabled>{{ old('wedding_message_template', $wedding->wedding_message_template) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Landing Title</label>
        <input type="text" id="wedding_landing_title" name="wedding_landing_title" class="form-control" value="{{ old('wedding_landing_title', $wedding->wedding_landing_title) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Hot News Description</label>
        <textarea style="height: 100px;" type="text" id="wedding_hotnews_description" name="wedding_hotnews_description" class="form-control" value="{{ old('wedding_hotnews_description', $wedding->wedding_hotnews_description) }}" disabled>{{ old('wedding_hotnews_description', $wedding->wedding_hotnews_description) }}</textarea>
      </div>

      <hr class="bg-white">

      <div class="form-group">
        <label class="text-white">Wedding Image</label>
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

      <a href="{{ route('weddings.index') }}" class="btn btn-secondary">Back</a>

    </div>
  </div>
</div>

@endsection











