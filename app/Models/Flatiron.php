<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flatiron extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'power(Wt)',
        'steam_function',
        'water_tank(ml)',
        'iron_soleplate',
        'color',
        'weight(kg)',
        'warranty(m)',
    ];
}
