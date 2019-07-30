<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $fillable = [
        "paid",
    ];
     protected $hidden = [
        "created_at", 
        "updated_at"
    ] ;


}
