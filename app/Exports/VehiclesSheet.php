<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Vehicle;
use Carbon\Carbon;

class VehiclesSheet implements FromQuery, WithTitle, WithHeadings, WithMapping
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
        $query = Vehicle::where('company_id', $this->companyId);
        
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
            'Registration Number',
            'Vehicle Type',
            'Seating Capacity',
            'Status',
            'Created At',
            'Updated At'
        ];
    }

    public function map($vehicle): array
    {
        return [
            $vehicle->id,
            $vehicle->registration_number,
            $vehicle->vehicle_type,
            $vehicle->seating_capacity,
            $vehicle->status,
            $vehicle->created_at->format('Y-m-d H:i:s'),
            $vehicle->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function title(): string
    {
        return 'Vehicles';
    }
}