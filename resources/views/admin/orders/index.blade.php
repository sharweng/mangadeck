@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="ordersTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
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
        $('#ordersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.orders.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer_name', name: 'customer_name' },
                { 
                    data: 'date_placed', 
                    name: 'date_placed',
                    render: function(data) {
                        return new Date(data).toLocaleDateString();
                    }
                },
                { 
                    data: 'status.name', 
                    name: 'status.name',
                    render: function(data) {
                        let badgeClass = 'bg-secondary';
                        if (data === 'Pending') badgeClass = 'bg-warning';
                        else if (data === 'Processing') badgeClass = 'bg-info';
                        else if (data === 'Shipped') badgeClass = 'bg-primary';
                        else if (data === 'Delivered') badgeClass = 'bg-success';
                        else if (data === 'Cancelled') badgeClass = 'bg-danger';
                        
                        return '<span class="badge ' + badgeClass + '">' + data + '</span>';
                    }
                },
                { 
                    data: 'total', 
                    name: 'total',
                    render: function(data) {
                        return '$' + parseFloat(data).toFixed(2);
                    }
                },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection