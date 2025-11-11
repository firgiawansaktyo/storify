@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2 p-2">
        <h3 class="mb-0 text-white">Throwbacks</h3>
        <a href="{{ route('throwbacks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Throwback Image 
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">Throwback Image List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-center justify-center">
                            <th class="text-white">No</th>
                            <th class="text-white">Owner</th>
                            <th class="text-white">Throwback Title</th>
                            <th class="text-white">Throwback Description</th>                    
                            <th class="text-white">Throwback Image</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($throwbacks as $throwback)
                            <tr class="text-center justify-center">
                                <td class="text-white">{{ $loop->iteration }}</td>
                                <td class="text-white">{{ $throwback->user->username }}</td>
                                <td class="text-white">{{ $throwback->wedding_throwback_title }}</td>
                                <td class="text-white">{{ $throwback->wedding_throwback_description }}</td>
                                <td>
                                    <img    
                                        id="imagePreview"
                                        class="text-center justify-center justify-self-center max-w-sm cursor-pointer"
                                        data-toggle="modal" 
                                        data-target="#imageModalThrowbackImage-{{ $throwback->id }}"
                                        src="{{ old('wedding_throwback_image') ? Storage::disk(env('FILESYSTEM_DISK'))->url(old('wedding_throwback_image')) : (isset($throwback) && $throwback->wedding_throwback_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($throwback->wedding_throwback_image) : '') }}"
                                        alt="Throwback Image"
                                    >
                                    <div class="modal fade" id="imageModalThrowbackImage-{{ $throwback->id }}" tabindex="-1" aria-labelledby="imageModalLabelThrowbackImage-{{ $throwback->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($throwback->wedding_throwback_image) }}" alt="Full Image">
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-white">
                                    <div class="flex flex-col space-y-1">
                                        <!-- Edit button -->
                                        <a href="{{ route('throwbacks.edit', $throwback->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <button 
                                            class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#deleteModal-{{ $throwback->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal-{{ $throwback->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-black">
                                            <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm Delete</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-black">
                                            Are you sure you want to delete this item? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            
                                            <form action="{{ route('throwbacks.destroy', $throwback->id) }}" method="POST">
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
