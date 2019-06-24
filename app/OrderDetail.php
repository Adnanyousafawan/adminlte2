<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'item_id',
        'quantity',
        'status',
        'project_id',
    ];
}
