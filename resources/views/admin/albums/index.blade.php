@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2 p-2">
        <h3 class="mb-0 text-white">Albums</h3>
            <a href="{{ route('albums.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Album Image 
            </a>
    </div>

        <!-- Table -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">Album Image List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr class="text-center justify-center">
                    <th class="text-white">No</th>
                    <th class="text-white">Owner</th>
                    <th class="text-white">Album Title</th>
                    <th class="text-white">Album Description</th>                    
                    <th class="text-white">Album Image</th>
                    <th class="text-white">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($albums as $album)
                    <tr class="text-center justify-center">
                        <td class="text-white">{{ $loop->iteration }}</td>
                        <td class="text-white">{{ $album->user->username }}</td>
                        <td class="text-white">{{ $album->wedding_album_title }}</td>
                        <td class="text-white">{{ $album->wedding_album_description }}</td>
                        <td>
                            <img    
                            id="imagePreview"
                            class="text-center justify-center justify-self-center"
                            style="max-width: 300px; cursor: pointer;" 
                            data-toggle="modal" 
                            data-target="#imageModalAlbumImage-{{ $album->id }}"
                            src="{{ old('wedding_album_image') ? asset('storage/' . old('wedding_album_image')) : (isset($album) && $album->wedding_album_image ? asset('storage/' . $album->wedding_album_image) : '') }}">
                            <div class="modal fade" id="imageModalAlbumImage-{{ $album->id }}" tabindex="-1" aria-labelledby="imageModalLabelAlbumImage-{{ $album->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <img src="{{ asset('storage/' . $album->wedding_album_image) }}" alt="Full Image">
                                </div>
                            </div>
                            </div>
                        </td>

                        <td class="text-white">
                            <div class="flex flex-col space-y-1">
                                
                                <!-- Edit button -->
                                <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete button -->
                                <button 
                                    class="btn btn-sm btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal-{{ $album->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $album->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                    
                                    <!-- Example form for Delete -->
                                    <form action="{{ route('albums.destroy', $album->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Add more rows dynamically -->
                </tbody>
            </table>
            </div>
        </div>
    </div>


@endsection



