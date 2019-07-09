<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $fillable = [ 
        "paid",
        "payable",
        "supplier_id"
    ];
     protected $hidden = [
        "created_at", 
        "updated_at"
    ] ;


}
