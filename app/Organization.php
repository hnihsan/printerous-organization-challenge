<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'logo', 'website', 'user_id'
    ];
}
