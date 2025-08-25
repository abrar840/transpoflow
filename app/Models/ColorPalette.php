<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorPalette extends Model
{
    use HasFactory;
    protected $table = 'color_palettes';
    protected $fillable = [
        'name',
        'color_1',
        'color_2',
        'color_3'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_colors');
    }
}
