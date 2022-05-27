<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    public function set()
    {
        return $this->belongsTo(OrderSet::class, 'set_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'set_id',
        'values',
    ];
}
