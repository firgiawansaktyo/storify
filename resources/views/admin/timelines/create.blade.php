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
@endsection





