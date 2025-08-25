<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\TicketSeat;
use Carbon\Carbon;

class TicketSeatsSheet implements FromQuery, WithTitle, WithHeadings, WithMapping
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
        $query = TicketSeat::whereHas('ticket', function($q) {
            $q->where('company_id', $this->companyId);
        })->with(['ticket']);
        
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
            'Seat Number',
            'Fare',
            'Status',
            'Booking Date'
        ];
    }

    public function map($seat): array
    {
        return [
            $seat->id,
            $seat->ticket->ticket_number,
            $seat->seat_number,
            $seat->fare,
            $seat->status,
            $seat->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function title(): string
    {
        return 'Ticket Seats';
    }
}