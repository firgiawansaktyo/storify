@extends('layouts.admin')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 mt-2 p-2">
        <p class="mb-0 text-white">Guests</p>

        <div class="d-flex align-items-center gap-1">
            <a href="{{ route('invited-guests.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create
            </a>

            <form action="{{ route('import.handle') }}" method="post" enctype="multipart/form-data" class="d-flex">
                @csrf
                <input type="file" class="form-control mr-2" name="file" accept=".xlsx,.xls,.csv" required>
                <button class="btn btn-spotify" type="submit">Import</button>
            </form>

            <form action="{{ route('invited-guests.index') }}" method="GET" class="d-flex">
                <input
                    type="text"
                    name="q"
                    class="form-control mr-2"
                    placeholder="Search name..."
                    value="{{ request('q') }}"
                    autocomplete="off"
                >
                <button class="btn btn-outline-light mr-2" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('q'))
                    <a href="{{ route('invited-guests.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Invited Guest List</h6>
            @if(request('q'))
                <span class="text-white-50">
                    Search: <strong>{{ request('q') }}</strong> — {{ $invitedGuests->total() }} result{{ $invitedGuests->total() === 1 ? '' : 's' }}
                </span>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-center justify-center">
                            <th class="text-white">No</th>
                            <th class="text-white">Name</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($invitedGuests as $invitedGuest)
                        <tr class="text-center justify-center">
                            <!-- Correct number across pages -->
                            <td class="text-white">{{ $invitedGuests->firstItem() + $loop->index }}</td>
                            <td class="text-white">{{ $invitedGuest->name }}</td>
                            <td class="text-white d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('invited-guests.edit', $invitedGuest->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $invitedGuest->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="social-share-buttons">
                                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode(($messageTemplate ?? '') . "\n\n" . url(($userName ?? 'user') . '/invite/'. $invitedGuest->slug)) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-success">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal-{{ $invitedGuest->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-black">
                                        <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm Delete</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-black">
                                        Are you sure you want to delete {{ $invitedGuest->name }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('invited-guests.destroy', $invitedGuest->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-white-50">
                                @if(request('q'))
                                    No guests found for “{{ request('q') }}”.
                                @else
                                    No invited guests yet.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-white-50 small">
                    @if($invitedGuests->total() > 0)
                        Showing {{ $invitedGuests->firstItem() }}–{{ $invitedGuests->lastItem() }}
                        of {{ $invitedGuests->total() }}
                    @endif
                </div>
                <div class="spotify-pagination">
                    {{ $invitedGuests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
