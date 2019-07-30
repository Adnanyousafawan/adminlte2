<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyBalance extends Model
{
    protected $fillable = [ 
        "balance",
        "projects_balance",
        "profit",
    ];
}
