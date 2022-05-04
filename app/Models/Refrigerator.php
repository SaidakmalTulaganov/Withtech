<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refrigerator extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'cameras',
        'freezer_location',
        'doors',
        'volume',
        'noise_level',
        'shelves',
        'color',
        'weight',
        'warranty',
    ];
}
