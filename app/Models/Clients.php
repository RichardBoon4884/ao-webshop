<?php

namespace App\Models;

class Clients extends Model
{
    protected $table = 'clients';

    protected $fillable = array('firstName', 'lastName', 'gender', 'street', 'houseNumber', 'zipCode', 'town', 'country');

    public function user()
    {
        return $this->hasOne('App\User', 'user_id');
    }
}
