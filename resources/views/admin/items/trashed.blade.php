@extends('layouts.admin')

@section('title', 'Trashed Manga')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Trashed Manga</h6>
        <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Manga List
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="trashedItemsTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Genres</th>
                        <th>Authors</th>
                        <th>Publisher</th>
                        <th>Deleted At</th>
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
        $('#trashedItemsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.items.trashed.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'genres_list', name: 'genres_list' },
                { data: 'authors_list', name: 'authors_list' },
                { data: 'publisher_name', name: 'publisher_name' },
                { data: 'deleted_at_formatted', name: 'deleted_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection