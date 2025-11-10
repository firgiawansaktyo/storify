@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <h1 class="h3 text-white">Edit Bank</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Bank Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Bank Name</label>
        <input 
          type="text" 
          id="name" 
          class="form-control" 
          value="{{ old('name', $bank->name) }}" 
          required
        >
      </div>

      <hr class="bg-white">

      <!-- Bank Image Upload -->
      <div class="form-group">
        <label class="text-white">Bank Image</label>
        <input 
          id="bank_image" 
          type="file" 
          accept="image/*" 
          class="form-control"
        >

        <progress 
          id="progressBarBankImage" 
          value="0" 
          max="100" 
          class="mt-2 w-100 d-none">
        </progress>

        <p id="statusBankImage"></p>

        <p class="text-center pt-2">
          Current Image
        </p>

        <img    
          id="imagePreview"
          class="mx-auto d-block"
          style="max-width: 300px; cursor: pointer;" 
          data-toggle="modal" 
          data-target="#imageModalBankImage"
          src="{{ $bank->bank_image ? asset('storage/' . $bank->bank_image) : '' }}"
          alt="Current Bank Image"
        >

        <div class="modal fade" id="imageModalBankImage" tabindex="-1" aria-labelledby="imageModalLabelBankImage" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
              @if($bank->bank_image)
                <img src="{{ asset('storage/' . $bank->bank_image) }}" alt="Full Bank Image">
              @endif
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route('banks.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<span
  id="bank-update-data"
  data-path="{{ $path }}"
  data-update-route="{{ route('banks.update', $bank->id) }}"
  data-index-route="{{ route('banks.index') }}"
  data-bank-image="{{ $bank->bank_image }}"
  class="d-none"
></span>

@vite('resources/js/bankUpdate.js')
@endsection
