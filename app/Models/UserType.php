<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    public function getIsAdminAttribute()
    {

        return $this->role_id == 1;
    }

    public function getIsUserAttribute()
    {

        return $this->role_id == 2;
    }

    public function getIsStorekeeperAttribute()
    {

        return $this->role_id == 3;
    }

    public function getIsDirectorAttribute()
    {

        return $this->role_id == 4;
    }
}
