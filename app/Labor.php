<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
	protected $fillable = [
	    	"lab_name",
	    	"lab_cnic",
	    	"lab_contact",
	    	"lab_address",
	    	"lab_city",
	    	"lab_rate"
    ];
    	
}
