@extends('layouts.admin')

@section('title', 'Customer: ' . $customer->fname . ' ' . $customer->lname)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
        <div>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Personal Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $customer->title ? $customer->title . ' ' : '' }}{{ $customer->fname }} {{ $customer->lname }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $customer->addressline }}</td>
                    </tr>
                    <tr>
                        <th>Registered On</th>
                        <td>{{ $customer->created_at->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated</th>
                        <td>{{ $customer->updated_at->format('F d, Y') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Order Summary</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Total Orders</th>
                        <td>{{ $customer->orders->count() }}</td>
                    </tr>
                    <tr>
                        <th>Total Spent</th>
                        <td>${{ number_format($customer->orders->sum('total'), 2) }}</td>
                    </tr>
                    <tr>
                        <th>Last Order</th>
                        <td>
                            @if($customer->orders->count() > 0)
                                {{ $customer->orders->sortByDesc('created_at')->first()->created_at->format('F d, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <h5 class="mt-4">Order History</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                @if(is_object($order->status))
                                    <span class="badge bg-{{ 
                                        $order->status->name === 'Pending' ? 'warning' : 
                                        ($order->status->name === 'Processing' ? 'info' : 
                                        ($order->status->name === 'Shipped' ? 'primary' : 
                                        ($order->status->name === 'Delivered' ? 'success' : 'danger'))) 
                                    }}">
                                        {{ $order->status->name }}
                                    </span>
                                @else
                                    @php
                                        // Fallback for when status is not an object (might be a JSON string)
                                        $statusName = $order->status;
                                        $badgeClass = 'bg-secondary';
                                        
                                        if (is_string($statusName) && strpos($statusName, '{"id":') === 0) {
                                            $statusData = json_decode($statusName, true);
                                            $statusName = $statusData['name'] ?? 'Unknown';
                                        }
                                        
                                        // Determine badge color based on status name
                                        if (stripos($statusName, 'Pending') !== false) $badgeClass = 'bg-warning';
                                        if (stripos($statusName, 'Processing') !== false) $badgeClass = 'bg-info';
                                        if (stripos($statusName, 'Shipped') !== false) $badgeClass = 'bg-primary';
                                        if (stripos($statusName, 'Delivered') !== false) $badgeClass = 'bg-success';
                                        if (stripos($statusName, 'Cancelled') !== false) $badgeClass = 'bg-danger';
                                    @endphp
                                    
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $statusName }}
                                    </span>
                                @endif
                            </td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection