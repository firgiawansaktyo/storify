@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <h1 class="h3 text-white">Edit Couple</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Couple Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Bride Name</label>
        <input type="text" id="bride_name" class="form-control" value="{{ old('bride_name', $couple->bride_name) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Father's Bride Name</label>
        <input type="text" id="father_bride_name" class="form-control" value="{{ old('father_bride_name', $couple->father_bride_name) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Mother's Bride Name</label>
        <input type="text" id="mother_bride_name" class="form-control" value="{{ old('mother_bride_name', $couple->mother_bride_name) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Groom Name</label>
        <input type="text" id="groom_name" class="form-control" value="{{ old('groom_name', $couple->groom_name) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Father's Groom Name</label>
        <input type="text" id="father_groom_name" class="form-control" value="{{ old('father_groom_name', $couple->father_groom_name) }}" required>
      </div>
      <div class="form-group">
        <label class="text-white">Mother's Groom Name</label>
        <input type="text" id="mother_groom_name" class="form-control" value="{{ old('mother_groom_name', $couple->mother_groom_name) }}" required>
      </div>

      <hr class="bg-white">

      <!-- Bride Image Upload -->
      <div class="form-group">
        <label class="text-white">Bride Image</label>
        <input id="bride_image" type="file" accept="image/*" class="form-control" value="{{ old('bride_image', $couple->bride_image) }}">
        <progress id="progressBarBride" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusBride"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalBrideImage"
          src="{{ old('bride_image') ? asset('storage/' . old('bride_image')) : (isset($couple) && $couple->bride_image ? asset('storage/' . $couple->bride_image) : '') }}">
        <div class="modal fade" id="imageModalBrideImage" tabindex="-1" aria-labelledby="imageModalLabelBrideImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <img src="{{ asset('storage/' . $couple->bride_image) }}" alt="Full Image">
              </div>
          </div>
        </div>
      </div>

      <!-- Groom Image Upload -->
      <div class="form-group">
        <label class="text-white">Groom Image</label>
        <input id="groom_image" type="file" accept="image/*" class="form-control" value="{{ old('groom_image', $couple->groom_image) }}">
        <progress id="progressBarGroom" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusGroom"></p>
        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        <img    
          id="imagePreview"
          class="text-center justify-center justify-self-center"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalGroomImage"
          src="{{ old('groom_image') ? asset('storage/' . old('groom_image')) : (isset($couple) && $couple->groom_image ? asset('storage/' . $couple->groom_image) : '') }}">
            <div class="modal fade" id="imageModalGroomImage" tabindex="-1" aria-labelledby="imageModalLabelGroomImage" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                      <img src="{{ asset('storage/' . $couple->groom_image) }}" alt="Full Image">
                  </div>
              </div>
            </div>
      </div>

      <a href="{{ route('couples.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>
@endsection