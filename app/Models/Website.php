<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'domain_name',
        'template_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
