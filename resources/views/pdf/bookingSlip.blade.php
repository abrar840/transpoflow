<!DOCTYPE html>
<html>
<head>
    <title>Booking Slip - {{ $booking->tracking_number }}</title>
    <style>
        @page { size: 4in 6in; margin: 0; }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0.1in;
            padding: 0;
            line-height: 1.2;
        }

        .header {
            text-align: center;
            margin-bottom: 2px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }

        .company-name {
            font-weight: bold;
            font-size: 10px;
        }

        .tracking-number {
            font-size: 9px;
            margin-top: 1px;
        }

        .section {
            margin-bottom: 4px;
        }

        .section-title {
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 2px;
            border-bottom: 1px dashed #ccc;
        }

        .row {
            display: flex;
            margin-bottom: 1px;
        }

        .label {
            width: 40%;
            font-weight: bold;
        }

        .value {
            width: 60%;
            word-wrap: break-word;
        }

        .footer {
            text-align: center;
            font-size: 7px;
            color: #555;
            margin-top: 3px;
            border-top: 1px dotted #ccc;
            padding-top: 2px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">{{ $booking->company->name ?? 'Shipping Company' }}</div>
        <div class="tracking-number">TRACKING #: {{ $booking->tracking_number }}</div>
    </div>

    <div class="section">
        <div class="section-title">SHIPPER</div>
        <div class="row"><div class="label">Name:</div><div class="value">{{ $booking->shipper_name }}</div></div>
        <div class="row"><div class="label">Phone:</div><div class="value">{{ $booking->shipper_phone }}</div></div>
        <div class="row"><div class="label">City:</div><div class="value">{{ $booking->shipper_city }}</div></div>
    </div>

    <div class="section">
        <div class="section-title">CONSIGNEE</div>
        <div class="row"><div class="label">Name:</div><div class="value">{{ $booking->consignee_name }}</div></div>
        <div class="row"><div class="label">Phone:</div><div class="value">{{ $booking->consignee_phone }}</div></div>
        <div class="row"><div class="label">City:</div><div class="value">{{ $booking->consignee_city }}</div></div>
    </div>

    <div class="section">
        <div class="section-title">SHIPMENT</div>
        <div class="row"><div class="label">Desc:</div><div class="value">{{ $booking->item_description }}</div></div>
        <div class="row"><div class="label">Weight:</div><div class="value">{{ $booking->weight }} kg</div></div>
        <div class="row"><div class="label">Size:</div><div class="value">{{ $booking->length }}×{{ $booking->width }}×{{ $booking->height }} cm</div></div>
        <div class="row"><div class="label">Volume:</div><div class="value">{{ $booking->volume }} cm³</div></div>
    </div>

    <div class="section">
        <div class="section-title">CHARGES</div>
        <div class="row"><div class="label">Base:</div><div class="value">Rs {{ number_format($booking->base_fare, 2) }}</div></div>
        <div class="row"><div class="label">Weight:</div><div class="value">Rs {{ number_format($booking->weight_charge, 2) }}</div></div>
        <div class="row"><div class="label">Volume:</div><div class="value">Rs {{ number_format($booking->volume_charge, 2) }}</div></div>
        <div class="row"><div class="label">Service:</div><div class="value">Rs {{ number_format($booking->service_charge, 2) }}</div></div>
        <div class="row"><div class="label"><strong>Total:</strong></div><div class="value"><strong>Rs {{ number_format($booking->total_amount, 2) }}</strong></div></div>
    </div>

    <div class="footer">
        {{ now()->format('d M Y H:i') }} | Status: {{ strtoupper($booking->status) }}
    </div>
</body>
</html>
