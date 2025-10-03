<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Exports\CompanyFullDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CompanyDataExport extends Component
{
    public $startDate;
    public $endDate;
    public $exportInProgress = false;
  public $company;
    protected $rules = [
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate'
    ];

    public function export()
    {
        $this->validate();
        $this->exportInProgress = true;
        
       
        $this->company = auth()->user()->company;
         $companyId = $this->company->id;
        return Excel::download(
            new CompanyFullDataExport($companyId, $this->startDate, $this->endDate),
            'company_data_'.$this->startDate.'_to_'.$this->endDate.'.xlsx'
        )->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.admin.company-data-export');
    }
}