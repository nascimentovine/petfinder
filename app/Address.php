<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'address', 'city', 'state', 'fk_user_id'
    ];
}
