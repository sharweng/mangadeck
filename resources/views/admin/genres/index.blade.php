@extends('layouts.admin')

@section('title', 'Manage Genres')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Genres List</h6>
        <a href="{{ route('admin.genres.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Genre
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="genresTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Items Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables will populate this -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#genresTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.genres.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'items_count', name: 'items_count' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection

