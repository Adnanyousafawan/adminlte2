<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	"title",
    	"location",
    	"area",
    	"plot_size",
    	"city",
    	"assigned_to",
    	"estimated_completion_time",
    	"estimated_budget",
    	"description",
        "assigned_by",
        "floor",
        "contract_image",
        "status",
    ];

    public function getImageAttribute()
    {
        return $this->contract_image;
    }

//    public function labors(){
//        return $this->hasMany('App\Labor');
//    }



// gives labor count
    public function labors()
    {
        return $this->hasMany(Labor::class);
    }
    public function getLaborCountAttribute()
    {
        return $this->labors()->count();
    }
//    public function contractors(){
//        return $this->belongsTo(Contractor::class);
//    }

}
