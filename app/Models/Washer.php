<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Washer extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'wash_class',
        'spin_class',
        'drum_material',
        'maximum_load(kg)',
        'spin_speed(rpm)',
        'water_consumption(l)',
        'drum_volume(l)',
        'number_programs',
        'programs',
        'color',
        'weight(kg)',
        'warranty(m)',
    ];
}
