<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Htt p\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
         $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_gender' => 'required',
            'user_age' => 'required',
            'user_address' => 'required',
            'user_city' => 'required',
            'user_cnic' => 'required',
            'user_phone_number' => 'required',
            'user_role' => 'required',
           // 'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'

        ]);

        $User = new User([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'gender' => $request->input('user_gender'),
            'age' => $request->input('user_age'),
            'address' => $request->input('user_address'),
            'city' => $request->input('user_city'),
            'cnic' => $request->input('user_cnic'),
            'phone_number' => $request->input('user_phone_number'),
            'password' => $request->input('user_pass')
            //'role_id' => $request->input('user_role'),
           // 'profile_image'=> $request->input('profile_image')

        ]);

/*
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($create_users_table->name . '-' . time());
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
//            $this->deleteOne( 'public', $project->contract_image);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $create_users_table->upload_profile = $filePath;
        }
        */
        // Persist user record to database
        $User->save();

        // Return user back and show a flash message
        return redirect()->route('users/index')->with(['status' => 'Project added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\create_users_table  $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

public function search_user(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_name');
        $search_email = $request->get('search_email');
        if (!is_null($search)) 
        {
            $users = DB::table('users')->where('name','like','%'.$search.'%')->paginate(20);
            return view('users/index', ['users' => $users]);
        }
        if (!is_null($search_email)) 
        {
            $users = DB::table('users')->where('email','like','%'.$search_email.'%')->paginate(20);
            return view('users/index', ['users' => $users]);
        }
        else
        {
            $users = User::paginate(20);
            return view('users/index', ['users' => $users]);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\create_users_table  $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($users == null || count($users) == 0)
         {
            return redirect()->intended('/users/index');
        }
        //$users = User::paginate(10);
        return view('/users/edit', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\create_users_table  $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_gender' => 'required',
            'user_age' => 'required',
            'user_address' => 'required',
            'user_city' => 'required',
            'user_cnic' => 'required',
            'user_phone_number' => 'required',
            'user_role' => 'required',
           // 'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);
        $users = User::find($id);
        $users->name = $request->input('user_name');
        $users->email = $request->input('user_email');
        $users->gender = $request->input('user_gender');
        $users->age = $request->input('user_age');
        $users->address = $request->input('user_address');
        $users->city = $request->input('user_city');
        $users->cnic = $request->input('user_cnic');
        $users->phone_number = $request->input('user_phone_number');
        $users->password = $request->input('user_pass');
            //'role_id' => $request->input('user_role'),
           // 'profile_image'=> $request->input('profile_image')
        $users->save();
        return redirect()->route('users.index')->with('success','Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\create_users_table  $create_users_table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->intended('users/index');
    }
    public function view_user($id)
    {
        /*$userbyid = DB::table('users')
        ->join('roles','users.role_id','=','roles.id')
        ->select('users.*','')*/

    }
    
}
