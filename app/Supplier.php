<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model implements Searchable
{
    protected $fillable = [
    	"name",
    	"phone",
    	"address",
    	"city",
    	
    ];
    public function getSearchResult(): SearchResult
    {
        $url = route('suppliers.all', $this->id);
 
        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
