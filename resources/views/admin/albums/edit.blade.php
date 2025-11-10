@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <h1 class="h3 text-white">Edit Album Image</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Album Form</h6>
    </div>
    <div class="card-body">

      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <div class="form-group">
        <label class="text-white">Album Image Title</label>
        <input type="text" id="wedding_album_title" class="form-control"
          value="{{ old('wedding_album_title', $album->wedding_album_title) }}" required>
      </div>

      <div class="form-group">
        <label class="text-white">Album Image Description</label>
        <textarea id="wedding_album_description" class="form-control" required>{{ old('wedding_album_description', $album->wedding_album_description) }}</textarea>
      </div>

      <hr class="bg-white">

      <div class="form-group">
        <label class="text-white">Album Image</label>
        <input id="wedding_album_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarAlbumImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusAlbumImage"></p>

        <p class="text-center pt-2">Current Image</p>
        <img id="imagePreview" class="mx-auto d-block max-w-sm cursor-pointer"
          data-toggle="modal" data-target="#imageModalAlbumImage"
          src="{{ $album->wedding_album_image ? asset('storage/' . $album->wedding_album_image) : '' }}">
      </div>

      <a href="{{ route('albums.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<span
  id="album-update-data"
  data-path="{{ $path }}"
  data-update-route="{{ route('albums.update', ['album' => $album->id]) }}"
  data-index-route="{{ route('albums.index') }}"
  class="d-none"
>
</span>

@vite('resources/js/albumUpdate.js')
@endsection
