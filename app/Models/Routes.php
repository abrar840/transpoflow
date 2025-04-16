<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Routes extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'departure_city',
        'arrival_city',
        'vehicle_type',
        'fare_per_seat',
    ];

    // protected $casts = [
    //     'available_days' => 'array',
    // ];

    // // Relationship with Vehicle model
    // public function vehicle()
    // {
    //     return $this->belongsTo(Vehicle::class);
    // }

    // Relationship with Company model
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
