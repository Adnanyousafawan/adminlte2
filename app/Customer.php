<?php

namespace App;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements Searchable
{

    protected $fillable = [
    	'name',
    	'cnic',
    	'address',
    	'phone',
    ];
    public $timestamps = false;

    public function getSearchResult(): SearchResult
    {
        $url = route('customers.list', $this->id);
 
        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
