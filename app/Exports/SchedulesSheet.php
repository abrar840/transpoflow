<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\VehicleSchedule;
use Carbon\Carbon;

class SchedulesSheet implements FromQuery, WithTitle, WithHeadings, WithMapping
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
        $query = VehicleSchedule::whereHas('vehicle', function($q) {
            $q->where('company_id', $this->companyId);
        })->with(['vehicle', 'route']);
        
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
            'Vehicle Registration',
            'Route',
            'Departure Time',
            'Arrival Time',
            'Status',
            'Created At',
            'Updated At'
        ];
    }

    public function map($schedule): array
    {
        return [
            $schedule->id,
            $schedule->vehicle->registration_number,
            $schedule->route->departure_city.' to '.$schedule->route->arrival_city,
            $schedule->departure_time,
            $schedule->arrival_time,
            $schedule->status,
            $schedule->created_at->format('Y-m-d H:i:s'),
            $schedule->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function title(): string
    {
        return 'Schedules';
    }
}