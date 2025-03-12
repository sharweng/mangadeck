@extends('layouts.admin')

@section('title', 'Customer: ' . $customer->name)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
        <div>
            <button type="button" class="btn btn-{{ $customer->status === 'active' ? 'warning' : 'success' }}" data-bs-toggle="modal" data-bs-target="#statusModal">
                <i class="fas fa-{{ $customer->status === 'active' ? 'ban' : 'check' }}"></i> 
                {{ $customer->status === 'active' ? 'Deactivate' : 'Activate' }} Customer
            </button>
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
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $customer->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>
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
                                <span class="badge bg-{{ $order->status === 'Pending' ? 'warning' : ($order->status === 'Processing' ? 'info' : ($order->status === 'Shipped' ? 'primary' : ($order->status === 'Delivered' ? 'success' : 'danger'))) }}">
                                    {{ $order->status }}
                                </span>
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

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">
                    {{ $customer->status === 'active' ? 'Deactivate' : 'Activate' }} Customer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to {{ $customer->status === 'active' ? 'deactivate' : 'activate' }} <strong>{{ $customer->name }}</strong>?
                @if($customer->status === 'active')
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle"></i> This will prevent the customer from logging in.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="{{ $customer->status === 'active' ? 'deactivated' : 'active' }}">
                    <button type="submit" class="btn btn-{{ $customer->status === 'active' ? 'warning' : 'success' }}">
                        {{ $customer->status === 'active' ? 'Deactivate' : 'Activate' }} Customer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

