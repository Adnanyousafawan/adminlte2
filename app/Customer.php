<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
      'name',
      'phone_number',
      'address',
      'cnic'
    ];
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
