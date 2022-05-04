<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Microwave extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'volume(l)',
        'power(Wt)',
        'control_type',
        'door_opening',
        'inner_lining',
        'turntable_diameter(mm)',
        'color',
        'weight(kg)',
        'warranty(m)',
    ];
}
