<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaborStatus extends Model
{
	protected $fillable = [
        "name"
    ];
    public $timestamps = false;
    protected $table = "labor_status";
}
