<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Routes;
use Carbon\Carbon;

class RoutesSheet implements FromQuery, WithTitle, WithHeadings, WithMapping
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
        $query = Routes::where('company_id', $this->companyId);
        
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
            'Departure City',
            'Arrival City',
            'Vehicle Type',
            'Fare Per Seat',
            'Created At',
            'Updated At'
        ];
    }

    public function map($route): array
    {
        return [
            $route->id,
            $route->departure_city,
            $route->arrival_city,
            $route->vehicle_type,
            $route->fare_per_seat,
            $route->created_at->format('Y-m-d H:i:s'),
            $route->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function title(): string
    {
        return 'Routes';
    }
}