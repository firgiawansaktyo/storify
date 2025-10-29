@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2 p-2">
        <h3 class="mb-0 text-white">Weddings</h3>
            <a href="{{ route('weddings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Wedding Invitation
            </a>
    </div>

        <!-- Table -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-white">Wedding Invitation List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr class="text-center justify-center">
                    <th class="text-white">No</th>
                    <th class="text-white">Owner</th>
                    <th class="text-white">Title</th>
                    <th class="text-white">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($weddings as $wedding)
                    <tr class="text-center justify-center">
                        <td class="text-white">{{ $loop->iteration }}</td>
                        <td class="text-white">{{ $wedding->user->username }}</td>
                        <td class="text-white">{{ $wedding->wedding_title }}</td>
                        <td class="text-white">
                            <div class="flex flex-col space-y-1">
                                <!-- View button -->
                                <a href="{{ route('weddings.show', $wedding->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Edit button -->
                                <a href="{{ route('weddings.edit', $wedding->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete button -->
                                <button 
                                    class="btn btn-sm btn-danger" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal-{{ $wedding->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $wedding->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                    <form action="{{ route('weddings.destroy', $wedding->id) }}" method="POST">
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





