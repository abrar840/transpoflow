<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSchedule extends Model
{

    protected $fillable = [
        'route_id',
        'vehicle_id',
        'days_of_week',
        'departure_time',
        'arrival_time'
        
    ];
    protected $casts = [
        'days_of_week' => 'array'
    ];

    public function route()
    {
        return $this->belongsTo(Routes::class);
    }

    public function vehicle()
{
    return $this->belongsTo(Vehicle::class, 'vehicle_id', 'registration_number');
}

}