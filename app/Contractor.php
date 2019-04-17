<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
     protected $fillable = [
    	"name",
    	"cnic",
    	"contact",
    	"address",
    	"city",
    ];
}
