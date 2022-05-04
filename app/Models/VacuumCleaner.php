<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacuumCleaner extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'cleaning_type',
        'container_volume(l)',
        'power(Wt)',
        'cord_length',
        'nozzles_included',
        'color',
        'weight(kg)',
        'warranty(m)',
    ];
}
