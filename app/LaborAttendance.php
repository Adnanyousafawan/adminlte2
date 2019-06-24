<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaborAttendance extends Model
{
  
    protected $fillable = [
        'status',
        'labor_id',
        'date'
    ];
}
