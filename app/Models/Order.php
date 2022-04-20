<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'order_datetime',
        'order_status',
        'payment_type',
        'delivery_address',
        'order_price',
    ];
}
