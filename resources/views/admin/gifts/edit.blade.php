@extends('layouts.admin')

@section('content')
<div class="mb-2 mt-2 p-2">
  <h1 class="h3 text-white">Edit Gift</h1>

  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-white">Gift Form</h6>
    </div>
    <div class="card-body">

      <div id="successBox" class="alert alert-success d-none"></div>
      <div id="errorBox" class="alert alert-danger d-none"></div>

      <div class="form-group">
        <label class="text-white">Bank</label>
        <select id="bank_id" class="form-control" required>
          <option value="">-- Select Bank --</option>
          @foreach($banks as $bank)
            <option value="{{ $bank->id }}" {{ (string)old('bank_id', $gift->bank_id) === (string)$bank->id ? 'selected' : '' }}>
              {{ $bank->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label class="text-white">Account Number</label>
        <input type="text" id="account_number" class="form-control" value="{{ old('account_number', $gift->account_number) }}" required>
      </div>

      <div class="form-group">
        <label class="text-white">Account Holder</label>
        <input type="text" id="account_holder" class="form-control" value="{{ old('account_holder', $gift->account_holder) }}" required>
      </div>

      <hr class="bg-white">

      <div class="form-group">
        <label class="text-white">QRIS Image</label>
        <input id="qris_image" type="file" accept="image/*" class="form-control" value="{{ old('qris_image', $gift->qris_image) }}">
        <progress id="progressBarQrisImage" value="0" max="100" class="mt-2 w-100 d-none"></progress>
        <p id="statusQrisImage"></p>

        <p class="text-center justify-center justify-self-center pt-2">Current Image</p>
        @if($gift->qris_image)
          <img
            id="imagePreview"
            class="text-center justify-center justify-self-center"
            style="max-width: 300px; cursor: pointer;"
            data-toggle="modal"
            data-target="#imageModalQrisImage"
            src="{{ old('qris_image') ? asset('storage/' . old('qris_image')) : asset('storage/' . $gift->qris_image) }}"
            alt="QRIS Image">
          <div class="modal fade" id="imageModalQrisImage" tabindex="-1" aria-labelledby="imageModalLabelQrisImage" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <img src="{{ asset('storage/' . $gift->qris_image) }}" alt="Full Image">
              </div>
            </div>
          </div>
        @else
          <span class="text-muted">No Image</span>
        @endif
      </div>

      <a href="{{ route('gifts.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveButton" class="btn btn-spotify">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
</div>
<script>
    window.path = @json($path);
</script>
@endsection
