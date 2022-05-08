<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    public function set()
    {
        return $this->belongsTo(FeatureSet::class, 'set_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'set_id',
        'product_id',
        'valueint',
        'valuestr',
        'valuedec',
        'valuedate',
    ];
}
