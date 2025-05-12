<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'user_id',
        'company_id',
        'route_id',
        'vehicle_id',
        'schedule_id',
        'passenger_name',
        'passenger_cnic',
        'passenger_phone',
         
        'passenger_gender',
        'travel_date',
         
        'fare',
        'discount',
        'total_amount',
        'valid_until',
        'status',
        'booking_date',
        'payment_method',
        'payment_status',
        'transaction_id'
    ];

    protected $casts = [
        'travel_date' => 'date',
        'departure_time' => 'time',
        'arrival_time' => 'time',
        'valid_until' => 'date',
        'booking_date' => 'datetime',
        'fare' => 'decimal:2',
        'discount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Routes::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'registration_number');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(VehicleSchedule::class);
    }

    // Scopes
    public function scopeValid($query)
    {
        return $query->where('valid_until', '>=', now())
                     ->where('status', 'confirmed');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Helpers
    public function isExpired(): bool
    {
        return $this->valid_until < now();
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function getFormattedFareAttribute(): string
    {
        return number_format($this->fare, 2);
    }



    public function seats()
    {
        return $this->hasMany(TicketSeat::class);
    }

  

 

}
