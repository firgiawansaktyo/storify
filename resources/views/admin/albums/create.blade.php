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

@endsection





