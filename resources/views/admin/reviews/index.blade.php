@extends('layouts.admin')

@section('title', 'Manage Reviews')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Reviews List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="reviewsTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Manga</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
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
        $('#reviewsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.reviews.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'item', name: 'item' },
                { data: 'user', name: 'user' },
                { data: 'rating', name: 'rating' },
                { data: 'comment', name: 'comment' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[5, 'desc']]
        });
    });
</script>
@endsection

