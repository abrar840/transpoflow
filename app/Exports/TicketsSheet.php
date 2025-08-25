<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketsSheet implements FromQuery, WithTitle, WithHeadings, WithMapping
{
    protected $companyId;
    protected $startDate;
    protected $endDate;

    public function __construct($companyId, $startDate, $endDate)
    {
        $this->companyId = $companyId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        $query = Ticket::where('company_id', $this->companyId)
            ->with(['route', 'schedule', 'seats']);
            
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);
        }
        
        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ticket Number',
            'Passenger Name',
            'Passenger Phone',
            'Passenger Email',
            'Departure City',
            'Arrival City',
            'Travel Date',
            'Departure Time',
            'Total Amount',
            'Payment Status',
            'Booking Date'
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->ticket_number,
            $ticket->passenger_name,
            $ticket->passenger_phone,
            $ticket->passenger_email,
            $ticket->route->departure_city,
            $ticket->route->arrival_city,
            $ticket->travel_date->format('Y-m-d'),
            $ticket->schedule->departure_time,
            $ticket->total_amount,
            $ticket->payment_status,
            $ticket->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function title(): string
    {
        return 'Tickets';
    }
}