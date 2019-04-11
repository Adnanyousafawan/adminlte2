<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Project;
use App\Traits\UploadTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Redirect;
use Validator;
use View;

class ProjectController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.create');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'area' => 'required',
            'city' => 'required',
            'estimated_budget' => 'required',
            'description' => 'required',
//            'contact' => 'required',
//            'title' => 'required',

            'contract_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $project = new Project([
            'title' => $request->input('title'),
            'contract_image'=> $request->input('contract_image'),
            'city' => $request->input('city'),
            'area' => $request->input('area'),
            'estimated_budget' => $request->input('estimated_budget'),
            'description' => $request->input('description'),
            'plot_size' => $request->input('plot_size'),
            'floor' => $request->input('floor'),
        ]);


        if ($request->has('contract_image')) {
            // Get image file
            $image = $request->file('contract_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($project->title . '-' . time());
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
//            $this->deleteOne( 'public', $project->contract_image);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $project->contract_image = $filePath;
        }
        // Persist user record to database
        $project->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Project added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }


    public function updateImage(Request $request)
    {


    }
}
