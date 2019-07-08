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

    public function profile($id)
    {

        $users = DB::table('users')->where('id', '=', $id)->get()->first();

        if ($users->role_id == 2) {

            $projects = DB::table('projects')->where('assigned_by', '=', $id)->get()->all();
            $pie_chart = Charts::create('pie', 'highcharts')
                ->title('Pie Chart Demo')
                ->labels(['Completed', 'Loss', 'Cancelled'])
                ->values([60, 30, 10])
                ->dimensions(1000, 500)
                ->responsive(true);
            return view('users/profile', ['users' => $users], compact('projects', 'pie_chart'));
        }
        if ($users->role_id == 3) {
            $projects = DB::table('projects')->where('assigned_to', '=', $id)->get()->all();
            $pie_chart = Charts::create('pie', 'highcharts')
                ->title('Pie Chart Demo')
                ->labels(['Current', 'Loss', 'Profit'])
                ->values([60, 30, 10])
                ->dimensions(1000, 500)
                ->responsive(true);
            return view('users/profile', ['users' => $users], compact('projects', 'pie_chart'));
        }


    }

    public function manager()
    {
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
            return view('users/index', compact('users', 'roles'));
        }
        if (Gate::allows('isManager')) {
            abort(404, "Sorry, You cant  Access this Page");
        }
    } 

    public function contractor()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) {
            $roleID = DB::table('roles')->where('name','=','Contractor')->pluck('id')->first();
            $users = DB::table('users')
            ->leftjoin('roles','users.role_id','=','roles.id')
            ->where('users.role_id','=',$roleID)
            ->select('users.id','users.name','users.profile_image','users.phone','users.address','users.cnic','users.email','roles.id as role_id','roles.name as role_name')
            ->get();
            $roles = DB::table('roles')->where('id', '=',$roleID)->get();
            return view('users/index', compact('users', 'roles'));
        }
         if (Gate::allows('isManager')) {
            abort(404, "Sorry, You cant  Access this Page");
        }
    }
 
    public function all()
    {
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
            return view('users/index', compact('users', 'roles'));
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
       // dd($request->input('role'));
       /* if (Gate::allows('isAdmin')) {
            $rollID = DB::table('roles')
                ->where('name', '=', $request->input('role'))
                ->pluck('id')->first();
        }
        if (Gate::allows('isManager')) {
            $rollID = DB::table('roles')
                ->where('name', '=', 'Contractor')
                ->pluck('id')->first();
        }
        */
        $password = Hash::make('init1234');

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'cnic' => $request->input('cnic'),
            'password' => $password,
            'phone' => $request->input('phone'),
            'role_id' => $request->input('role'),
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
            $user->profile_image = 'images/profile/userprofile.png';
        }

        // Persist user record to database
        if ($user->save()) {
            return redirect()->route('users.all')->with(['status' => 'User added successfully.']);
        } else {
            return redirect()->route('users.all')->with(['error' => 'User not added successfully.']);
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
        if ($users == null || count($users) == 0) {
            return redirect()->intended('/users/index');
        }
        

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
