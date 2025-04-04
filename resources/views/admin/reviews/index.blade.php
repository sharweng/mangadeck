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

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="reviewModalLabel">Review Details</h5>
                <!-- Removed the X button -->
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Manga</h6>
                                <p class="card-text font-weight-bold" id="modal-item"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Customer</h6>
                                <p class="card-text font-weight-bold" id="modal-user"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Rating</h6>
                        <div id="modal-rating" class="d-block fs-4"></div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Comment</h6>
                        <div class="mt-3 p-4 bg-light rounded" id="modal-comment" style="white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#reviewModal').modal('hide');">Close</button>
            </div>
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
                { 
                    data: 'rating', 
                    name: 'rating',
                    render: function(data, type, row) {
                        let stars = '';
                        for (let i = 1; i <= 5; i++) {
                            if (i <= data) {
                                stars += '<i class="fas fa-star text-warning"></i>';
                            } else {
                                stars += '<i class="far fa-star text-warning"></i>';
                            }
                        }
                        return stars;
                    }
                },
                { 
                    data: 'comment', 
                    name: 'comment',
                    render: function(data, type, row) {
                        // Only truncate for display
                        if (type === 'display') {
                            return data.length > 50 ? data.substring(0, 50) + '...' : data;
                        }
                        return data;
                    }
                },
                { 
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data) {
                        return new Date(data).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                    }
                },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[5, 'desc']]
        });
    });

    // Handle review modal
    $(document).on('click', '.view-review', function() {
        const id = $(this).data('id');
        const comment = $(this).data('comment');
        const rating = $(this).data('rating');
        const user = $(this).data('user');
        const item = $(this).data('item');
        
        $('#modal-comment').text(comment);
        $('#modal-user').text(user);
        $('#modal-item').text(item);
        
        // Generate stars for rating
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<i class="fas fa-star text-warning fa-lg"></i>';
            } else {
                stars += '<i class="far fa-star text-warning fa-lg"></i>';
            }
        }
        $('#modal-rating').html(stars);
        
        $('#reviewModal').modal('show');
    });
</script>
@endsection