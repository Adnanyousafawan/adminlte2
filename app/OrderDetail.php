<?php
namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model implements Searchable
{
	protected $table = 'order_details';

    protected $fillable = [
        'item_id',
        'quantity',
        'supplier_id',
        'status',
        'project_id',
        'set_rate',
        'invoice_number',
        
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('orders', $this->id);
 
        return new SearchResult(
            $this,
            $this->invoice_number,
            $url
        );
    }
}
  