@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">

  <!-- Page Heading -->
  <h1 class="h3 text-white">Edit Hashtag</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-primary">Hashtag Form</h6>
    </div>
    <div class="card-body">

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('hashtags.update', $hashtags->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label class="text-white">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $hashtags->name) }}" required/>
        </div>

        <a href="{{ route('hashtags.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-spotify">
          <i class="fas fa-save"></i> Save
        </button>
      </form>

    </div>
  </div>
</div>
@endsection





