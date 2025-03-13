@extends('layouts.admin')

@section('title', 'Manage Manga')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Manga List</h6>
        <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Manga
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="itemsTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Genres</th>
                        <th>Author</th>
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
        $('#itemsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.items.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'genres_list', name: 'genres_list' },
                { data: 'author', name: 'author' },
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
    });
</script>
@endsection

