<?php

// app/Models/CargoRoute.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoRoute extends Model
{
    protected $fillable = [
        'company_id',
        'departure_city',
        'arrival_city',
        'base_fare',
        'vehicle_id',
        'shipment_days',
        'departure_time'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}