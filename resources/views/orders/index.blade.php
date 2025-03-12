@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>My Orders</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(count($orders) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->date_placed->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status->name === 'Pending' ? 'warning' : ($order->status->name === 'Processing' ? 'info' : ($order->status->name === 'Shipped' ? 'primary' : ($order->status->name === 'Delivered' ? 'success' : 'danger'))) }}">
                                    {{ $order->status->name }}
                                </span>
                            </td>
                            <td>
                                ${{ number_format($order->orderlines->sum(function($line) {
                                    return $line->price * $line->quantity;
                                }) + $order->shipping, 2) }}
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <p>You haven't placed any orders yet.</p>
            <a href="{{ route('items.index') }}" class="btn btn-primary">Browse Manga</a>
        </div>
    @endif
</div>
@endsection

