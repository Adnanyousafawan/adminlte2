<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerReceivable extends Model
{
    protected $fillable = [ 
        "receivable",
        'project_id',
    ];
     protected $hidden = [
        "created_at", 
        "updated_at"
    ] ;
}
