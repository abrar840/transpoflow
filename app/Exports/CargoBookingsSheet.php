<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\CargoBook;
use Carbon\Carbon;

class CargoBookingsSheet implements FromQuery, WithTitle, WithHeadings, WithMapping
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
        $query = CargoBook::where('company_id', $this->companyId);
        


            
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
            'Booking Number',
            'Shipper Name',
            'Shipper Phone',
            'Departure City',
            'consignee_name',
            'consignee_phone',
            'consignee_city',
            
         
            'Weight (kg)',
            'volume',

              'weight_charge',
              'volume_charge',
              'service_charge',
            'Total Amount',
            'Status',
            'Booking Date'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->tracking_number,
            $booking->shipper_name,
            $booking->shipper_phone,
            $booking->shipper_city,
            $booking->consignee_name,
            $booking->consignee_phone,
            $booking->consignee_city,
           
            $booking->weight,
            $booking->volume,
  $booking->weight_charge,
    $booking->volume_charge,
    $booking->service_charge,

            $booking->total_amount,
            $booking->status,
            $booking->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function title(): string
    {
        return 'Cargo Bookings';
    }
}