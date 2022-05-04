<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dishwasher extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'dishwasher_type',
        'dishes_sets',
        'washing_programs',
        'noise_level(dB)',
        'color',
        'weight(kg)',
        'warranty(m)',
    ];
}
