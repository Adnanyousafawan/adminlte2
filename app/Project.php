<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	"proj_title",
    	"proj_location",
    	"proj_city",
    	"proj_area"
    ];
}
