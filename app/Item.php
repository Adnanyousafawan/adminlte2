<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
     protected $fillable = [
        'name',
        'purchase_rate',
        'selling_rate',
        'unit',
        'supplier_id',
    ];
   
}
