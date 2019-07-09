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
use Charts;
use App\MiscellaneousExpense;

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
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }

        if (Gate::allows('isAdmin')) {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
        }

        if (Gate::allows('isManager')) {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
        }
            $labor_by_projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('labors','labors.project_id','=','projects.id')
            ->select('labors.id','projects.id','projects.title','labors.rate','users.name as contractor_name')
            ->get();
            $contractors = User::all()->where('role_id', '=', 3);

            return view('projects/index', compact('projects', 'contractors', 'labor_by_projects'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('in admin');
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isManager') || Gate::allows('isAdmin')) {
            $check = DB::table('project_phase')->get()->count();
            if ($check != 0) {
                $check = DB::table('project_status')->get()->count();
                if ($check != 0) {
                    $rollID = DB::table('roles')->where('name', '=', 'Contractor')->pluck('id')->first();
                    $check = DB::table('users')->where('role_id', '=', $rollID)->get()->count();
                    if ($check != 0) {
                        $contractors = DB::table('users')->where('role_id', '=', 3)->get();
                        return view('projects/create')->with('contractors', $contractors);
                    } else {
                        return redirect()->intended('home')->with('message', "Please Add Contractors before Adding New Projects ");
                    }

                } else {
                    return redirect()->intended('home')->with('message', "Please Add Project Status before Adding New Projects ");
                }
            } else {
                return redirect()->intended('home')->with('message', "Please Add Project Phases before creating new Projects");
            }
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
        $old_project = Project::where('title', '=', $request->input('title'))->pluck('title')->first();
        if (strtolower($request->input('title')) == strtolower($old_project)) {
            return redirect()->back()->with('message', 'There is already Project with this Title . Please Chnage Project Title');
        } else {
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
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
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
        return view('projects/create', compact('projects', 'contractors'));
    }

    public function labors_by_projects()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        //dd('in labor by projects');
        $labor_by_projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        return view('projects/laborbyprojects', compact('labor_by_projects'));
    }


    public function halt()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if(Gate::allows('isAdmin'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('project_status.name','=','Halt')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
        }
        if(Gate::allows('isManager'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->where('project_status.name','=','Halt')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
        }
        $contractors = User::all()->where('role_id', '=', 3);
        return view('projects/projects', compact('projects', 'contractors'));
    }
    public function stopped()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if(Gate::allows('isAdmin'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('project_status.name','=','Stopped')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
        }
        if(Gate::allows('isManager'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->where('project_status.name','=','Stopped')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
        }
        $contractors = User::all()->where('role_id', '=', 3);
        return view('projects/projects', compact('projects', 'contractors'));
    }

    public function completed()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if(Gate::allows('isAdmin'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('project_status.name','=','Completed')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();    
        }
        if(Gate::allows('isManager'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->where('project_status.name','=','Completed')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();    
        }

        $contractors = User::all()->where('role_id', '=', 3);
        return view('projects/projects', compact('projects', 'contractors'));
    }

    public function all()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }

        if (Gate::allows('isAdmin')) {
           $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
            //$projectstotal = DB::table('projects')->get();//Project::all();
            $contractors = DB::table('users')->where('role_id', '=', 3)->get();
            return view('projects/projects', compact('projects'), ['contractors' => $contractors]);
        }
        if (Gate::allows('isManager')) {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();
            /* ->join('users', 'users.id', '=', 'projects.assigned_to')
            ->join('customers', 'customers.id', '=', 'projects.customer_id')*/
            $contractors = DB::table('users')->where('role_id', '=', 3)->get();
            return view('projects/projects', compact('projects'), ['contractors' => $contractors]); 
        }
    }


    public function notstarted()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
         if(Gate::allows('isAdmin'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('project_status.name','=','Not Started')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();    
        }
        if(Gate::allows('isManager'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->where('project_status.name','=','Not Started')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();    
        }
        $contractors = User::all()->where('role_id', '=', 3);
        return view('projects/projects', compact('projects', 'contractors'));
    }

    public function inprogress()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
         if(Gate::allows('isAdmin'))
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('project_status.name','=','In Progress')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();    
        }
        if(Gate::allows('isManager')) 
        {
            $projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('customers','projects.customer_id','=','customers.id')
            ->leftjoin('project_status','projects.status_id','=','project_status.id')
            ->where('projects.assigned_by', '=', Auth::user()->id)
            ->where('project_status.name','=','In Progress')
            ->select('projects.id','projects.title','projects.city','projects.estimated_budget as budget','customers.name as customer_name','customers.phone as customer_phone','users.name as contractor_name')
            ->get();    
        }

        $contractors = User::all()->where('role_id', '=', 3);
        return view('projects/projects', compact('projects', 'contractors'));
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
            return view('projects/laborbyprojects', compact('labor_by_projects'));
        }
        if (!is_null($search_contractor)) {
            // _____________________________________ contractor search queryyy _______________

            $labor_by_projects = DB::table('projects')->where('assigned_to', 'like', '%' . '2' . '%')->get();
            return view('projects/laborbyprojects', compact('labor_by_projects'));
        } else {
            return redirect()->back()->with('message', 'No Record Found');

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
            compact('customer', 'contractors'),
            compact('projects')
//            compact()
        );
    }


    public function viewuser($id)
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }

        $projects = DB::table('projects')->where('id', '=', $id)->get()->first();

        $labors = DB::table('labors')->where('project_id', '=', $id)->get()->all();
      
        $orders = DB::table('order_details')->where('project_id', '=', $id)->paginate(5);

        $total_orders_count = DB::table('order_details')->where('project_id', '=', $id)->count();

        $selectedproject = DB::table('projects')->where('id', '=', $id)->pluck('id')->first();

        $customers = DB::table('customers')->where('id', '=', $selectedproject)->get()->first();
      
        $contractors = DB::table('projects')->join('users', 'users.id', '=', 'projects.assigned_to')
            ->where('projects.id', '=', $id)->get()->first();

        $expense = DB::table('miscellaneous_expenses')->where('project_id', '=', $id)->sum('expense');
        
        $total_orders =DB::table('order_details')->where('order_details.project_id','=',$id)->get();
        $orders_sum = 0;
        $total = 0;
            foreach ($total_orders as $order)
            {
                $total =  $order->set_rate * $order->quantity;
                $orders_sum = $total + $orders_sum;
            }
           
        $projects = DB::table('projects')->where('id', '=', $id)->get()->first();
       

        $spent = $orders_sum + $expense;
        $balance = $projects->estimated_budget - $spent;

        $received_payments = DB::table('customer_payments')->where('project_id','=',$id)->sum('received');

       
        if ($projects == null || count($projects) == 0) {
            return redirect()->intended('projects/index');
        }
        $request_status = DB::table('material_request_statuses')->where('name', '=', 'pending')->pluck('id')->first();

         $materialrequests = DB::table('material_requests')
                ->leftjoin('items', 'items.id', '=', 'material_requests.item_id')
                ->leftjoin('material_request_statuses', 'material_request_statuses.id', '=', 'material_requests.request_status_id')
                ->leftjoin('projects', 'projects.id', '=', 'material_requests.project_id')
                ->leftjoin('users', 'users.id', '=', 'material_requests.requested_by')
                ->where('material_requests.request_status_id', '=', $request_status)
                ->select('material_requests.id', 'material_request_statuses.name as status_name', 'material_request_statuses.id as request_status_id', 'material_requests.quantity', 'material_requests.seen', 'material_requests.instructions', 'projects.title', 'items.name as item_name', 'users.name as contractor_name')->paginate(5);


 
            $expense_chart = MiscellaneousExpense::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
                        $chart = Charts::database($expense_chart, 'bar', 'highcharts')
                            ->title("Expenses")
                            ->elementLabel("Extra Expense")
                            ->dimensions(1000, 500)
                            ->responsive(true)
                            ->groupByMonth(date('Y'), true);

               
                 $pie_chart = Charts::create('pie', 'highcharts')
                            ->title('Cost Comparison')
                            ->labels(['Orders', 'labors', 'Expenses'])
                            ->values([$orders_sum,5000, $expense])
                            ->dimensions(120, 3232, 200)
                            ->responsive(true);
     
     $percent =  $spent * 100;
     $percent =  $percent/$projects->estimated_budget;
     

      $percentage_chart = Charts::create('percentage', 'justgage')
            ->title('Project Completed')
            ->elementLabel('%')
            ->values([65, 0, 100])
            ->responsive(true)
            ->height(300)
            ->width(0);




             $percentage_chart_budget = Charts::create('percentage', 'justgage')
            ->title('Budget Used')
            ->elementLabel('%')
            ->values([$percent, 0, 100])
            ->responsive(true)
            ->height(300)
            ->width(0);






        $total_pending_requests = DB::table('material_requests')->where('request_status_id', '=', $request_status)->count();

        return view('projects/view', compact('projects', 'customers', 'labors', 'orders', 'contractors', 'total_orders_count','spent','balance', 'expense_chart', 'materialrequests', 'total_pending_requests', 'pie_chart','chart','percentage_chart','percentage_chart_budget','received_payments'));
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
        $labors = DB::table('labors')->where('project_id', '=', $id)->count();
        $orders = DB::table('order_details')->where('project_id', '=', $id)->count();
        if ($orders <= 0) {
            if ($labors <= 0) {
                Project::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Project Deleted Succuessfully.');
            } else {
                return redirect()->back()->with('message', 'Labor Exists. Please delete labors from project first.');
            }
        } else {
            return redirect()->back()->with('message', 'Orders Exists. Please delete Orders from project first');
        }

    }


    public function updateImage(Request $request)
    {


    }


}
