<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class create_users extends Model
{
     protected $fillable = [
        "name",
        "email", 
        "password",
        "profile_image",
        "gender",
        "age",
        "city",
        "address",
        "cnic",
        "phone_number",
        "role_id",
    ];
     public function getImageAttribute()
    {
        return $this->profile_image;
    }
}
