<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Project;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $projects = DB::table('projects')
       /* ->join('users', 'users.id', '=', 'projects.assigned_to')
        ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
        ->get();
        //dd($projects);
        //$projectstotal = DB::table('projects')->get();//Project::all();
        $contractors = DB::table('users')->where('role_id', '=', '1')->get();
        return view('projects/index', compact('projects'),['contractors' => $contractors]);
        //return view('projects.index');

    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contractors = DB::table('users')->where('role_id', '=', '1')->get();
        return View('projects/create')->with('contractors', $contractors);
        //return view('projects/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
            'name' => 'required',
            'cnic' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'assigned_to' => 'required',
            'estimated_completion_time' => 'required',
            'estimated_budget' => 'required',
            'description' => 'required',
            'contract_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);

        $contractor = DB::table('users')
            ->where('name', '=', $request->input('assigned_to'))
            ->select('id')
            ->get();


        // dd($contractor[0]->id);

        $customer = new Customer([
            'c_name' => $request->input('name'),
            'cnic' => $request->input('cnic'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);
        $customer->save();

        $customerId = DB::table('customers')
            ->where('id', '=', $customer->id)
            ->get();


        $project_status = DB::table('project_status')->pluck('id')->first();
        $project_phase = DB::table('project_phase')->pluck('id')->first();

        $project = new Project([
            'title' => $request->input('title'),
            'area' => $request->input('area'),
            'city' => $request->input('city'),
            'plot_size' => $request->input('plot_size'),
            'floor' => $request->input('floor'),
            'customer_id' => $customerId[0]->id,
            'assigned_to' =>DB::table('users')->where('name','=', $request->input('assigned_to'))->pluck('id')->first(),
            'status_id' => $project_status,
            'phase_id' => $project_phase,
            'assigned_by' => Auth::id(),
            'estimated_completion_time' => $request->input('estimated_completion_time'),
            'estimated_budget' => $request->input('estimated_budget'),
            'description' => $request->input('description'),
            'contract_image' => $request->input('contract_image')
            

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

        $project->save();


        // Return user back and show a flash message
        return redirect()->route('projects.index')->with('success', 'Project Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        $projects = DB::table('projects')
        /*->join('users', 'users.id', '=', 'projects.assigned_to')
        ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
        ->get();

        
        //dd($projects);
        //->where('followers.follower_id', '=', 3)
       // $projects = DB::table('projects')->join('users','users.id','=','projects.assigned_to')->take(10)->get();
        //dd($projects);
          //Project::paginate(10);
        $projectstotal = DB::table('projects')->get();//Project::all();
        $contractors = DB::table('users')->where('role_id', '=', '3')->get();
        //$customers = DB::table('customers')->where('id','=','projects.customer_id')->pluck('name')->first();
        //$customers = DB::table('projects')->join('customers','customers.id','=','projects.customer_id')->pluck('name')->all();
        //dd($projects);
        //dd($customers);
        //join('customers','customers.id','=','projects.customer_id')->take(10)->get();
        //$customers = DB::table('customers')->get();// \App\Customer::all();
        return view('projects/projects', compact('projects'));
    }


    public function cancelled()
    {
      $projects = DB::table('projects')->where('projects.id','=','5')->get();
      return view('projects/projects',compact('projects'));
    }

    public function completed()
    {
     $projects = DB::table('projects')->where('projects.floor','=','5')->get();
      return view('projects/projects',compact('projects'));
    }
    public function all()
    {
     $projects = DB::table('projects')->get();
      return view('projects/projects',compact('projects'));
    }
     public function pending()
    {
     $projects = DB::table('projects')->where('projects.floor','=','3')->get();
      return view('projects/projects',compact('projects'));
    }
     public function current()
    {
     $projects = DB::table('projects')->where('projects.floor','=','3')->get();
      return view('projects/projects',compact('projects'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function search_project(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_title');
        $search_customer = $request->get('search_customer');
        if (!is_null($search)) {
            $projects = DB::table('projects')->where('title', 'like', '%' . $search . '%')->paginate(20);
            return view('projects/index', ['projects' => $projects]);
        }
        if (!is_null($search_customer)) {
            $projects = DB::table('projects')->where('customer_name', 'like', '%' . $search_customer . '%')->paginate(20);
            return view('projects/index', ['projects' => $projects]);
        } else {
            $projects = Project::paginate(20);
            return view('projects/index', ['projects' => $projects]);
        }
    }

    public function edit($id)
    {

        $projects = Project::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($projects == null || count($projects) == 0) {
            return redirect()->intended('projects/index');
        }
        //$users = User::paginate(10);
        return view('projects/edit', ['projects' => $projects]);
    }


     public function viewuser($id)
    {
        $labors = DB::table('labors')
        ->join('projects', 'projects.id', '=', 'labors.project_id')
        ->get();

       /* $customers = DB::table('customers')
        ->join('projects', 'projects.customer_id', '=', 'customers.id')
        ->get();
        */
        $orders = DB::table('order_details')->join('projects','projects.id','=','order_details.project_id');
        $customers = DB::table('customers')->where('projects.id', '=', $id)
        ->join('projects', 'projects.customer_id', '=', 'customers.id')
        ->get();
       
        $data = DB::table('projects')->where('projects.id', '=', $id)
        ->join('users', 'users.id', '=', 'projects.assigned_to')
        ->join('customers', 'customers.id', '=', 'projects.customer_id')
        ->get();
        

        $projects = Project::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($projects == null || count($projects) == 0) {
            return redirect()->intended('projects/index');
        }

        //$users = User::paginate(10);
        return view('projects/view', ['data' => $data] , ['labors' => $labors], ['orders' => $orders ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
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
        //$projects->assigned_to = $request->input('assigned_to');
        $projects->estimated_completion_time = $request->input('estimated_completion_time');
        $projects->estimated_budget = $request->input('estimated_budget');
        //  $projects->description = $request->input('description');
        // $projects->contract_image = $request->input('contract_image');
        $projects->save();
        // Return user back and show a flash message
        return redirect()->route('projects.index')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $check = DB::table('labors')
        ->join('projects', 'projects.id', '=', 'labors.project_id') //->where('labors.id','=',$id)
        ->count();
      
        if($check == 0)
        {
            Project::where('id', $id)->delete();
            return redirect()->intended('projects/index')->with('success','Project Deleted Succuessfully.');
        }
        else
        {
            return redirect()->route('projects.index')->with('message', 'Labor Exists. Please delete labors from project first.');

        }        
    }




    public function updateImage(Request $request)
    {


    }
}