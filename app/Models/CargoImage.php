<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
class CargoImage extends Model
{
    protected $fillable = ['cargo_book_id', 'image_path', 'caption'];
    
    public function booking()
    {
        return $this->belongsTo(CargoBook::class);
    }

    protected $casts = [
        'images' => 'array',
        // other casts...
    ];
}