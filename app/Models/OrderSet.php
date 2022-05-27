<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'order_datetime',
        'state_id',
        'payment_type',
        'delivery_address',
        'order_price',
    ];
}
