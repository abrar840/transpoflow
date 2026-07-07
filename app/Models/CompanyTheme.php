<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyTheme extends Model
{
    //


    protected $fillable = [
        'company_id',
        'theme',
        'brand_color',
    ];



    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    

}
