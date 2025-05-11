<?php





namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CompanyFullDataExport implements WithMultipleSheets
{
    protected $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function sheets(): array
    {
        return [
            new CompanyInfoSheet($this->companyId),
            new RoutesSheet($this->companyId),
            new VehiclesSheet($this->companyId),
            new SchedulesSheet($this->companyId),
            new TicketsSheet($this->companyId),
            new TicketSeatsSheet($this->companyId),
            new CargoBookingsSheet($this->companyId),
        ];
    }
}