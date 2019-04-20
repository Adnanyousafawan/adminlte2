<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $fillable = [
        "name",
        "cnic",
        "phone",
        "address",
        "city",
        "rate",
        "status",
        "project_id"
    ];

}
