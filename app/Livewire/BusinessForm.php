<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Service;
use App\Models\CompanyService;
use App\Models\ColorPalette;
use App\Models\CompanyTheme;
use App\Models\User;

class BusinessForm extends Component
{
    use WithFileUploads;

    //form fields 
    public $name, $type, $address, $email, $logo, $num_employees, $admin_username, $user_id;
    public $services = [];
    public $colorPalette;

    // Data for dropdowns
    public $availableServices;
    public $colorPalettes;
    public $theme = 'light';

    public $logopath;

    // Initialize data
    public function mount($theme)
    {


        $this->theme = $theme;
        $this->user_id = auth()->user()->id;
        $this->email = auth()->user()->email;

        if (auth()->user()->company && auth()->user()->company->exists) {
            return redirect(route('AdminPanel'));
        }

        $this->availableServices = Service::all();
        $this->colorPalettes = ColorPalette::all();
    }

    protected $rules = [
        'name' => 'string|max:255|unique:companies,name',
        'type' => 'required|in:fleet,shuttle,transport',
        'email' => 'required|email|unique:companies,email',
        'address' => 'nullable|string|alpha_num|max:255',
        'logo' => 'nullable|image|max:2048',
        'admin_username' => 'required|string|max:225',
        'num_employees' => 'in:<5,5-20,20-100,100-250,>250',
        'services' => 'required|array|min:1',
        'services.*' => 'exists:services,id',
    ];

    protected $messages = [
        'admin_username' => 'the admin user name may contain letters',
        'name.string' => 'The company name must be a string.',
        'name.max' => 'The company name may not be greater than 255 characters.',
        'name.unique' => 'This company name is already taken.',
        'type.required' => 'The company type is required.',
        'type.in' => 'The company type must be one of: fleet, shuttle, or transport.',
        'email.required' => 'The email address is required.',
        'email.email' => 'Please provide a valid email address.',
        'email.unique' => 'This email address is already registered.',
        'address.string' => 'The address must be a string.',
        'address.max' => 'The address may not be greater than 255 characters.',
        'logo.image' => 'The logo must be an image.',
        'logo.max' => 'The logo must not be larger than 2MB.',
        'admin_username.required' => 'The admin username is required.',
        'admin_username.string' => 'The admin username must be a string.',
        'admin_username.max' => 'The admin username may not be greater than 225 characters.',
        'num_employees.in' => 'Please select a valid number of employees.',
        'services.required' => 'At least one service must be selected.',
        'services.array' => 'The services field must be an array.',
        'services.*.exists' => 'One or more selected services are invalid.',
    ];

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $this->logopath = $this->handleLogoUpload();
            $company = $this->createCompany($this->logopath);

            $this->attachServices($company);
            $this->attachColorPalette($company);
            $this->attachCompanyToUser($company); // Add this line
        });

        session()->flash('success', 'Company registered successfully');
        $this->reset();
        redirect()->route("AdminPanel");
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
            'logo' => $this->logopath,
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

    protected function attachColorPalette($company)
    {
        CompanyTheme::create([
            'company_id' => $company->id,
            'theme' => $this->theme,
        ]);
    }

    // New method to attach company to user
    protected function attachCompanyToUser($company)
    {
        $user = User::find($this->user_id);
        $user->company_id = $company->id;
        $user->save();
    }

    public function render()
    {
        return view('livewire.business-form', [
            'availableSerivces' => $this->availableServices,
        ])->layout('layouts.user');
    }
}