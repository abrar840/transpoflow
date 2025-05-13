<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'address',
        'email',
        'logo',
        'admin_username',
        'num_employees'
    ];

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

  
    // Define the relationship with services through the CompanyService pivot table
    public function services()
    {
        return $this->belongsToMany(Service::class, 'company_services', 'company_id', 'service_id');
    }


    public function colorPalette()
    {
        return $this->belongsToMany(ColorPalette::class, 'company_colors');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'company_id', 'id'); // Referencing 'company_id' in Vehicle table
    }
    
    public function user()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

public function routes()
    {
        return $this->hasMany(Routes::class);
    }

public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }



    public function theme()
    {
        return $this->hasOne(CompanyTheme::class);
    }
    
}

