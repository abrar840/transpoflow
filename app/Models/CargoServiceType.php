<?php
// app/Models/CargoServiceType.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CargoServiceType extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'code',
        'surcharge_percentage',
        'description',
        'is_active'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
