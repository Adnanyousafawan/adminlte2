<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'item_id',
        'quantity',
        'supplier_id',
        'status',
        'project_id',
        'invoice_number',
    ];
}
 