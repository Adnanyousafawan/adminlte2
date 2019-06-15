<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = [
    	'c_name',
    	'cnic',
    	'address',
    	'phone',
    ];

    public $timestamps = false;
}
