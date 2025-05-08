<?php

// app/Models/CargoWeightTier.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoWeightTier extends Model
{
    protected $fillable = [
        'company_id',
        'min_weight',
        'max_weight',
        'rate_per_kg'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}