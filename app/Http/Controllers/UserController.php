<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;
use Gate;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
       $users = DB::table('users')->get();
       return view('users/index',compact($users));
=======
        /*
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

    public function manager()
    {
        if (Gate::allows('isAdmin')) {
            $roles = DB::table('roles')->where('id', '!=', 1)->get();
            $users = DB::table('users')->where('role_id', '=', 2)->get();
            return view('users/index', compact('users', 'roles'));
        }
        if (Gate::allows('isManager')) {
            abort(404, "Sorry, You cant  Access this Page");
        }

    }

    public function contractor()
    {
        if (Gate::allows('isAdmin')) {
            $roles = DB::table('roles')->where('id', '!=', 1)->get();
            $users = DB::table('users')->where('role_id', '=', 3)->get();
            return view('users/index', compact('users', 'roles'));
        }
        if (Gate::allows('isManager')) {
            $roles = DB::table('roles')->where('id', '=', 3)->get();
            $users = DB::table('users')->where('role_id', '=', 3)->get();
            return view('users/index', compact('users', 'roles'));
        }

    }

    public function all()
    {
        if (Gate::allows('isAdmin')) {
            $roles = DB::table('roles')->where('id', '!=', 1)->get();
            $users = DB::table('users')->where('role_id', '!=', 1)->get();

            return view('users/index', compact('users', 'roles'));
        }
        if (Gate::allows('isManager')) {
            $roles = DB::table('roles')->where('id', '=', 3)->get();
            $users = DB::table('users')->where('role_id', '=', 3)->get();
            return view('users/index', compact('users', 'roles'));
        }
        if (Gate::allows('isContractor')) {
            abort(404, "Sorry you are not Allowed ");
        }

>>>>>>> 58b8a40facc7caec51d3528b32bbd462b0d9e0d4
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        
        $roles = DB::table('roles')->get(); 
        return view('users/create',compact('roles'));
=======

        if (Gate::allows('isAdmin')) {
            $roles = DB::table('roles')->where('id', '!=', 1)->get();
            return view('users/create', compact('roles'));
        }
        if (Gate::allows('isManager')) {
            $roles = DB::table('roles')->where('id', '=', 3)->get();
            return view('users/create', compact('roles'));
        }
        if (Gate::allows('isContractor')) {
            abort(404, "Sorry you are not Allowed ");
        }
>>>>>>> 58b8a40facc7caec51d3528b32bbd462b0d9e0d4

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Htt p\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            //'password' => 'required | min:8',
            'cnic' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);

        $rollID = DB::table('roles')
            ->where('name', '=', $request->input('role'))
            ->pluck('id')->first();
        $password = Hash::make('init1234');


        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'cnic' => $request->input('cnic'),
            'password' => $password,
            'phone' => $request->input('phone'),
            'role_id' => $rollID,
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
        //dd($current_role);
        //$users = User::paginate(10);
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
