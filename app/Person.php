<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = [
        'name', 'email', 'phone', 'avatar', 'organization_id'
    ];

    public function organization(){
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}
