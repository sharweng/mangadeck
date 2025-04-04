@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">My Orders</h1>
    
    @if($orders->count() > 0)
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order #</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="ps-4">{{ $order->id }}</td>
                                    <td>{{ $order->date_placed->format('M d, Y') }}</td>
                                    <td>{{ $order->orderLines->sum('quantity') }} item(s)</td>
                                    <td>
                                        @php
                                            $total = $order->orderLines->sum(function($line) {
                                                return $line->price * $line->quantity;
                                            }) + $order->shipping;
                                        @endphp
                                        ${{ number_format($total, 2) }}
                                    </td>
                                    <td>
                                        @switch($order->status->name)
                                            @case('Pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @break
                                            @case('Processing')
                                                <span class="badge bg-info">Processing</span>
                                                @break
                                            @case('Shipped')
                                                <span class="badge bg-primary">Shipped</span>
                                                @break
                                            @case('Delivered')
                                                <span class="badge bg-success">Delivered</span>
                                                @break
                                            @case('Cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                                @break
                                            @case('Returned')
                                                <span class="badge bg-secondary">Returned</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $order->status->name }}</span>
                                        @endswitch
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-shopping-bag fa-4x mb-3 text-muted"></i>
                <h3>No Orders Yet</h3>
                <p class="mb-4">You haven't placed any orders yet.</p>
                <a href="{{ route('items.index') }}" class="btn btn-primary">
                    Start Shopping
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

