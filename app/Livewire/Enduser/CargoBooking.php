<?php


namespace App\Livewire\EndUser;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CargoBook;
use App\Models\Company;
use App\Models\CargoRoute;
use App\Models\CargoServiceType;
use Barryvdh\DomPDF\Facade\Pdf;


 

class CargoBooking extends Component
{ 



 
    // Form Fields
    public $shipper_name, $shipper_phone, $shipper_address, $shipper_city;
    public $consignee_name, $consignee_phone, $consignee_address, $consignee_city;
    public $item_description, $quantity = 1;
    public $weight, $length, $width, $height;
    public $service_type;
    public $tracking_number;
    public $tracking_status;
    public $theme='light';
    public $insurance = 'no';
    public $user_request;

    // Calculated Values
    public $base_fare = 0;
    public $weight_charge = 0;
    public $volume_charge = 0;
    public $service_charge = 0;
    public $total_amount = 0;

    // Data
    public $availableCities = [];
    public $serviceTypes = [];
    public $bookings = [];
    public $company;

    public $search;
    public $destination = null;

    

    public function mount(Company $company)
    {   $this->theme = $company->theme ?? 'light';
        $this->company = $company;
         
        session(['end_user_guard' => $company]);


           if(!$company){
        $this->company = session('end_user_guard');

    }


        if (!$this->company) {
            abort(404); // Company not found, show 404 page
        }

        // Check if company has a theme (assuming relation: $company->theme or $company->companyTheme)
        

        // $this->user_request=$user;
        
        $this->company = auth()->user()->company;
        $this->availableCities = CargoRoute::where('company_id', $this->company->id)
            ->distinct()
            ->pluck('departure_city')
            ->toArray();



        $this->serviceTypes = CargoServiceType::where('company_id', $this->company->id)
            ->where('is_active', true)
            ->get();


            $this->loadUserBookings();
    }




    public function loadUserBookings()
    {
        $this->bookings = CargoBook::where('company_id', $this->company->id)
            ->where('user_id', auth('end_user')->id())
            ->latest()
            ->get();
    }










    public function findDestination()
    {
            $this->destination = CargoRoute::where('company_id', $this->company->id)
            ->where('departure_city', $this->shipper_city)
            ->distinct()
            ->pluck('arrival_city')
            ->toArray();
    }




    public function downloadSlip($bookingId)
    {
        $booking = CargoBook::findOrFail($bookingId);
        $pdf = Pdf::loadView('pdf.bookingSlip', compact('booking'));
        
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "booking-slip-{$booking->tracking_number}.pdf"
        );
    }








    public function calculateCharges()
    {
        $this->validate([
            'shipper_city' => 'required',
            'consignee_city' => 'required',
            'weight' => 'required|numeric|min:0.1',
            'length' => 'required|numeric|min:1',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1'
        ], [
            'shipper_city.required' => 'The shipper city is required.',
            'consignee_city.required' => 'The consignee city is required.',
            'weight.required' => 'The weight is required.',
            'weight.numeric' => 'The weight must be a number.',
            'weight.min' => 'The weight must be at least 0.1.',
            'length.required' => 'The length is required.',
            'length.numeric' => 'The length must be a number.',
            'length.min' => 'The length must be at least 1.',
            'width.required' => 'The width is required.',
            'width.numeric' => 'The width must be a number.',
            'width.min' => 'The width must be at least 1.',
            'height.required' => 'The height is required.',
            'height.numeric' => 'The height must be a number.',
            'height.min' => 'The height must be at least 1.',
        ]);
        

        $volume = $this->length * $this->width * $this->height;

        $charges = CargoBook::calculateCharges([
            'company_id' => $this->company->id,
            'shipper_city' => $this->shipper_city,
            'consignee_city' => $this->consignee_city,
            'weight' => $this->weight,
            'volume' => $volume,
            'service_type' => $this->service_type
        ]);

        $this->base_fare = $charges['base_fare'];
        $this->weight_charge = $charges['weight_charge'];
        $this->volume_charge = $charges['volume_charge'];
        $this->service_charge = $charges['service_charge'];
        $this->total_amount = $charges['total_amount'];
    }

    public function createBooking()
    {
        $this->validate([
            'shipper_name' => 'required',
            'shipper_phone' => 'required',
            'consignee_name' => 'required',
            'consignee_phone' => 'required',
            'item_description' => 'required'
        ]);

        $volume = $this->length * $this->width * $this->height;
        // dd(auth()->user()->id);
        // dd("hi");
        $booking = CargoBook::create([
            'company_id' => $this->company->id,
            'user_id' => auth('end_user')->user()->id,
            'tracking_number' => 'CRG-' . strtoupper(uniqid()),

            // Shipper info
            'shipper_name' => $this->shipper_name,
            'shipper_phone' => $this->shipper_phone,
            'shipper_address' => $this->shipper_address,
            'shipper_city' => $this->shipper_city,

            // Consignee info
            'consignee_name' => $this->consignee_name,
            'consignee_phone' => $this->consignee_phone,
            'consignee_address' => $this->consignee_address,
            'consignee_city' => $this->consignee_city,

            // Shipment details
            'weight' => $this->weight,
            'volume' => $volume,
            'item_description' => $this->item_description,
            'quantity' => $this->quantity,

            // Pricing
            'base_fare' => $this->base_fare,
            'weight_charge' => $this->weight_charge,
            'volume_charge' => $this->volume_charge,
            'service_charge' => $this->service_charge,
            'total_amount' => $this->total_amount,

            'status' => 'pending'
        ]);

        //$this->resetForm();
       
        session()->flash('message', 'Booking created! Tracking #: ' . $booking->tracking_number);
       
    }

    public function resetForm()
    {
        $this->resetExcept(['availableCities', 'serviceTypes', 'company', 'bookings']);
    }


    //make staus editbale 
    // In your BookingManager.php component
    public $editingStatus = [];
    public $statusOptions = ['pending', 'in_transit', 'dispatched', 'delivered'];

    public function checkStatus()
    {
        $this->validate([
            'tracking_number' => 'required'
        ]);

        $booking = CargoBook::where('tracking_number', $this->tracking_number)
            // ->where('user_id', auth('end_user')->id())
            ->first();

        if ($booking) {
            $this->tracking_status = $booking->status;
        } else {
            $this->dispatch('tracking-error', message: 'Booking not found');
        }
    }








    public function loadRoutes()
    {
        $query = CargoBook::where('company_id', $this->company->id);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('tracking_number', 'like', '%' . $this->search . '%')
                    ->orWhere('consignee_city', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            });
        }

        $this->routes = $query->latest()->get();
    }




    public function updatedSearch()
    {
        $this->loadRoutes();
    }



    public function render()
    {
             return view('livewire.enduser.cargo-booking', [
                    'theme' => $this->theme,
                ])->layout('layouts.user', [
        'company' => $this->company,
       
    ]);
            
}}