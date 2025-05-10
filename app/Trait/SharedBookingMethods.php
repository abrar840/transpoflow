<?php

namespace App\Trait;
use App\Models\CargoBook;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


trait SharedBookingMethods
{
    //
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
    





    //downlaod pdf slip of cargo booking 
    public function downloadSlip($bookingId)
{
    $booking = CargoBook::findOrFail($bookingId);
    $pdf = Pdf::loadView('pdf.bookingSlip', compact('booking'));
    
    return response()->streamDownload(
        fn () => print($pdf->output()),
        "booking-slip-{$booking->tracking_number}.pdf"
    );
}




// funcxtion to put image in temp folder and ten siowig its preview 

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


//andle image uolaod function puts image in folder and and ten returns te pat to be saved in database 
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




}
