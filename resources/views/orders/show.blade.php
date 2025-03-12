@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Order #{{ $order->id }}</h1>
            <p class="lead">Placed on {{ $order->date_placed->format('F d, Y') }}</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status->name === 'Pending' ? 'warning' : ($order->status->name === 'Processing' ? 'info' : ($order->status->name === 'Shipped' ? 'primary' : ($order->status->name === 'Delivered' ? 'success' : 'danger'))) }}">
                            {{ $order->status->name }}
                        </span>
                    </p>
                    <p><strong>Order Date:</strong> {{ $order->date_placed->format('F d, Y') }}</p>
                    @if($order->date_shipped)
                        <p><strong>Shipped Date:</strong> {{ $order->date_shipped->format('F d, Y') }}</p>
                    @endif
                    <p><strong>Shipping Cost:</strong> ${{ number_format($order->shipping, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $order->customer->title ?? '' }} {{ $order->customer->fname }} {{ $order->customer->lname }}</p>
                    <p><strong>Address:</strong> {{ $order->customer->addressline }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Order Items</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($order->orderlines as $line)
                            @php $subtotal += $line->price * $line->quantity; @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $line->item->img_path ? asset('storage/'.$line->item->img_path) : asset('images/no-image.jpg') }}" 
                                             alt="{{ $line->item->title }}" class="img-thumbnail me-3" style="width: 50px;">
                                        <div>
                                            <a href="{{ route('items.show', $line->item) }}">{{ $line->item->title }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($line->price, 2) }}</td>
                                <td>{{ $line->quantity }}</td>
                                <td class="text-end">${{ number_format($line->price * $line->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Subtotal:</th>
                            <td class="text-end">${{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Shipping:</th>
                            <td class="text-end">${{ number_format($order->shipping, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Total:</th>
                            <td class="text-end fw-bold">${{ number_format($subtotal + $order->shipping, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @if($order->notes)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Order Notes</h5>
            </div>
            <div class="card-body">
                <p>{{ $order->notes }}</p>
            </div>
        </div>
    @endif
</div>
@endsection

