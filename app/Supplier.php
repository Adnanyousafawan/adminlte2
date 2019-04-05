<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
    	"sup_name",
    	"sup_inic",
    	"sup_contact",
    	"sup_address",
    	"sup_city",
    	"sup_material",
    	"mat_price"
    ];
}
