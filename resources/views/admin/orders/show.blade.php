@extends('layouts.admin')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Order #{{ $order->id }} Details</h6>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                <i class="fas fa-edit"></i> Update Status
            </button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Order Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Order ID</th>
                        <td>#{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Date Placed</th>
                        <td>{{ $order->date_placed->format('F d, Y') }}</td>
                    </tr>
                    @if($order->date_shipped)
                    <tr>
                        <th>Date Shipped</th>
                        <td>{{ $order->date_shipped->format('F d, Y') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $order->status->name === 'Pending' ? 'warning' : ($order->status->name === 'Processing' ? 'info' : ($order->status->name === 'Shipped' ? 'primary' : ($order->status->name === 'Delivered' ? 'success' : 'danger'))) }}">
                                {{ $order->status->name }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Shipping Cost</th>
                        <td>₱{{ number_format($order->shipping, 2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Customer Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $order->customer->title ?? '' }} {{ $order->customer->fname }} {{ $order->customer->lname }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->customer->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $order->customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $order->customer->addressline }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <h5>Order Items</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach($order->orderlines as $line)
                        @php $subtotal += $line->price * $line->quantity; @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($line->item->primaryImage)
                                        <img src="/storage/{{ $line->item->primaryImage->image_path }}" alt="{{ $line->item->title }}" class="img-thumbnail me-3" style="width: 50px;">
                                    @else
                                        <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $line->item->title }}" class="img-thumbnail me-3" style="width: 50px;">
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.items.show', $line->item) }}">{{ $line->item->title }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>₱{{ number_format($line->price, 2) }}</td>
                            <td>{{ $line->quantity }}</td>
                            <td>₱{{ number_format($line->price * $line->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Subtotal:</th>
                        <td>₱{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-end">Shipping:</th>
                        <td>₱{{ number_format($order->shipping, 2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <td class="fw-bold">₱{{ number_format($subtotal + $order->shipping, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($order->notes)
            <div class="mt-4">
                <h5>Notes</h5>
                <div class="card">
                    <div class="card-body">
                        {{ $order->notes }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status_id" class="form-label">Status</label>
                        <select name="status_id" id="status_id" class="form-control">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_shipped" class="form-label">Shipping Date</label>
                        <input type="date" name="date_shipped" id="date_shipped" class="form-control" value="{{ $order->date_shipped ? $order->date_shipped->format('Y-m-d') : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control">{{ $order->notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

