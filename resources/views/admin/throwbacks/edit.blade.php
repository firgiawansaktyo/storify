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
        <input
          type="text"
          id="wedding_throwback_title"
          class="form-control"
          value="{{ old('wedding_throwback_title', $throwback->wedding_throwback_title) }}"
          required
        >
      </div>

      <div class="form-group">
        <label class="text-white">Throwback Image Description</label>
        <textarea
          id="wedding_throwback_description"
          class="form-control"
          required
        >{{ old('wedding_throwback_description', $throwback->wedding_throwback_description) }}</textarea>
      </div>

      <hr class="bg-white">

      <!-- Throwback Image Upload -->
      <div class="form-group">
        <label class="text-white">Throwback Image</label>
        <input
          id="wedding_throwback_image"
          type="file"
          accept="image/*"
          class="form-control"
        >
        <progress
          id="progressBarThrowbackImage"
          value="0"
          max="100"
          class="mt-2 w-100 d-none"
        ></progress>
        <p id="statusThrowbackImage"></p>

        <p class="text-center pt-2">Current Image</p>
        <img
          id="throwbackImagePreview"
          class="mx-auto d-block max-w-sm cursor-pointer"
          data-toggle="modal"
          data-target="#imageModalThrowbackImage"
          src="{{ old('wedding_throwback_image') ? cdn_sweetvows(old('wedding_throwback_image')) : ($throwback->wedding_throwback_image ? cdn_sweetvows($throwback->wedding_throwback_image) : '') }}"
          alt="Throwback Image"
        >

        <div class="modal fade" id="imageModalThrowbackImage" tabindex="-1" aria-labelledby="imageModalLabelThrowbackImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              @if($throwback->wedding_throwback_image)
                <img src="{{ cdn_sweetvows($throwback->wedding_throwback_image) }}" alt="Full Image">
              @endif
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

<span
  id="throwback-update-data"
  data-path="{{ $path }}"
  data-update-route="{{ route('throwbacks.update', $throwback->id) }}"
  data-index-route="{{ route('throwbacks.index') }}"
  data-throwback-image="{{ $throwback->wedding_throwback_image }}"
  class="d-none"
></span>

@vite('resources/js/throwbackUpdate.js')
@endsection
