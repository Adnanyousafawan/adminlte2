<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;
use Gate;
use Hash;
use Illuminate\Http\Request;
use Charts;

class UserController extends Controller
{
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
        /*
                 if (Gate::allows('isAdmin')) {
                    $roles = DB::table('roles')->where('id', '!=', 1)->get();
                    $users = DB::table('users')->get();
                    return view('users/index', compact('users','roles'));
                }



                   $users = DB::table('users')->get();
                    $roles = DB::table('roles')->where('id', '!=', 1)->get();
                   return view('users/index',compact('users','roles'));
                        if (Gate::allows('isAdmin')) {
                            $users = DB::table('users')->where('role_id', '!=', 1)->get();
                            return view('users/index', compact('users'));

                            //abort(404, "Sorry, You cant  Access this Page");
                        }

                        if (Gate::allows('isManager')) {
                            $users = DB::table('users')->where('role_id', '=', 3)->get();
                            return view('users/index', compact('users'));
                        }
                         */

    }

public function UpdateName(Request $request,$id)
{
    $user = User::find($id);

    $user->name = $request->input('name');

    $user->save();

    return redirect()->back()->with('success','Name is updated successfully');


}

    public function profile($id)
    {

        $users = DB::table('users')
        ->leftjoin('roles','roles.id','=','users.role_id')
        ->where('users.id', '=', $id)
        ->select('users.profile_image','users.id','users.name','users.role_id','users.address','users.phone','users.email','users.cnic','users.created_at','roles.name as role_name')
        ->get()
        ->first();

        if ($users->role_id == 2) {

            $projects = DB::table('projects')
            ->leftjoin('customers','customers.id','=','projects.customer_id')
            ->where('assigned_by', '=', $id)
            ->select('projects.id','projects.title','projects.estimated_budget','projects.area','projects.assigned_by','customers.name as customer_name','customers.phone','customers.address')
            ->get()->all();

            $proj_status = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $completed_projects = DB::table('projects')->where('assigned_by','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','In Progress')->pluck('id')->first();
            $current_projects = DB::table('projects')->where('assigned_by','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','Stopped')->pluck('id')->first();
            $stopped_projects = DB::table('projects')->where('assigned_by','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','Halt')->pluck('id')->first();
            $halt_projects = DB::table('projects')->where('assigned_by','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','Not Started')->pluck('id')->first();
            $not_started_projects = DB::table('projects')->where('assigned_by','=',$id)->where('status_id','=',$proj_status)
            ->count();

        $ProjectsProfit = 0;
        $ProjectsLoss =0;
        $ProjectsProfit_OR_Loss =0;
        $spent = 0;
        $ProjStatusID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
        $Comp_projects = DB::table('projects')->where('assigned_by','=',$id)->where('status_id','=',$ProjStatusID)->get();
       
        
    $total_labor_cost = 0;
       
       foreach ($Comp_projects as $proj)
        {
            $labors = DB::table('labors')->where('project_id', '=', $proj->id)->get()->all();
            foreach ($labors as $labor) 
            {
                $temp = DB::table('labor_attendances')
                ->where('labor_id','=',$labor->id)
                ->where('status','=',1)
                ->where('paid','=',1)
                ->count();
                $cost = $temp * $labor->rate;
                $total_labor_cost = $total_labor_cost + $cost;
            }
       }
       //dd($total_labor_cost);
        $all_projects = DB::table('projects')
        ->where('assigned_by','=',$id)
        ->where('status_id','=',$ProjStatusID)
        ->where('project_balance','>=',0)
        ->sum('project_balance');
        $ProjectsProfit_OR_Loss = $all_projects - $total_labor_cost;
        //dd($ProjectsProfit);
        if($ProjectsProfit_OR_Loss > 0)
        {
            $ProjectsProfit = $ProjectsProfit_OR_Loss;
        }
        if($ProjectsProfit_OR_Loss < 0)
        {
            $ProjectsLoss = $ProjectsProfit_OR_Loss;
        }
 


/*
            $loss = DB::table('projects')
            ->where('assigned_by','=',$id)
            ->where('status_id','!=',1)
            ->where('status_id','!=',2)
            ->where('project_balance','<',0)
            ->sum('project_balance');

            $profit = DB::table('projects')
            ->where('assigned_by','=',$id)
            ->where('status_id','=',1)
            ->where('project_balance','>',0)
            ->sum('project_balance');
*/
            $pie_chart = Charts::create('pie', 'highcharts')
                ->title('Comparison')
                ->labels(['Profit', 'Loss'])
                ->values([$ProjectsProfit, $ProjectsLoss])
                ->dimensions(1000, 500) 
                ->responsive(true);


            return view('users/profile', ['users' => $users], compact('projects', 'pie_chart','halt_projects','not_started_projects','stopped_projects','current_projects','completed_projects','assigned_by'));
        }
        if ($users->role_id == 3) {

            $projects = DB::table('projects')->where('assigned_to', '=', $id)->get()->all();
            $proj_status = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $completed_projects = DB::table('projects')->where('assigned_to','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','In Progress')->pluck('id')->first();
            $current_projects = DB::table('projects')->where('assigned_to','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','Stopped')->pluck('id')->first();
            $stopped_projects = DB::table('projects')->where('assigned_to','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','Halt')->pluck('id')->first();
            $halt_projects = DB::table('projects')->where('assigned_to','=',$id)->where('status_id','=',$proj_status)
            ->count();
            $proj_status = DB::table('project_status')->where('name','=','Not Started')->pluck('id')->first();
            $not_started_projects = DB::table('projects')->where('assigned_to','=',$id)->where('status_id','=',$proj_status)
            ->count();


        $ProjectsProfit = 0;
        $ProjectsLoss =0;
        $ProjectsProfit_OR_Loss =0;
        $spent = 0;
        $ProjStatusID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
        $Comp_projects = DB::table('projects')->where('assigned_to','=',$id)->where('status_id','=',$ProjStatusID)->get();
       
        
    $total_labor_cost = 0;
       
       foreach ($Comp_projects as $proj)
        {
            $labors = DB::table('labors')->where('project_id', '=', $proj->id)->get()->all();
            foreach ($labors as $labor) 
            {
                $temp = DB::table('labor_attendances')
                ->where('labor_id','=',$labor->id)
                ->where('status','=',1)
                ->where('paid','=',1)
                ->count();
                $cost = $temp * $labor->rate;
                $total_labor_cost = $total_labor_cost + $cost;
            }
       }
       //dd($total_labor_cost);
        $all_projects = DB::table('projects')
        ->where('assigned_to','=',$id)
        ->where('status_id','=',$ProjStatusID)
        ->where('project_balance','>=',0)
        ->sum('project_balance');
        $ProjectsProfit_OR_Loss = $all_projects - $total_labor_cost;
        //dd($ProjectsProfit);
        if($ProjectsProfit_OR_Loss > 0)
        {
            $ProjectsProfit = $ProjectsProfit_OR_Loss;
        }
        if($ProjectsProfit_OR_Loss < 0)
        {
            $ProjectsLoss = $ProjectsProfit_OR_Loss;
        }
 
/*
            $loss = DB::table('projects')
            ->where('assigned_to','=',$id)
            ->where('status_id','!=',1)
            ->where('status_id','!=',2)
            ->where('project_balance','<',0)
            ->sum('project_balance');

            $profit = DB::table('projects')
            ->where('assigned_to','=',$id)
            ->where('status_id','=',1)
            ->where('project_balance','>',0)
            ->sum('project_balance');
        */
            $pie_chart = Charts::create('pie', 'highcharts')
                ->title('Pie Chart Demo')
                ->labels(['Profit', 'Loss'])
                ->values([$ProjectsProfit, abs($ProjectsLoss)])
                ->dimensions(1000, 500)
                ->responsive(true);
           
            $projects = DB::table('projects')
                ->leftjoin('customers','customers.id','=','projects.customer_id')
                ->where('assigned_to', '=', $id)
                ->select('projects.id','projects.title','projects.estimated_budget','projects.area','customers.name as customer_name','customers.phone','customers.address','projects.assigned_by')
                ->get()->all();


            return view('users/profile', ['users' => $users], compact('projects', 'pie_chart','halt_projects','not_started_projects','stopped_projects','current_projects','completed_projects','assigned_by'));

        }


    }

    public function manager()
    {
        $is_contractor = 0;
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        };
        if (Gate::allows('isAdmin')) {
            $roleID = DB::table('roles')->where('name','=','Manager')->pluck('id')->first();
            $users = DB::table('users')
            ->leftjoin('roles','users.role_id','=','roles.id')
            ->where('users.role_id','=',$roleID)
            ->select('users.id','users.name','users.profile_image','users.phone','users.address','users.cnic','users.email','roles.id as role_id','roles.name as role_name')
            ->get();
            $roles = DB::table('roles')->where('id', '=',$roleID)->get();
            return view('users/index', compact('users', 'roles','is_contractor'));
        }
        if (Gate::allows('isManager')) {
            abort(404, "Sorry, You cant  Access this Page");
        }
    } 

    public function contractor()
    {
        $is_contractor = 1;
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) {
            $roleID = DB::table('roles')->where('name','=','Contractor')->pluck('id')->first();
            $users = DB::table('users')
            ->leftjoin('roles','users.role_id','=','roles.id')
            ->leftjoin('projects','projects.assigned_to','=','users.id')
            ->where('users.role_id','=',$roleID)
            ->select('users.id','users.name','users.profile_image','users.phone','users.address','users.cnic','users.email','roles.id as role_id','roles.name as role_name','projects.title')
            ->get();
            $roles = DB::table('roles')->where('id', '=',$roleID)->get();
            return view('users/index', compact('users', 'roles','is_contractor'));
        }
         if (Gate::allows('isManager')) {
            $roleID = DB::table('roles')->where('name','=','Contractor')->pluck('id')->first();
            $users = DB::table('users')
            ->leftjoin('roles','users.role_id','=','roles.id')
            ->leftjoin('projects','projects.assigned_to','=','users.id')
            ->where('users.role_id','=',$roleID)
            ->select('users.id','users.name','users.profile_image','users.phone','users.address','users.cnic','users.email','roles.id as role_id','roles.name as role_name','projects.title')
            ->get();
            $roles = DB::table('roles')->where('id', '=',$roleID)->get();
            return view('users/index', compact('users', 'roles','is_contractor'));
        }
    }
 
    public function all()
    {
        $is_contractor = 0;
            if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        
        } 
        if (Gate::allows('isAdmin')) {
            $roleID = DB::table('roles')->where('name','=','Admin')->pluck('id')->first();
            $users = DB::table('users')
            ->leftjoin('roles','users.role_id','=','roles.id')
            ->where('users.role_id','!=',$roleID)
            ->select('users.id','users.name','users.profile_image','users.phone','users.address','users.cnic','users.email','roles.id as role_id','roles.name as role_name')
            ->get();
            $roles = DB::table('roles')->where('id', '!=',$roleID)->get();
        }
        if (Gate::allows('isManager')) {

            $roleID = DB::table('roles')->where('name','=','Contractor')->pluck('id')->first();
            $users = DB::table('users')
            ->leftjoin('roles','users.role_id','=','roles.id')
            ->where('users.role_id','=',$roleID)
            ->select('users.id','users.name','users.profile_image','users.phone','users.address','users.cnic','users.email','roles.id as role_id','roles.name as role_name')
            ->get();
            $roles = DB::table('roles')->where('id', '=',$roleID)->get();
        }
            return view('users/index', compact('users', 'roles','is_contractor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }

        if (Gate::allows('isAdmin')) {
            $roles = DB::table('roles')->where('id', '!=', 1)->get();
            return view('users/create', compact('roles'));
        }
        if (Gate::allows('isManager')) {
            $roles = DB::table('roles')->where('id', '=', 3)->get();
            return view('users/create', compact('roles'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Htt p\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }

        $check = DB::table('users')->where('email','=',$request->input('email'))->count();
           if($check == 1)
           {
                return redirect()->back()->with('message','Email is already in Use');
           }
           else
           {
            $cnic_check = User::where('cnic', '=', $request->input('cnic'))->count();
            if ($cnic_check == 1) {
            return redirect()->back()->with('message', 'There is already User with this CNIC');
        } else {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            //'password' => 'required | min:8',
            'cnic' => 'required',
            'phone' => 'required',
            //'role' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);
   
        $password = Hash::make('init1234');
        if(Gate::allows('isManager'))
        {
            $role = 3;
        }
        if(Gate::allows('isAdmin'))
        {
            $role = $request->input('role');
        }

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'cnic' => $request->input('cnic'),
            'password' => $password,
            'phone' => $request->input('phone'),
            'role_id' => $role,
            'profile_image' => $request->get('profile_image')
        ]);


        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($user->name . '-' . time());
            // Define folder path
            $folder = '/images/profile';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
            //            $this->deleteOne( 'public', $project->contract_image);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->upload_profile = $filePath;
        }
        else 
        { 
            $user->profile_image = 'images/profile/default_user.png';  
        }

        // Persist user record to database
        if ($user->save()) {
            return redirect()->route('users.all')->with(['status' => 'User added successfully.']);
        } else {
            return redirect()->route('users.all')->with(['error' => 'User not added successfully.']);
        }
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\create_users_table $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        $users = User::paginate(10);
        return view('users/index', compact('users'));
    }

    public function search_user(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_name');
        $search_email = $request->get('search_email');
        if (!is_null($search)) {
            $users = DB::table('users')->where('name', 'like', '%' . $search . '%')->paginate(20);
            return view('users/index', ['users' => $users]);
        }
        if (!is_null($search_email)) {
            $users = DB::table('users')->where('email', 'like', '%' . $search_email . '%')->paginate(20);
            return view('users/index', ['users' => $users]);
        } else {
            $users = User::paginate(20);
            return view('users/index', ['users' => $users]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\create_users_table $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        // Redirect to user list if updating user wasn't existed 
        $roles = DB::table('roles')->where('id', '!=', 1)->get();
        $current_role = DB::table('roles')->where('id', '=', $users->role_id)->pluck('name')->first();
        return view('/users/edit', compact('users', 'roles', 'current_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\create_users_table $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'password' => 'required | min:8',
                'cnic' => 'required', 
                'phone' => 'required',
                'role' => 'required',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
            ]);

            $rollID = DB::table('roles')
                ->where('name', '=', $request->input('role'))
                ->pluck('id')->first();
            $password = Hash::make($request->input('password'));

            $users = User::find($id);
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->address = $request->input('address');
            $users->cnic = $request->input('cnic');
            $users->phone = $request->input('phone');
            $users->password = $password;
            $users->role_id = $rollID;

            // 'profile_image'=> $request->input('profile_image')
            if ($users->save()) {
                return redirect()->back()->with('success', 'Data Updated');
            } else {
                return redirect()->back()->with('message', 'Sorry, Data is not updated ');
            }
        }

        if (Gate::allows('isManager')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'cnic' => 'required',
                'phone' => 'required',

                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
            ]);


            $users = User::find($id);
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->address = $request->input('address');
            $users->cnic = $request->input('cnic');
            $users->phone = $request->input('phone');


            // 'profile_image'=> $request->input('profile_image')
            if ($users->save()) {
                return redirect()->back()->with('success', 'Data Updated');
            } else {
                return redirect()->back()->with('message', 'Sorry, Data is not updated ');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\create_users_table $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = DB::table('projects')->where('assigned_to', '=', $id)->count();
        if ($check == 0) {
            User::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Successfully Deleted');
        } else {
            return redirect()->back()->with('message', 'Project is Currently Assigned to Contractor. Cannot Delete Contractor');
        }
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if ($request->input('new_password') == $request->input('confirm_password')) {
            if (Hash::check($request->input('old_password'), Auth::user()->password)) {
                // dd('matching with old');

                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->get('new_password'));
                if ($user->save()) {
                    //dd('inside saving');
                    return view('profile')->with('message', "successfully Changed Password");
                } else {
                    return view('profile')->with('error', "Error Occured");

                }
            } else {
                return view('profile')->with('error', "Old Password Doesn't Matched ");
            }
        } else {
            return view('profile')->with('error', "New Password Doesn't Matched");
        }


    }

    public function view_user($id)
    {
        /*$userbyid = DB::table('users')
        ->join('roles','users.role_id','=','roles.id')
        ->select('users.*','')*/


    }

}
