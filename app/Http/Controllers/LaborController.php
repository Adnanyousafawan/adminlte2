<?php

namespace App\Http\Controllers;

use App\labor;
use Illuminate\Http\Request;

class LaborController extends Controller
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
            'lab_name' => 'required',
            'lab_cnic' => 'required',
            'lab_contact' => 'required',
            'lab_address' => 'required',
            'lab_city' => 'required',
            'lab_rate' => 'required'
        ]);

        $labor = new Labor([
            'lab_name' => $request->get('lab_name'),
            'lab_cnic' => $request->get('lab_cnic'),
            'lab_contact' => $request->get('lab_contact'),
            'lab_address' => $request->get('lab_address'),
            'lab_city' => $request->get('lab_city'),
            'lab_rate' => $request->get('lab_rate')
        ]);
        $labor->save();

        return redirect('/home')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function show(labor $labor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function edit(labor $labor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, labor $labor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function destroy(labor $labor)
    {
        //
    }
}
