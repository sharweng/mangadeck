@extends('layouts.admin')

@section('title', 'Manage Manga')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Manga List</h6>
        <div>
            <div class="btn-group me-2">
                <a href="{{ route('admin.items.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export
                </a>
                <a href="{{ route('admin.items.import.form') }}" class="btn btn-info">
                    <i class="fas fa-file-import"></i> Import
                </a>
            </div>
            <a href="{{ route('admin.items.trashed') }}" class="btn btn-warning me-2">
                <i class="fas fa-trash-restore"></i> Trash
            </a>
            <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Manga
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <button class="btn btn-outline-primary btn-sm mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterOptions" aria-expanded="false" aria-controls="filterOptions">
                <i class="fas fa-filter"></i> Show/Hide Filters
            </button>
            
            <div class="collapse" id="filterOptions">
                <div class="p-3 bg-light rounded">
                    <h6 class="mb-3 font-weight-bold">Filter Options</h6>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="genre_filter" class="form-label">Genre</label>
                            <select id="genre_filter" class="form-control">
                                <option value="">All Genres</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="author_filter" class="form-label">Author(s)</label>
                            <input type="text" id="author_filter" class="form-control" placeholder="Enter author names separated by semicolons (;)">
                            <small class="text-muted">Example: Oda; Yamazaki</small>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="publisher_filter" class="form-label">Publisher</label>
                            <select id="publisher_filter" class="form-control">
                                <option value="">All Publishers</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button id="apply_filters" class="btn btn-primary btn-sm">Apply Filters</button>
                        <button id="reset_filters" class="btn btn-secondary btn-sm">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="itemsTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Genres</th>
                        <th>Authors</th>
                        <th>Publisher</th>
                        <th>Price</th>
                        <th>Stock</th>
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
        let table = $('#itemsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.items.data') }}",
                data: function(d) {
                    d.genre_id = $('#genre_filter').val();
                    d.author_names = $('#author_filter').val();
                    d.publisher_id = $('#publisher_filter').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'genres_list', name: 'genres_list' },
                { data: 'authors_list', name: 'authors_list' },
                { data: 'publisher_name', name: 'publisher_name' },
                { 
                    data: 'price', 
                    name: 'price',
                    render: function(data) {
                        return '$' + parseFloat(data).toFixed(2);
                    }
                },
                { 
                    data: 'stock_quantity', 
                    name: 'stock_quantity',
                    render: function(data) {
                        if (data === null) return 'N/A';
                        return data < 5 ? 
                            '<span class="badge bg-danger">' + data + '</span>' : 
                            data;
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });

        // Apply filters
        $('#apply_filters').on('click', function() {
            table.draw();
        });

        // Reset filters
        $('#reset_filters').on('click', function() {
            $('#genre_filter').val('');
            $('#author_filter').val('');
            $('#publisher_filter').val('');
            table.draw();
        });
    });
</script>
@endsection