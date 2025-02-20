<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function services()
    {
        return $this->belongsToMany(Service::class, 'company_services');
    }

    public function colorPalette()
    {
        return $this->belongsToMany(ColorPalette::class, 'company_colors');
    }
}
