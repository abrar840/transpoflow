<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    // Primary Key Configuration
    protected $primaryKey = 'registration_number';
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass Assignable Attributes
    protected $fillable = [
        'registration_number',
        'company_id', // ✅ Foreign key for company
        'vehicle_type',
        'seating_capacity',
        'make',
        'model',
        'year',
        'is_active',
        'scheduled',
        'notes',
        'available_seats'
    ];

    // Attribute Casting
    protected $casts = [
        'is_active' => 'boolean',
        'scheduled' => 'boolean',
        'seating_capacity' => 'integer',
        'year' => 'integer'
    ];

    // Dates Handling
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * ✅ Relationship: A Vehicle belongs to a Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id'); // Referencing 'id' of Company table
    }

    public function schedules()
    {
        return $this->hasMany(VehicleSchedule::class);
    }

}
