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
    	"name",
    	"assigned_to",
    	"estimated_completion_time",
    	"estimated_budget",
    	"description",
        "assigned_by",
        "customer_id",
        "floor",
        "contract_image",
    ];

    public function getImageAttribute()
    {
        return $this->contract_image;
    }
}
