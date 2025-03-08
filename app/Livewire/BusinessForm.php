<?php

namespace App\Livewire;

use Livewire\Component;


use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Service;
use App\Models\CompanyService;
use App\Models\ColorPalette;
use App\Models\CompanyColor;
class BusinessForm extends Component
{

    use WithFileUploads;//

    //form field 

    public $name, $type, $address, $email, $logo, $admin_uername, $num_employees, $admin_username, $user_id;

    public $services = [];

    public $colorPalette;

    // Data for dropdowns
    public $availableServices;
    public $colorPalettes;

    // Initialize data
    public function mount()
    {
        // Fetch data for dropdowns once when the component is loaded
        $this->user_id = auth()->user()->id;
        $this->email = auth()->user()->email;
        $this->availableServices = Service::all();
        $this->colorPalettes = ColorPalette::all();
    }
    protected $rules = [
        'name' => 'string|max:255|unique:companies,name',
        'type' => 'required|in:fleet,shuttle,transport',
        'email' => 'required|email|unique:companies,email',
        'address' => 'nullable|string|max:255',
        'logo' => 'nullable|image|max:2048',
        'admin_username' => 'required|string|max:225',
        'num_employees' => 'in:<5,5-20,20-100,100-250,>250',
        'services' => 'required|array|min:1',
        'services.*' => 'exists:services,id',
        //'colorPalette' => 'exists:color_palettes,id'
    ];

    public function submit()
    {
        // Debugging: Check if the method is being called
        // dd($this->email);

        $this->validate();

        // Debugging: Check if validation passes

        DB::transaction(function () {
            // Debugging: Check if the transaction is being executed


            $logopath = $this->handleLogoUpload();

            $company = $this->createCompany($logopath);


            $this->attachServices($company);
            //  $this->attachColorPalette($company);                             //color paltte functionality curently non functional
        });

        // Flash success message
        session()->flash('success', 'Company registered successfully');

        // Reset form fields
        $this->reset();
        redirect()->route("admin");

        
    }

    protected function handleLogoUpload()
    {
        return $this->logo ? $this->logo->store('logos', 'public') : null;
    }

    protected function createCompany($logopath)
    {
        return Company::create([
            'name' => $this->name,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'address' => $this->address,
            'email' => $this->email,
            'logo' => $logopath,
            'admin_username' => $this->admin_username,
            'num_employees' => $this->num_employees,



        ]);
    }


    protected function attachServices($company)
    {

        foreach ($this->services as $serviceId) {

            CompanyService::create([
                'company_id' => $company->id,
                'service_id' => $serviceId,
            ]);

        }
    }












    // Attach Selected Color Palette to Company
    protected function attachColorPalette($company)
    {
        CompanyColor::create([
            'company_id' => $company->id,
            'color_palette_id' => $this->colorPalette,
        ]);
    }



    public function render()
    {
        return view('livewire.business-form', [
            'availableSerivces' => $this->availableServices,
            'colorPalettes' => $this->colorPalettes,
        ]);
    }
}
