<?php
// app/Models/CargoVolumeTier.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoVolumeTier extends Model
{
    protected $fillable = [
        'company_id',
        'min_volume',
        'max_volume',
        'rate_per_cm3'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}