<?php

namespace App\Http\Controllers;

use App\Project;
use App\OrderDetail;
use App\User;
use App\Supplier;
use App\Customer;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
    }

    /**
     * search records in database and display  results
     * @param Request $request [description]
     * @return view      [description]
     */
    public function search(Request $request)
    {

        $searchterm = $request->input('query');

        $searchResults = (new Search())
            ->registerModel(Project::class, 'title')
            ->registerModel(OrderDetail::class, 'invoice_number')
            ->registerModel(User::class, 'name')
            ->registerModel(Supplier::class, 'name')
            ->registerModel(Customer::class, 'name')
            ->perform($request->input('query'));
        //dd($searchResults);

        return view('search', compact('searchResults', 'searchterm'));
    }

}
