<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $fillable = [ 
        "received",
        "receivable",
        'project_id',
    ];
     protected $hidden = [
        "created_at", 
        "updated_at"
    ] ;


}
