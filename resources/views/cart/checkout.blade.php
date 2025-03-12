@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h1 class="mb-4">Checkout</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Shipping Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('cart.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required>{{ $customer ? $customer->addressline : '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_method" class="form-label">Shipping Method</label>
                            <select class="form-select" id="shipping_method" name="shipping_method" required>
                                <option value="standard">Standard Shipping - $10.00 (5-7 business days)</option>
                                <option value="express">Express Shipping - $20.00 (2-3 business days)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_method_cod" value="cod" checked>
                                <label class="form-check-label" for="payment_method_cod">
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        @foreach($items as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item->title }} x {{ $item->cart_quantity }}</span>
                                <span>${{ number_format($item->subtotal, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>${{ number_format($shipping, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between font-weight-bold">
                        <span class="h5">Total</span>
                        <span class="h5">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Customer Information</h5>
                    @if($customer)
                        <p><strong>Name:</strong> {{ $customer->full_name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                        <p><a href="{{ route('profile.edit') }}">Edit profile</a></p>
                    @else
                        <div class="alert alert-warning">
                            Please complete your profile information before checkout.
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-warning mt-2">Update Profile</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

