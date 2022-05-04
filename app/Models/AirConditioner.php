<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirConditioner extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'operating_modes',
        'installation_type',
        'cooling_capacity(kWt)',
        'heating_capacity(kWt)',
        'served_area(m2)',
        'pipeline_length(m)',
        'color',
        'weight(kg)',
        'warranty(m)',
    ];
}
