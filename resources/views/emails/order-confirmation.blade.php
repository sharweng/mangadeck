<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #dee2e6;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .total-row {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Order Confirmation</h1>
        <p>Thank you for your order!</p>
    </div>
    
    <div class="content">
        <p>Dear {{ $order->customer->full_name }},</p>
        
        <p>Your order has been received and is now being processed. Here's a summary of your purchase:</p>
        
        <h3>Order #{{ $order->id }}</h3>
        <p><strong>Date:</strong> {{ $order->date_placed->format('F j, Y') }}</p>
        <p><strong>Status:</strong> {{ $order->status->name }}</p>
        
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
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Shipping:</strong></td>
                    <td>₱{{ number_format($order->shipping, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                    <td>₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        <h3>Shipping Information</h3>
        <p>{{ $order->customer->addressline }}</p>
        
        <p>We've attached a receipt to this email for your records. If you have any questions about your order, please contact our customer service team.</p>
        
        <p>Thank you for shopping with us!</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} MangaDeck. All rights reserved.</p>
    </div>
</body>
</html>

