<!DOCTYPE html>
<html>
<head>
    <title>Booking Slip - {{ $booking->tracking_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 15px; }
        .section { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Booking Slip</h2>
        <h3>Tracking #: {{ $booking->tracking_number }}</h3>
    </div>
    
    <div class="section">
        <div class="details">
            <span class="label">Booked By:</span>
            @if($booking->user->guard_name == 'web')
                Admin
            @else
                End User
            @endif
        </div>
        <div class="details">
            <span class="label">Status:</span> {{ ucfirst($booking->status) }}
        </div>
        <div class="details">
            <span class="label">Date:</span> {{ $booking->created_at->format('d M Y H:i') }}
        </div>
    </div>
    
    <div class="section">
        <h4>Shipper Information</h4>
        <div class="details">{{ $booking->shipper_name }}</div>
        <div class="details">{{ $booking->shipper_phone }}</div>
        <div class="details">{{ $booking->shipper_address }}</div>
        <div class="details">{{ $booking->shipper_city }}</div>
    </div>
    
    <div class="section">
        <h4>Consignee Information</h4>
        <div class="details">{{ $booking->consignee_name }}</div>
        <div class="details">{{ $booking->consignee_phone }}</div>
        <div class="details">{{ $booking->consignee_address }}</div>
        <div class="details">{{ $booking->consignee_city }}</div>
    </div>
    
    <div class="section">
        <h4>Shipment Details</h4>
        <div class="details">
            <span class="label">Item:</span> {{ $booking->item_description }}
        </div>
        <div class="details">
            <span class="label">Weight:</span> {{ $booking->weight }} kg
        </div>
        <div class="details">
            <span class="label">Volume:</span> {{ $booking->volume }} cm³
        </div>
    </div>
    
    <div class="section">
        <h4>Payment Details</h4>
        <div class="details">
            <span class="label">Total Amount:</span> Rs {{ number_format($booking->total_amount, 2) }}
        </div>
    </div>
</body>
</html>