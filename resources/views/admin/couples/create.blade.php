@extends('layouts.admin')
@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Couple</h1>

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
        <input type="text" id="bride_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Father's Bride Name</label>
        <input type="text" id="father_bride_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Mother's Bride Name</label>
        <input type="text" id="mother_bride_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Groom Name</label>
        <input type="text" id="groom_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Father's Groom Name</label>
        <input type="text" id="father_groom_name" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="text-white">Mother's Groom Name</label>
        <input type="text" id="mother_groom_name" class="form-control" required>
      </div>

      <hr class="bg-white">

      <!-- Bride Image Upload -->
      <div class="form-group">
        <label class="text-white">Bride Image</label>
        <input id="bride_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarBride" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusBride"></p>
      </div>

      <!-- Groom Image Upload -->
      <div class="form-group">
        <label class="text-white">Groom Image</label>
        <input id="groom_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarGroom" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusGroom"></p>
      </div>

      <a href="{{ route('couples.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>
@endsection





