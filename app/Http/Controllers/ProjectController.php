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
        return view('projects/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects/create');
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
            'plot_size' => 'required',
            'floor' => 'required',
            'cust_name' => 'required',
            'cust_cnic' => 'required',
            'cust_phone' => 'required',
            'cust_address' => 'required',
            //'assigned_to' => 'required',
            'estimated_completion_time' => 'required',
            'estimated_budget' => 'required',
            'description' => 'required',
            'contract_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);

        $project = new Project([
            'title' => $request->input('title'),
            'area' => $request->input('area'),
            'city' => $request->input('city'),
            'plot_size' => $request->input('plot_size'),
            'floor' => $request->input('floor'),
            'customer_name' => $request->input('cust_name'),
            'customer_cnic' => $request->input('cust_cnic'),
            'customer_phone_number' => $request->input('cust_phone'),
            'customer_address' => $request->input('cust_address'),
           // 'assigned_to' => $request->input('assigned_to'),
            'estimated_completion_time' => $request->input('estimated_completion_time'),
            'estimated_budget' => $request->input('estimated_budget'),
            'description' => $request->input('description'),
            'contract_image'=> $request->input('contract_image')

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
       return redirect()->route('projects.index')->with('success','Project Added Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $projects = Project::paginate(10);
        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */    
public function search_project(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_title');
        $search_customer = $request->get('search_customer');
        if (!is_null($search)) 
        {
            $projects = DB::table('projects')->where('title','like','%'.$search.'%')->paginate(20);
            return view('projects/index', ['projects' => $projects]);
        }
        if (!is_null($search_customer)) 
        {
            $projects = DB::table('projects')->where('customer_name','like','%'.$search_customer.'%')->paginate(20);
            return view('projects/index', ['projects' => $projects]);
        }
        else
        {
            $projects = Project::paginate(20);
            return view('projects/index', ['projects' => $projects]);
        }  
    }

    public function edit($id)
    {
        $projects = Project::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($projects == null || count($projects) == 0)
         {
            return redirect()->intended('projects/index');
        }
        //$users = User::paginate(10);
        return view('projects/edit', ['projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'area' => 'required',
            'city' => 'required',
            'plot_size' => 'required',
            'floor' => 'required',
            'cust_name' => 'required',
            'cust_cnic' => 'required',
            'cust_phone' => 'required',
            'cust_address' => 'required',
            //'assigned_to' => 'required',
            'estimated_completion_time' => 'required',
            'estimated_budget' => 'required',
           // 'description' => 'required',
           // 'contract_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);

            $projects = Project::find($id);
            $projects->title = $request->input('title');
            $projects->area = $request->input('area');
            $projects->city = $request->input('city');
            $projects->plot_size = $request->input('plot_size');
            $projects->floor = $request->input('floor');
            $projects->customer_name = $request->input('cust_name');
            $projects->customer_cnic = $request->input('cust_cnic');
            $projects->customer_phone_number = $request->input('cust_phone');
            $projects->customer_address = $request->input('cust_address');
            //$projects->assigned_to = $request->input('assigned_to');
            $projects->estimated_completion_time = $request->input('estimated_completion_time');
            $projects->estimated_budget = $request->input('estimated_budget');
          //  $projects->description = $request->input('description');
           // $projects->contract_image = $request->input('contract_image');
            $projects->save();
            // Return user back and show a flash message
            return redirect()->route('projects.index')->with('success','Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        return redirect()->intended('projects/index');
    }


    public function updateImage(Request $request)
    {


    }
}
