<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
     protected $fillable = [
    	"man_name",
    	"man_cnic",
    	"man_contact",
    	"man_address",
    	"man_city",
    	
    ];
}
