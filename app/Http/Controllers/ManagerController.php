<?php

namespace App\Http\Controllers;

use App\manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
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
            'man_name' => 'required',
            'man_cnic' => 'required',
            'man_contact' => 'required',
            'man_address' => 'required',
            'man_city' => 'required',

            //'upload_contract' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $manager = new Manager([
            'man_name' => $request->get('man_name'),
            'man_cnic' => $request->get('man_cnic'),
            'man_contact' => $request->get('man_contact'),
            'man_address' => $request->get('man_address'),
            'man_city' => $request->get('man_city'),
            'zipcode' => $request->get('zipcode')
            //'upload_contract' => $request->get('upload_contract'),
              
        ]);
        $manager->save();

        return redirect('/home')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(manager $manager)
    {
        //
    }
}
