@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2 p-2">
        <h3 class="mb-0 text-white">Gifts</h3>
        <a href="{{ route('gifts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Gift
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">Gift List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-center justify-center">
                            <th class="text-white">No</th>
                            <th class="text-white">Owner</th>
                            <th class="text-white">Bank</th>
                            <th class="text-white">Account Number</th>
                            <th class="text-white">Account Holder</th>
                            <th class="text-white">QRIS Image</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gifts as $gift)
                            <tr class="text-center justify-center">
                                <td class="text-white">{{ $loop->iteration }}</td>
                                <td class="text-white">{{ $gift->user->username }}</td>
                                <td class="text-white">{{ $gift->bank->name ?? ' ' }}</td>
                                <td class="text-white">{{ $gift->account_number }}</td>
                                <td class="text-white">{{ $gift->account_holder ?? '—' }}</td> <!-- ✅ new -->
                                <td>
                                    @if($gift->qris_image)
                                        <img
                                            id="imagePreview"
                                            class="text-center justify-center justify-self-center max-w-sm cursor-pointer"
                                            data-toggle="modal"
                                            data-target="#imageModalQrisImage-{{ $gift->id }}"
                                            src="{{ asset('storage/' . $gift->qris_image) }}"
                                            alt="QRIS Image">

                                        <!-- Modal Preview -->
                                        <div class="modal fade" id="imageModalQrisImage-{{ $gift->id }}" tabindex="-1" aria-labelledby="imageModalLabelQrisImage-{{ $gift->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <img src="{{ asset('storage/' . $gift->qris_image) }}" alt="Full Image">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                <td class="text-white">
                                    <div class="flex flex-col space-y-1">
                                        <!-- Edit button -->
                                        <a href="{{ route('gifts.edit', $gift->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <button
                                            class="btn btn-sm btn-danger"
                                            data-toggle="modal"
                                            data-target="#deleteModal-{{ $gift->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal-{{ $gift->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-black">
                                            <h5 class="modal-title" id="deleteModalLabel">
                                                <i class="fas fa-exclamation-triangle"></i> Confirm Delete
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-black">
                                            Are you sure you want to delete this gift? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('gifts.destroy', $gift->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
