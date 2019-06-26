<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
	 protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    protected $table = "project_status";
}
