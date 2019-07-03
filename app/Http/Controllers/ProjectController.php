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
use App\User;
use View;
use Gate;

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
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }

        if(Gate::allows('isAdmin'))
        {
          $projects = DB::table('projects')->get();
            /* ->join('users', 'users.id', '=', 'projects.assigned_to')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
            //$projectstotal = DB::table('projects')->get();//Project::all();
            $labor_by_projects = DB::table('projects')->where('projects.assigned_by','=',Auth::user()->id )->paginate(5);
            $contractors = User::all()->where('role_id', '=',3);
         
            return view('projects/index', compact('projects','contractors','labor_by_projects'));
        }


        if(Gate::allows('isManager'))
        {
            $projects = DB::table('projects')->where('projects.assigned_by','=',Auth::user()->id )->get();
            /* ->join('users', 'users.id', '=', 'projects.assigned_to')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
            

        //$projectstotal = DB::table('projects')->get();//Project::all();
            $labor_by_projects = DB::table('projects')->where('projects.assigned_by','=',Auth::user()->id )->paginate(5);
            $contractors = User::all()->where('role_id', '=', 3);
            return view('projects/index', compact('projects','contractors','labor_by_projects'));
        //return view('projects.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) 
        {
             $contractors = DB::table('users')->where('role_id', '=', 3)->get();
            return View('projects/create')->with('contractors', $contractors);
        }
        if (Gate::allows('isManager')) {

        $contractors = DB::table('users')->where('role_id', '=', 3)->get();
        return View('projects/create')->with('contractors', $contractors);
        }
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $old_project = Project::where('title','=', $request->input('title'))->pluck('title')->first();
        if(strtolower($request->input('title')) == strtolower($old_project))
        { 
            return redirect()->back()->with('message','There is already Project with this Title . Please Chnage Project Title');
        }
        else
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
            'name' => $request->input('name'),
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
            'assigned_to' => DB::table('users')->where('name', '=', $request->input('assigned_to'))->pluck('id')->first(),
            'status_id' => $project_status,
            'phase_id' => $project_phase,
            'assigned_by' => Auth::id(),
            'estimated_completion_time' => $request->input('estimated_completion_time'),
            'estimated_budget' => $request->input('estimated_budget'),
            'description' => $request->input('description'),
            //'contract_image' => $request->get('contract_image'),
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
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
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
        return view('projects/projects', compact('projects','contractors'));
    }

    public function labors_by_projects()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        //dd('in labor by projects');
        $labor_by_projects = DB::table('projects')->where('projects.assigned_by','=',Auth::user()->id )->get();
        return view('projects/laborbyprojects', compact('labor_by_projects'));
    }


    public function cancelled()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        $contractors = User::all()->where('role_id', '=',3);
        $projects = DB::table('projects')->where('projects.id', '=', '5')->get();
        return view('projects/projects', compact('projects','contractors'));
    }

    public function completed()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        $contractors = User::all()->where('role_id', '=',3);
        $projects = DB::table('projects')->where('projects.floor', '=', '5')->get();
        return view('projects/projects', compact('projects','contractors'));
    }

    public function all()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }

         if(Gate::allows('isAdmin'))
        {
          $projects = DB::table('projects')
            /* ->join('users', 'users.id', '=', 'projects.assigned_to')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
            ->get();

        //$projectstotal = DB::table('projects')->get();//Project::all();
            $contractors = DB::table('users')->where('role_id', '=', 3)->get();
            return view('projects/projects', compact('projects'), ['contractors' => $contractors]);
        }
        if(Gate::allows('isManager'))
        {
            $projects = DB::table('projects')->where('projects.assigned_by','=',Auth::user()->id )->get();
            /* ->join('users', 'users.id', '=', 'projects.assigned_to')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
            

        //$projectstotal = DB::table('projects')->get();//Project::all();
            $contractors = DB::table('users')->where('role_id', '=', 3)->get();
            return view('projects/projects', compact('projects'), ['contractors' => $contractors]);
        //return view('projects.index');
        }
       
    }
    

    public function pending()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }

        $contractors = User::all()->where('role_id', '=',3);
        $projects = DB::table('projects')->where('projects.floor', '=', '3')->get();
        return view('projects/projects', compact('projects','contractors'));
    }

    public function current()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }

        $contractors = User::all()->where('role_id', '=',3);
        $projects = DB::table('projects')->where('projects.floor', '=', '3')->get();
        return view('projects/projects', compact('projects','contractors'));
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
        $search_contractor = $request->get('search_contractor');

        if (!is_null($search)) {
            $labor_by_projects = DB::table('projects')->where('title', 'like', '%' . $search . '%')->get();

           // $labor_by_projects = Project::find($search)->where('assigned_by','=',Auth::user()->id)->get();
            //dd($projects);
            return view('projects/laborbyprojects',compact('labor_by_projects'));
        }
        if (!is_null($search_contractor)) 
        {
            // _____________________________________ contractor search queryyy _______________
           
           $labor_by_projects = DB::table('projects')->where('assigned_to', 'like', '%' . '2' . '%')->get();
            return view('projects/laborbyprojects',compact('labor_by_projects'));
        }
         else 
         {
           return redirect()->back()->with('message','No Record Found');

        }
    }

    public function edit($id)
    {

        $projects = Project::find($id);
        $contractors = DB::table('users')->where('role_id', '=', 3)->get();

        $customer = DB::table('customers')
            ->where('id', '=', $projects->customer_id)
            ->get()->first();

        // Redirect to user list if updating user wasn't existed
        if ($projects == null || count($projects) == 0) {
            return redirect()->intended('projects/index');
        }
        //$users = User::paginate(10);
        return view('projects/edit',
            compact('customer','contractors'),
            compact('projects')
//            compact()
        );
    }

 
    public function viewuser($id)
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        $projects = DB::table('projects')->where('id','=',$id)->get()->first(); 

        $labors = DB::table('labors')->where('project_id','=',$id)->get()->all();

       
       /*  $customers = DB::table('customers')
         ->join('projects', 'projects.customer_id', '=', 'customers.id')
         ->get();
         
       */
       $orders = DB::table('order_details')/*join('projects', 'projects.id', '=', 'order_details.project_id')*/->where('project_id','=',$id)->paginate(5);


        $total_orders = DB::table('order_details')->where('project_id','=',$id)->count();
        //dd($orders);

        $selectedproject= DB::table('projects')->where('id', '=', $id)->pluck('id')->first();
        $customers = DB::table('customers')->where('id','=',$selectedproject)->get()->first();
       // dd($customers);

            //dd($customers);

       /* $data = DB::table('projects')->where('projects.id', '=', $id)
            ->join('users', 'users.id', '=', 'projects.assigned_to')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')
            ->get()->all();

*/
       // $projects = Project::find($id)->first();
        //dd($data);
        


         /*

             $id = DB::table('users')
                ->where('email', '=', $request->get('email'))
                ->pluck('id')
                ->first();
        */
        $contractors = DB::table('projects')->join('users','users.id','=','projects.assigned_to')
        ->where('projects.id','=',$id)->get()->first();

        //dd($contractors);

        //$spent = DB::table('order_details')->where('project_id','=',$id)->sum('price');
        $expense = DB::table('miscellaneous_expenses')->where('project_id','=',$id)->sum('expense');

        $projects = DB::table('projects')->where('id','=',$id)->get()->first();
        //->where('assigned_to', '=', $id);
        $balance = $projects->estimated_budget- $expense;
    
       // $check = [];
       // $index = 0;
       // foreach ($projects as $project) {   
/*
        $project = DB::table('projects')->where('id','=',$id)->first(); //->where('assigned_to', '=', $id);

            $contractorID = $project->assigned_to;
            $customerID = $project->customer_id;
            $managerID = $project->assigned_by;
            $project_phaseID = $project->phase_id;
            $project_statusID = $project->status_id;

            $data[] = [
                "id" => $project->id,
                "title" => $project->title,
                "area" => $project->area,
                "city" => $project->city,
                "plot_size" => $project->plot_size,
                "customer" => DB::table('customers')->where('id', '=', $customerID)->pluck("name")->first,
                "customer_phone" => DB::table('customers')->where('id', '=', $customerID)->get("phone")->first(),

                "estimated_completion_time" => $project->estimated_completion_time,
                "estimated_budget" => $project->estimated_budget,
                "floor" => $project->floor,
                "description" => $project->description,
                "contract_image" => $project->contract_image,
                "assigned_to" => DB::table('users')->where('id', '=', $contractorID)->get("name")->first(),
                "assigned_by" => DB::table('users')->where('id', '=', $managerID)->get("name")->first(),
                "status" => DB::table("project_status")->where('id', '=', $project_statusID)->get("name")->first(),
                "phase" => DB::table('project_phase')->where('id', '=', $project_phaseID)->get("name")->first(),
            ];
           //dd($data);
    // dd($data[0]['customer']);
            //dd(DB::table('customers')->where('id', '=', $customerID)->get("phone")->first());
       */


        if ($projects == null || count($projects) == 0) {
            return redirect()->intended('projects/index');
        }

       /* if ($projects == null || count($projects) == 0) {
            return redirect()->intended('projects/index');
        }
        */
        $request_status = DB::table('material_request_statuses')->where('name','=','pending')->pluck('id')->first();
        $materialrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)->paginate(5);
    
        $total_pending_requests = DB::table('material_requests')->where('request_status_id','=',$request_status)->count();
        //$users = User::paginate(10);
        return view('projects/view', compact('projects','customers','labors','orders','contractors','total_orders','balance','expense','materialrequests','total_pending_requests'));
        // ['data' => $data],['orders' => $orders]);
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
             'contract_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'

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

        $projects->contract_image = $request->input('contract_image');


        if ($request->has('contract_image')) {
            // Get image file
            $image = $request->file('contract_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($projects->title . '-' . time());
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
//            $this->deleteOne( 'public', $project->contract_image);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $projects->contract_image = $filePath;
        }
        $projects->save();
        // Return user back and show a flash message
        return redirect()->back()->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $labors = DB::table('labors')->where('project_id','=',$id)->count();
        $orders = DB::table('order_details')->where('project_id','=',$id)->count();
        if($orders <= 0)
        {
             if ($labors <= 0)
            {
                Project::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Project Deleted Succuessfully.');
            } 
            else {
                return redirect()->back()->with('message', 'Labor Exists. Please delete labors from project first.');
            }
        }  
        else
        {
                return redirect()->back()->with('message', 'Orders Exists. Please delete Orders from project first');
        }    
       
    }


    public function updateImage(Request $request)
    {


    }


}
