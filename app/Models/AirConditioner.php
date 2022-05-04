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
        'cooling_capacity',
        'heating_capacity',
        'served_area',
        'pipeline_length',
        'color',
        'weight',
        'warranty',
    ];
}
