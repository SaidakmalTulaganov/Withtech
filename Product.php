<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'manufacturer_id',
        'product_title',
        'description',
        'count',
        'product_price',
        'product_image',
    ];
}
