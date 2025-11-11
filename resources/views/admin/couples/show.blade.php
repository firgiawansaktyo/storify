@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">

  <!-- Page Heading -->
  <h1 class="h3 text-white">Show Couple</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Detail</h6>
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

    <div class="form-group">
        <label class="text-white  ">Bride Name</label>
        <input type="text" name="bride_name" class="form-control" value="{{ old('bride_name', $couple->bride_name) }}" disabled>
    </div>
    <div class="form-group">
        <label class="text-white">Father's Bride Name</label>
        <input type="text" name="father_bride_name" class="form-control" value="{{ old('father_bride_name', $couple->father_bride_name ) }}" disabled>
    </div>
    <div class="form-group">
        <label class="text-white">Mother's Bride Name</label>
        <input type="text" name="mother_bride_name" class="form-control" value="{{ old('mother_bride_name', $couple->mother_bride_name) }}" disabled>
    </div>
    <div class="form-group">
        <label class="text-white">Groom Name</label>
        <input type="text" name="groom_name" class="form-control" value="{{ old('groom_name', $couple->groom_name) }}" disabled>
    </div>
    <div class="form-group">
        <label class="text-white">Father's Groom Name</label>
        <input type="text" name="father_groom_name" class="form-control" value="{{ old('father_groom_name', $couple->father_groom_name) }}" disabled>
    </div>
    <div class="form-group">
        <label class="text-white">Mother's Groom Name</label>
        <input type="text" name="mother_groom_name" class="form-control"  value="{{ old('mother_groom_name', $couple->mother_groom_name) }}" disabled>
    </div>
    <div class="form-group">
        <p class="text-center justify-center justify-self-center pt-2">Bride Image</p>
        <img    
            id="imagePreview"
            class="text-center justify-center justify-self-center max-w-sm cursor-pointer"
            data-toggle="modal" 
            data-target="#imageModalBrideImage"
            src="{{ old('bride_image') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('bride_image')) : (isset($couple) && $couple->bride_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($couple->bride_image) : '') }}">
            <div class="modal fade" id="imageModalBrideImage" tabindex="-1" aria-labelledby="imageModalLabelBrideImage" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($couple->bride_image) }}" alt="Full Image">
                    </div>
                </div>
            </div>
    </div>
    <div class="form-group">
        <p class="text-center justify-center justify-self-center pt-2">Groom Image</p>
        <img    
            id="imagePreview"
            class="text-center justify-center justify-self-center max-w-sm cursor-pointer"
            data-toggle="modal" 
            data-target="#imageModalGroomImage"
            src="{{ old('groom_image') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('groom_image')) : (isset($couple) && $couple->groom_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($couple->groom_image) : '') }}">
            <div class="modal fade" id="imageModalGroomImage" tabindex="-1" aria-labelledby="imageModalLabelGroomImage" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($couple->groom_image) }}" alt="Full Image">
                    </div>
                </div>
            </div>
    </div>

    <a href="{{ route('couples.index') }}" class="btn btn-secondary">Back</a>

    </div>
  </div>
</div>
@endsection
