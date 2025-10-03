<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyColor extends Pivot
{
    use HasFactory;
    protected $table = 'company_colors';
    protected $fillable = [
        'company_id',
        'color_palette_id'
    ];
}
