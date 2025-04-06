<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .receipt-title {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .receipt-id {
            font-size: 16px;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h3 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .total-section {
            margin-top: 20px;
        }
        .total-row {
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">MangaDeck</div>
        <div class="receipt-title">ORDER RECEIPT</div>
        <div class="receipt-id">Order #{{ $order->id }}</div>
    </div>
    
    <div class="info-grid">
        <div class="info-section">
            <h3>Order Information</h3>
            <p><strong>Order Date:</strong> {{ $order->date_placed->format('F j, Y') }}</p>
            <p><strong>Order Status:</strong> {{ $order->status->name }}</p>
            @if($order->date_shipped)
                <p><strong>Shipped Date:</strong> {{ $order->date_shipped->format('F j, Y') }}</p>
            @endif
        </div>
        
        <div class="info-section">
            <h3>Customer Information</h3>
            <p><strong>Name:</strong> {{ $order->customer->full_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer->user->email }}</p>
            <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
        </div>
    </div>
    
    <div class="info-section">
        <h3>Shipping Address</h3>
        <p>{{ $order->customer->addressline }}</p>
        <p><strong>Shipping Notes:</strong> {{ $order->notes ?? 'None' }}</p>
    </div>
    
    <div class="info-section">
        <h3>Order Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderLines as $line)
                <tr>
                    <td>{{ $line->item->title }}</td>
                    <td>{{ $line->quantity }}</td>
                    <td>₱{{ number_format($line->price, 2) }}</td>
                    <td>₱{{ number_format($line->price * $line->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="total-section">
            <table>
                <tr>
                    <td style="text-align: right;"><strong>Subtotal:</strong></td>
                    <td style="width: 100px;">₱{{ number_format($order->orderLines->sum(function($line) { return $line->price * $line->quantity; }), 2) }}</td>
                </tr>
                <tr>
                    <td style="text-align: right;"><strong>Shipping:</strong></td>
                    <td>₱{{ number_format($order->shipping, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td style="text-align: right;"><strong>Total:</strong></td>
                    <td>₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>&copy; {{ date('Y') }} MangaDeck. All rights reserved.</p>
    </div>
</body>
</html>

