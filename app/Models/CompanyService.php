<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyService extends Pivot
{
    use HasFactory;
    protected $table = 'company_services';
    protected $fillable = [
        'company_id',
        'service_id'
    ];
}
