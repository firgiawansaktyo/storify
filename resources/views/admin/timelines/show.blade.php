@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">

  <!-- Page Heading -->
  <h1 class="h3 text-white">Edit Timeline</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-primary">Timeline Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <div class="form-group">
        <label class="text-white">Wedding Vow Date</label>
        <input type="date" id="wedding_vow_date" class="form-control" value="{{ old('wedding_vow_date' , $timeline->wedding_vow_date) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Start Time</label>
        <input type="time" id="wedding_vow_start_time" class="form-control" value="{{ old('wedding_vow_start_time', $timeline->wedding_vow_start_time) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow End Time</label>
        <input type="time" id="wedding_vow_end_time" class="form-control" value="{{ old('wedding_vow_end_time', $timeline->wedding_vow_end_time) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Location</label>
        <textarea type="text" id="wedding_vow_location" class="form-control h-96" value="{{ old('wedding_vow_location', $timeline->wedding_vow_location) }}" disabled>{{ old('wedding_vow_location', $timeline->wedding_vow_location) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Address</label>
        <textarea type="text" id="wedding_vow_address" class="form-control h-96" value="{{ old('wedding_vow_address', $timeline->wedding_vow_address) }}" disabled>{{ old('wedding_vow_address', $timeline->wedding_vow_address) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Vow Iframe</label>
        <textarea type="text" id="wedding_vow_iframe" class="form-control h-96" value="{{ old('wedding_vow_iframe', $timeline->wedding_vow_iframe) }}" disabled>{{ old('wedding_vow_iframe', $timeline->wedding_vow_iframe) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Date</label>
        <input type="date" id="wedding_reception_date" class="form-control" value="{{ old('wedding_reception_date', $timeline->wedding_reception_date) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Start Time</label>
        <input type="time" id="wedding_reception_start_time" class="form-control" value="{{ old('wedding_reception_start_time', $timeline->wedding_reception_start_time) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception End Time</label>
        <input type="time" id="wedding_reception_end_time" class="form-control" value="{{ old('wedding_reception_end_time', $timeline->wedding_reception_end_time) }}" disabled>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Location</label>
        <textarea type="text" id="wedding_reception_location" class="form-control h-96" value="{{ old('wedding_reception_location', $timeline->wedding_reception_location) }}" disabled>{{ old('wedding_reception_location', $timeline->wedding_reception_location) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Address</label>
        <textarea type="text" id="wedding_reception_address" class="form-control h-96" value="{{ old('wedding_reception_address', $timeline->wedding_reception_address) }}" disabled>{{ old('wedding_reception_address', $timeline->wedding_reception_address) }}</textarea>
      </div>
      <div class="form-group">
        <label class="text-white">Wedding Reception Iframe</label>
        <textarea type="text" id="wedding_reception_iframe" class="form-control h-96" value="{{ old('wedding_reception_iframe', $timeline->wedding_reception_iframe) }}" disabled>{{ old('wedding_reception_iframe', $timeline->wedding_reception_iframe) }}</textarea>
      </div>

      <hr class="bg-white">

      <!-- Vow Image Upload -->
      <div class="form-group">
        <label class="text-white">Vow Image</label>
        <progress id="progressBarVow" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusVow"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center max-w-sm cursor-pointer"
          data-toggle="modal" 
          data-target="#imageModalVowImage"
          src="{{ old('wedding_vow_image') ? asset('storage/' . old('wedding_vow_image')) : (isset($timeline) && $timeline->wedding_vow_image ? asset('storage/' . $timeline->wedding_vow_image) : '') }}">
        <div class="modal fade" id="imageModalVowImage" tabindex="-1" aria-labelledby="imageModalLabelVowImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <img src="{{ asset('storage/' . $timeline->wedding_vow_image) }}" alt="Full Image">
              </div>
          </div>
        </div>
      </div>

      <!-- Reception Image Upload -->
      <div class="form-group">
        <label class="text-white">Reception Image</label>
        <progress id="progressBarReception" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusReception"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center max-w-sm cursor-pointer"
          data-toggle="modal" 
          data-target="#imageModalReceptionImage"
          src="{{ old('wedding_reception_image') ? asset('storage/' . old('wedding_reception_image')) : (isset($timeline) && $timeline->wedding_reception_image ? asset('storage/' . $timeline->wedding_reception_image) : '') }}">
        <div class="modal fade" id="imageModalReceptionImage" tabindex="-1" aria-labelledby="imageModalLabelReceptionImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <img src="{{ asset('storage/' . $timeline->wedding_reception_image) }}" alt="Full Image">
              </div>
          </div>
        </div>
      </div>

      <a href="{{ route('timelines.index') }}" class="btn btn-secondary">Back</a>

    </div>
  </div>
</div>
@endsection





