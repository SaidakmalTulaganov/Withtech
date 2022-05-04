<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelevisionSet extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'diagonal',
        'screen_resolution',
        'screen_format',
        'panel_type',
        'update_frequency',
        'color',
        'weight',
        'warranty',
    ];
}
