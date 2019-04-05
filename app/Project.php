<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	"proj_title",
    	"proj_location",
    	"proj_dimension",
    	"proj_city",
    	"cust_name",
    	"cust_CNIC",
    	"cust_contact",
    	"proj_contractor",
    	"proj_completion_time",
    	"zipcode",
    	"proj_cost",
    	"proj_description"
    ];
}
