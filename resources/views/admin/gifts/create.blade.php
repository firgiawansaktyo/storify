@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <!-- Page Heading -->
  <h1 class="h3 text-white">Create Gift</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Gift Form</h6>
    </div>
    <div class="card-body">

      <!-- Success and Error Alerts -->
      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <!-- Form Fields -->
      <div class="form-group">
        <label class="text-white">Bank</label>
        <select id="bank_id" class="form-control" required>
          <option value="">-- Select Bank --</option>
          @foreach($banks as $bank)
            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label class="text-white">Account Number</label>
        <input type="text" id="account_number" class="form-control" maxlength="50" required>
      </div>

      <div class="form-group">
        <label class="text-white">Account Holder</label>
        <input type="text" id="account_holder" class="form-control" maxlength="100" required>
      </div>

      <hr class="bg-white">

      <!-- QRIS Image Upload -->
      <div class="form-group">
        <label class="text-white">QRIS Image</label>
        <input id="qris_image" type="file" accept="image/*" class="form-control">
        <progress id="progressBarQrisImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusQrisImage"></p>
      </div>

      <a href="{{ route('gifts.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>

<span
  id="gift-create-data"
  data-path="{{ $path }}"
  data-store-route="{{ route('gifts.store') }}"
  data-index-route="{{ route('gifts.index') }}"
  class="d-none"
></span>

@vite('resources/js/giftCreate.js')
@endsection
