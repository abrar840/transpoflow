<?php

// app/Models/CargoBooking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoBook extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'tracking_number',
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
        'status'


        // All fields from migration
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Helper method to calculate charges
    public static function calculateCharges(array $data): array
    {
        $company = Company::find($data['company_id']);

        
        
        // Get base fare from route
        $baseFare = CargoRoute::where('company_id', $company->id)
            ->where('departure_city', $data['shipper_city'])
            ->where('arrival_city', $data['consignee_city'])
            ->value('base_fare') ?? 0;
            
        // Calculate weight charge
        $weightTier = CargoWeightTier::where('company_id', $company->id)
            ->where('min_weight', '<=', $data['weight'])
            ->where('max_weight', '>=', $data['weight'])
            ->first();
            
        $weightCharge = $weightTier ? $data['weight'] * $weightTier->rate_per_kg : 0;
        
        // Calculate volume charge
        $volumeTier = CargoVolumeTier::where('company_id', $company->id)
            ->where('min_volume', '<=', $data['volume'])
            ->where('max_volume', '>=', $data['volume'])
            ->first();
            
        $volumeCharge = $volumeTier ? $data['volume']/5000 * $volumeTier->rate_per_cm3 : 0;
        
        // Calculate service charge
        $serviceCharge = 0;
        if (!empty($data['service_type'])) {
            $service = CargoServiceType::where('company_id', $company->id)
                ->where('code', $data['service_type'])
                ->first();
                
            $serviceCharge = $service ? ($baseFare * $service->surcharge_percentage / 100) : 0;
        }
         



        return [
            'base_fare' => $baseFare,
            'weight_charge' => $weightCharge,
            'volume_charge' => $volumeCharge,
            'service_charge' => $serviceCharge,
            'total_amount' => $baseFare + max($weightCharge, $volumeCharge) + $serviceCharge * $data['quantity']
        ];
    }


    public function images()
    {
        return $this->hasMany(CargoImage::class);
    }



}