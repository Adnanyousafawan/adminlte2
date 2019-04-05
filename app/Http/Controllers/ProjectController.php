<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
            'proj_title' => 'required',
            'proj_location' => 'required',
            'proj_dimension' => 'required',
            'proj_city' => 'required',
            'cust_name' => 'required',
            'cust_CNIC' => 'required',
            'cust_contact' => 'required',
            'proj_cost' => 'required',
            'proj_description' => 'required'
            //'upload_contract' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);

        $project = new Project([
            'proj_title' => $request->get('proj_title'),
            'proj_location' => $request->get('proj_location'),
            'proj_dimension' => $request->get('proj_dimension'),
            'proj_city' => $request->get('proj_city'),
            'cust_name' => $request->get('cust_name'),
            'cust_CNIC' => $request->get('cust_CNIC'),
            'cust_contact' => $request->get('cust_contact'),
            'proj_contractor' => $request->get('proj_contractor'),
            'proj_completion_time' => $request->get('proj_completion_time'),
            'zipcode' => $request->get('zipcode'),
            'proj_cost' => $request->get('proj_cost'),
            'proj_description' => $request->get('proj_description')
            //'upload_contract' => $request->get('upload_contract')
              
        ]);
/*    ........for image ............... getclientOriginalExtension on null error()....
        if( $request->hasFile('frontimage')){ 
        $image = $request->file('frontimage'); 
        $fileName = $image->getClientOriginalName();
    $fileExtension = $image->getClientOriginalExtension();
        dd($fileExtension); 
    } else {
        dd('No image was found');
}

*/
/*
          $image = $request->file('upload_contract');
               // $new_name = rand() . ' . ' . $image->getClientOriginlExtension();
                $request->image->getClientOriginalExtension();
                $image->move(public_path("images"),$new_name);
        */
        $project->save();

        return redirect('/home')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
