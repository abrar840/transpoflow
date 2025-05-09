<?php

namespace App\Livewire\EndUser;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CargoBook;
use App\Models\Company;
use App\Models\CargoRoute;
use App\Models\CargoServiceType;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CargoImage;
use Illuminate\Support\Facades\Storage;

class CargoBooking extends Component
{
    use WithFileUploads; // This must be present for file uploads

    // Image upload properties
    public $images = [];
    public $calcultion_details;

    public $path1,$path2;
    public $uploadedImages = [];
    public $tempImagePaths = [];

    // Form Fields
    public $shipper_name, $shipper_phone, $shipper_address, $shipper_city;
    public $consignee_name, $consignee_phone, $consignee_address, $consignee_city;
    public $item_description, $quantity = 1;
    public $weight, $length, $width, $height;
    public $service_type;
    public $tracking_number;
    public $tracking_status;
    public $theme = 'light';
    public $insurance = 'no';

    // Calculated Values

    public $volume;
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

    public $destination = null;

    public function mount(Company $company)
    {
        $this->theme = $company->theme ?? 'light';
        $this->company = $company;
        session(['end_user_guard_theme' => $company]);

        if (!$this->company) {
            $this->company = session('end_user_guard');
            if (!$this->company) {
                abort(404);
            }
        }

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
        
            $this->bookings = CargoBook::with('images')
                ->where('company_id', $this->company->id)
                ->where('user_id', auth('end_user')->id())
                ->where('status', '!=', 'canceled') // Exclude canceled bookings
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

    // Image Upload Methods
    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // 2MB max per image
        ]);
    
        foreach ($this->images as $image) {
            $tempPath = $image->store('tmp/cargo-images', 'public');
            $this->uploadedImages[] = [
                'name' => $image->getClientOriginalName(),
                'temp_path' => $tempPath,
              
                'url' => Storage::url($tempPath), // Use Storage::url() instead
            ];
        }
        $this->images = []; // Clear the uploaded files array
    }

    public function removeImage($index)
    {
        if (isset($this->uploadedImages[$index])) {
            Storage::delete($this->uploadedImages[$index]['temp_path']);
            unset($this->uploadedImages[$index]);
            $this->uploadedImages = array_values($this->uploadedImages);
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes / (1024 ** $pow), $precision) . ' ' . $units[$pow];
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

        $this->volume = $this->length * $this->width * $this->height;

        $charges = CargoBook::calculateCharges([
            'company_id' => $this->company->id,
            'shipper_city' => $this->shipper_city,
            'consignee_city' => $this->consignee_city,
            'weight' => $this->weight,
            'volume' => $this->volume,
            'service_type' => $this->service_type,
            'quantity'=>$this->quantity
        ]);

        $this->base_fare = $charges['base_fare'];
        $this->weight_charge = $charges['weight_charge'];
        $this->volume_charge = $charges['volume_charge'];
        $this->service_charge = $charges['service_charge'];
        $this->total_amount = $charges['total_amount'];
    



    $this->calculation_details = [
        'formula' => "Base Fare + max(Weight Charge, Volume Charge) + (Service Charge × Quantity)",
        'base_fare' => $charges['base_fare'],
        'weight_charge' => $charges['weight_charge'],
        'volume_charge' => $charges['volume_charge'],
        'service_charge' => $charges['service_charge'],
        'quantity' => $this->quantity,
        'total_amount' => $charges['total_amount']
    ];

    }


    public function createBooking()
    {

                if(!auth('end_user')){
                    dd("hi");
                    return $this->redirect(
                        route('end_user_login', ['company' =>$this->company->name]),
                        navigate: true
                    );
                    
                }



                $this->calculateCharges();



        $this->validate([
            'shipper_name' => 'required',
            'shipper_phone' => 'required',
            'consignee_name' => 'required',
            'consignee_phone' => 'required',
            'item_description' => 'required',
            'uploadedImages' => 'array|max:5',
            'weight' => 'required|numeric|min:0.1',
            'length' => 'required|numeric|min:1',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1'
        ]);

        $this->volume = $this->length * $this->width * $this->height;
        
        $booking = CargoBook::create([
            'company_id' => $this->company->id,
            'user_id' => auth('end_user')->id(),
            'tracking_number' => 'CRG-' . strtoupper(uniqid()),
            'shipper_name' => $this->shipper_name,
            'shipper_phone' => $this->shipper_phone,
            'shipper_address' => $this->shipper_address,
            'shipper_city' => $this->shipper_city,
            'consignee_name' => $this->consignee_name,
            'consignee_phone' => $this->consignee_phone,
            'consignee_address' => $this->consignee_address,
            'consignee_city' => $this->consignee_city,
            'weight' => $this->weight,
            'volume' => $this->volume,
            'item_description' => $this->item_description,
            'quantity' => $this->quantity,
            'base_fare' => $this->base_fare,
            'weight_charge' => $this->weight_charge,
            'volume_charge' => $this->volume_charge,
            'service_charge' => $this->service_charge,
            'total_amount' => $this->total_amount,
            'status' => 'pending'
        ]);

        // Process images
        foreach ($this->uploadedImages as $image) {

            
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

            

          
            
        }

        // Clear temporary data
        $this->uploadedImages = [];
        $this->tempImagePaths = [];

        
        // $this->resetForm();
        $this->theme =session('end_user_guard_theme');
   



// Store data needed after reset
$trackingNumber = $booking->tracking_number;
$company = $this->company; // Preserve company instance

// Reset the form
$this->resetForm();

// Reload bookings
$this->loadUserBookings();

// Flash message with tracking number
session()->flash('message', 'Booking created! Tracking #: ' . $trackingNumber);

// Return with company instance
return $this->redirect(
    route('service-page', ['company' => $company->name,'service'=>'CargoManagement']),
    navigate: true
);
















    }


    private function clearForm()
    {
        $this->reset([
            'shipper_name',
            'shipper_phone',
            'shipper_address',
            'shipper_city',
            'consignee_name',
            'consignee_phone',
            'consignee_address',
            'consignee_city',
            'weight',
            'volume',
            'item_description',
            'quantity',
            'base_fare',
            'weight_charge',
            'volume_charge',
            'service_charge',
            'total_amount',
            'uploadedImages',
            'tempImagePaths',
        ]);
    }
    

 
    protected function handleImageUpload()
    {
        foreach ($this->uploadedImages as $image) {
            $newPath = str_replace('tmp/', '', $image['temp_path']);
            
            // Ensure directory exists
            if (!Storage::disk('public')->exists(dirname($newPath))) {
                Storage::disk('public')->makeDirectory(dirname($newPath));
            }
            
            // Move the file
            Storage::disk('public')->move($image['temp_path'], $newPath);
            
            
            return $newPath;
        }
        return null;
    }
    

    public function resetForm()
    {
        $this->resetExcept(['availableCities', 'serviceTypes', 'company', 'bookings']);
    }

    public function checkStatus()
    {
        $this->validate([
            'tracking_number' => 'required'
        ]);

        $booking = CargoBook::where('tracking_number', $this->tracking_number)
            ->where('user_id', auth('end_user')->id())
            ->first();

        if ($booking) {
            $this->tracking_status = $booking->status;
        } else {
            $this->dispatch('tracking-error', message: 'Booking not found');
        }
    }

    public function dehydrate()
    {
        foreach ($this->tempImagePaths as $path) {
            Storage::delete($path);
        }
    }



//update function run on value change so any tricker after calculation is not able to change weight or size ....

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





public function downloadSlip($bookingId)
{
    $booking = CargoBook::findOrFail($bookingId);
    $pdf = Pdf::loadView('pdf.bookingSlip', compact('booking'));
    
    return response()->streamDownload(
        fn () => print($pdf->output()),
        "booking-slip-{$booking->tracking_number}.pdf"
    );
}



public function cancelBooking($bookingId)
{
    // Find the booking
    $booking = CargoBook::findOrFail($bookingId);
    if ($booking->status !== 'pending') {
        session()->flash('error', 'Only pending bookings can be canceled');
        return;
    }
    // Update status to 'canceled'
    $booking->update([
        'status' => 'canceled',
        'canceled_at' => now()
    ]);
    
    // Refresh the bookings list
    $this->loadUserBookings();
    
    // Show success message
    session()->flash('message', 'Booking #'.$booking->tracking_number.' has been canceled');
}







public function render()
    {
        return view('livewire.enduser.cargo-booking', [
            'theme' => $this->theme,
        ])->layout('layouts.user', ['company' => $this->company]);
    }
}