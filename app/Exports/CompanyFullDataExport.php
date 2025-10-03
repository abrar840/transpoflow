<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

// Ensure the individual sheet classes are imported
use App\ExportsCompanyInfoSheet;
use App\Exports\RoutesSheet;
use App\Exports\VehiclesSheet;
use App\Exports\SchedulesSheet;
use App\Exports\TicketsSheet;
use App\Exports\TicketSeatsSheet;
use App\Exports\CargoBookingsSheet;
 
 
class CompanyFullDataExport implements WithMultipleSheets
{
    protected $companyId;
    protected $startDate;
    protected $endDate;

    public function __construct($companyId, $startDate = null, $endDate = null)
    {
        $this->companyId = $companyId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        return [
            new CompanyInfoSheet($this->companyId),
            new RoutesSheet($this->companyId, $this->startDate, $this->endDate),
            new VehiclesSheet($this->companyId, $this->startDate, $this->endDate),
            new SchedulesSheet($this->companyId, $this->startDate, $this->endDate),
            new TicketsSheet($this->companyId, $this->startDate, $this->endDate),
            new TicketSeatsSheet($this->companyId, $this->startDate, $this->endDate),
            new CargoBookingsSheet($this->companyId, $this->startDate, $this->endDate),
        ];
    }
}