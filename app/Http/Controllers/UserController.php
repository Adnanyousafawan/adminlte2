<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Gate;
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
            return view('users/index', compact('users , roles'));
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
            return view('users/index', compact('users' , 'roles'));
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
         $users = DB::table('users')->where('role_id','!=',1)->get();
         return view('users/index',compact('users' , 'roles'));
         }
         if (Gate::allows('isManager')) {
         $roles = DB::table('roles')->where('id', '=', 3)->get();
         $users = DB::table('users')->where('role_id','=',3)->get();
         return view('users/index',compact('users' , 'roles'));
         }
           if (Gate::allows('isContractor')) {
           abort(404,"Sorry you are not Allowed ");
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       if (Gate::allows('isAdmin'))  
        {
            $roles = DB::table('roles')->where('id', '!=', 1)->get();
            return view('users/create', compact('roles'));
        }
        if (Gate::allows('isManager')) {
            $roles = DB::table('roles')->where('id', '=', 3)->get();
            return view('users/create', compact('roles'));
        }
         if (Gate::allows('isContractor')) {
           abort(404,"Sorry you are not Allowed ");
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

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'password' => 'required | min:8',
            'cnic' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);

        $rollID = DB::table('roles')
            ->where('name', '=', $request->input('role'))
            ->get()
            ->first();

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'password' => $request->input('password'),
            'cnic' => $request->input('cnic'),
            'phone' => $request->input('phone'),
            'role_id' => $rollID,
            'profile_image' => $request->input('profile_image')

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
        $user->save();

        // Return user back and show a flash message
        return redirect()->route('users.index')->with(['status' => 'User added successfully.']);
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
        return view('users.index', compact('users'));
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
        //$users = User::paginate(10);
        return view('/users/edit', ['users' => $users]);
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
        $users = User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');

        $users->address = $request->input('address');

        $users->cnic = $request->input('cnic');
        $users->phone = $request->input('phone');

        //'role_id' => $request->input('user_role'),
        // 'profile_image'=> $request->input('profile_image')
        $users->save();
        return redirect()->route('users.index')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\create_users_table $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = DB::table('users')
            ->join('projects', 'projects.assigned_to', '=', $id)
            ->count();
        dd($check);

        if ($check == 0) {
            User::where('id', $id)->delete();
            return redirect()->intended('users.index');
        } else {
            return redirect()->route('users.index')->with('message', 'Project is Currently Assigned to Contractor. Cannot Delete Contractor');

        }


    }

    public function view_user($id)
    {
        /*$userbyid = DB::table('users')
        ->join('roles','users.role_id','=','roles.id')
        ->select('users.*','')*/

    }

}
