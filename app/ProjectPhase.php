<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPhase extends Model
{
	protected $fillable = [
		
        'name',
    ];
    public $timestamps = false;
    protected $table = "project_phase";
   
}
