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
    	"customer_name",
        "customer_phone_number",
        "customer_cnic",
        "customer_address",
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
}
