<?php

namespace App\Http\Controllers;

use App\contractor;
use App\User;
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
            'cont_city' => 'required'
        ]);

        $contractor = new User([
            'name' => $request->get('cont_name'),
            'cnic' => $request->get('cont_cnic'),
            'contact' => $request->get('cont_contact'),
            'address' => $request->get('cont_address'),
            'city' => $request->get('cont_city'),
            'email' => "hammxah@hamza.com",
            'password' =>'$2y$10$SRZbHvWspEfbU08j2C6TreU2H8rjJsI702XIkSXHn8PIBpeB8FkPy',
            'role_id' => 3
        ]);
        $contractor->save();

        return redirect('/home')->with('success', 'New Contractor has added');
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
