<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
     protected $fillable = [
    	"cont_name",
    	"cont_cnic",
    	"cont_contact",
    	"cont_address",
    	"cont_city",
    	"cont_past_projects",
    ];

     public function projects(){
         return $this->hasMany(Project::class);
     }
}
