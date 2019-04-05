<?php

namespace App\Http\Controllers;

use App\contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
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
            'cont_name' => 'required',
            'cont_cnic' => 'required',
            'cont_contact' => 'required',
            'cont_address' => 'required',
            'cont_city' => 'required',
            'cont_past_projects' => 'required'
        ]);

        $contractor = new Contractor([
            'cont_name' => $request->get('cont_name'),
            'cont_cnic' => $request->get('cont_cnic'),
            'cont_contact' => $request->get('cont_contact'),
            'cont_address' => $request->get('cont_address'),
            'cont_city' => $request->get('cont_city'),
            'cont_past_projects' => $request->get('cont_past_projects'),
            'zipcode' => $request->get('zipcode')
        ]);
        $contractor->save();

        return redirect('/home')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(contractor $contractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(contractor $contractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contractor $contractor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(contractor $contractor)
    {
        //
    }
}
