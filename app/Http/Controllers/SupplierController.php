<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([ $request, 
            'sup_name' => 'required',
            'sup_inic' => 'required',
            //'sup_contact' => 'required',
            'sup_address' => 'required',
            'sup_city' => 'required',
            'sup_material' => 'required',
            'mat_price' => 'required'
        ]);

        $supplier = new Supplier([
            'name' => $request->get('sup_name'),
            'inic' => $request->get('sup_inic'),
            'contact' => $request->get('sup_contact'),
            'address' => $request->get('sup_address'),
            'city' => $request->get('sup_city'),
            'material' => $request->get('sup_material'),
            'price' => $request->get('mat_price')
        ]);
        $supplier->save();

        return redirect('/home')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier)
    {
        //
    }
}
