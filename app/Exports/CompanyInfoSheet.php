<?php

 

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Company;

class CompanyInfoSheet implements FromQuery, WithTitle, WithHeadings
{
    protected $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function query()
    {
        return Company::with("user")->where('id', $this->companyId);
    }

    public function headings(): array
    {
        return [
            'ID',
            'user_id',
            'Name',
            'type',
            'Address',
            'Email',
            'logo',
            'admin_username',
            'num_employees',
            'Created At',
            'Updated At'
        ];
    }

    public function title(): string
    {
        return 'Company Info';
    }
}