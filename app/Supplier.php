<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
    	"name",
    	"inic",
    	"phone_number",
    	"address",
    	"city",
    	"material",
    	"price"
    ];
}
