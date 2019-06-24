<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiscellaneousExpense extends Model
{
    protected $fillable = [
        'name',
        'expense',
        'description',
        'project_id',
    ];
    
}
