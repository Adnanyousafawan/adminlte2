<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    //


    protected $fillable = [
        'item_id',
        'quantity',
        'project_id',
        'instructions',
        'requested_by',
        'seen',
        'request_status_id'
    ];
}
