<!-- resources/views/pdf/ticket.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Bus Ticket - {{ $ticket->ticket_number }}</title>
    <style>
        @page { margin: 0; padding: 0; size: 80mm 50mm; }
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 5mm;
            font-size: 9pt;
            background-color: #f5f5f5;
        }
        .ticket {
            width: 100%;
            border: 1px dashed #ccc;
            background: white;
            position: relative;
            overflow: hidden;
        }
        .ticket-header {
            background: #3a7bd5;
            color: white;
            padding: 5px;
            text-align: center;
            font-weight: bold;
        }
        .ticket-body {
            padding: 5px;
        }
        .row {
            display: flex;
            margin-bottom: 3px;
        }
        .col {
            flex: 1;
        }
        .col-2 {
            flex: 2;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
        }
        .barcode {
            text-align: center;
            margin-top: 5px;
            font-family: 'Libre Barcode 128', cursive;
            font-size: 20pt;
            letter-spacing: 2px;
        }
        .divider {
            border-top: 1px dashed #ccc;
            margin: 5px 0;
        }
        .footer {
            font-size: 7pt;
            text-align: center;
            color: #777;
            margin-top: 5px;
        }
        .status {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 8pt;
        }
        .status-paid {
            background: #4CAF50;
            color: white;
        }
        .status-pending {
            background: #FFC107;
            color: black;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="ticket-header">
            {{ $ticket->company->name }} - E-TICKET
        </div>
        
        <div class="ticket-body">
            <div class="row">
                <div class="col">
                    <span class="label">Ticket No:</span>
                    <span class="value">{{ $ticket->ticket_number }}</span>
                </div>
                <div class="col">
                    <span class="label">Date:</span>
                    <span class="value">{{ $ticket->booking_date->format('d/m/Y') }}</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <span class="label">Passenger:</span>
                    <span class="value">{{ $ticket->passenger_name }}</span>
                </div>
                <div class="col">
                    <span class="label">Seat:</span>
                    <span class="value">{{ $ticket->seat_number }}</span>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="row">
                <div class="col-2">
                    <span class="label">From:</span>
                    <span class="value">{{ $ticket->route->departure_city }}</span>
                </div>
                <div class="col-2">
                    <span class="label">To:</span>
                    <span class="value">{{ $ticket->route->arrival_city }}</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <span class="label">Departure:</span>
                    <span class="value">{{ $ticket->schedule->departure_time }}</span>
                </div>
                <div class="col">
                    <span class="label">Bus No:</span>
                    <span class="value">{{ $ticket->vehicle->registration_number }}</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <span class="label">Type:</span>
                    <span class="value">{{ $ticket->vehicle->vehicle_type }}</span>
                </div>
                <div class="col">
                    <span class="label">Fare:</span>
                    <span class="value">Rs {{ number_format($ticket->total_amount, 2) }}</span>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="row">
                <div class="col">
                    <span class="label">Status:</span>
                    <span class="status status-{{ $ticket->payment_status }}">
                        {{ strtoupper($ticket->payment_status) }}
                    </span>
                </div>
                <div class="col">
                    <span class="label">Valid Until:</span>
                    <span class="value">{{ $ticket->valid_until->format('d/m/Y H:i') }}</span>
                </div>
            </div>
            
            <div class="barcode">
                *{{ $ticket->ticket_number }}*
            </div>
            
            <div class="footer">
                Present this ticket to board the bus | No refund after departure
            </div>
        </div>
    </div>
</body>
</html>