<?php

namespace App\Livewire\Admin\Cargo;

use Livewire\Component;
// app/Http/Livewire/Cargo/BookingManager.php
use Barryvdh\DomPDF\Facade\Pdf;
use App\Trait\SharedBookingMethods;



use App\Models\CargoBook;
use App\Models\CargoRoute;

use Livewire\WithFileUploads;
use App\Models\CargoImage;

use App\Models\CargoServiceType;



class BookingManager extends Component
{use SharedBookingMethods;
       use WithFileUploads; 
    // Form Fields
    public $shipper_name, $shipper_phone, $shipper_address, $shipper_city;
    public $consignee_name, $consignee_phone, $consignee_address, $consignee_city;
    public $item_description, $quantity = 1;
    public $weight, $length, $width, $height;
    public $service_type;
    public $insurance = 'no';
    public $images;
    public $volume;
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

    public $uploadedImages = [];
public $tempImagePaths = [];
    public $company;

    public $search;
    public $destination = null;

    public $confirmingDeletion = false;         //delete record confirmation from pop up window
    public $bookingToDelete = null;              //booking is to get deleted
   
    public function mount()
    {
        $this->company = auth()->user()->company;
        $this->availableCities = CargoRoute::where('company_id', $this->company->id)
            ->distinct()
            ->pluck('departure_city')
            ->toArray();
    
        $this->serviceTypes = CargoServiceType::where('company_id', $this->company->id)
            ->where('is_active', true)
            ->get();
            
        $this->loadRoutes(); // Load initial data
    }


    public function findDestination()
    {



        $this->destination = CargoRoute::where('company_id', $this->company->id)
            ->where('departure_city', $this->shipper_city)
            ->distinct()
            ->pluck('arrival_city')
            ->toArray();
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
        ]);

        $volume = $this->length * $this->width * $this->height;

        $charges = CargoBook::calculateCharges([
            'company_id' => $this->company->id,
            'shipper_city' => $this->shipper_city,
            'consignee_city' => $this->consignee_city,
            'weight' => $this->weight,
            'volume' => $volume,
            'service_type' => $this->service_type,
            'quantity'=>$this->quantity
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

        $this->volume = $this->length * $this->width * $this->height;
        // dd(auth()->user()->id);
        // dd("hi");
        $booking = CargoBook::create([
            'company_id' => $this->company->id,
            'user_id' => auth()->user()->id,
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
            'volume' => $this->volume,
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




 

            
            foreach ($this->uploadedImages as $image) {
                $savedPath = $this->handleImageUpload();
                
                if ($savedPath) {
                    CargoImage::create([
                        'cargo_book_id' => $booking->id,
                        'image_path' => $savedPath,
                        'caption' => 'Cargo Image'
                    ]);
                }
            }          
        
  // Clear temporary data
  $this->uploadedImages = [];
  $this->tempImagePaths = [];


        $this->resetForm();
        session()->flash('message', 'Booking created! Tracking #: ' . $booking->tracking_number);
        $this->loadBookings();
    }

    public function resetForm()
    {
        $this->resetExcept(['availableCities', 'serviceTypes', 'company', 'bookings']);
    }


///on cnagoig weigt and voluyme or citities reset tte vlaues 

public function updated($propertyName)
{
    // Reset calculations when input values change
    if (in_array($propertyName, ['shipper_city', 'consignee_city', 'weight', 'length', 'width', 'height', 'service_type'])) {
        $this->resetCalculations();
    }
}

//this functionis for when user change vlaue to check differnt weights and volume
private function resetCalculations()
{
    $this->reset([
        'base_fare',
        'weight_charge',
        'volume_charge',
        'service_charge',
        'total_amount',
        'quantity'
    ]);
}





    //make staus editbale 
    // In your BookingManager.php component
    public $editingStatus = [];
    public $statusOptions = ['pending', 'in_transit', 'dispatched', 'delivered'];

    public function updateStatus($bookingId)
    {
        $this->validate([
            'editingStatus.' . $bookingId => 'required|in:' . implode(',', $this->statusOptions)
        ]);

        $booking = CargoBook::findOrFail($bookingId);
        $booking->update(['status' => $this->editingStatus[$bookingId]]);

        session()->flash('status_message', 'Status updated successfully!');
        $this->loadBookings(); // Refresh the bookings list
    }

    public function loadBookings()
    {
        $this->bookings = CargoBook::where('company_id', $this->company->id)
            ->latest()
            ->limit(10)
            ->get();
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
        $this->bookings = $query->latest()->limit(10)->get();
    }




    public function updatedSearch()
    {
        $this->loadRoutes();
    }



public function confirmDelete($bookingId){

    $this->bookingToDelete = $bookingId;
    $this->confirmingDeletion = true;

}



public function deleteBooking(){

    CargoBook::find($this->bookingToDelete)->delete();
    $this->confirmingDeletion = false;
    $this->bookingToDelete = null;
    $this->loadBookings(); // Refresh the list
    session()->flash('message', 'Booking deleted successfully');

}




    public function render()
    {
        // In your render() method
        // $this->bookings = CargoBook::with(['user'])
        //     ->where('company_id', $this->company->id)
        //     ->latest()
        //     ->limit(10)
        //     ->get();   tis was overriding te serc result that why its is now moved to mount mehtoid and commented here 


            
        return view('livewire.admin.cargo.booking-manager');
    }
}