<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use View;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Project;
use Gate;


class HomeController extends Controller
{
    use UploadTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function goBackToHome()
    {
         
        return view('welcome');
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
    }

    public function index()
    {
        if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }

        //_________________________ Dashboard Boxes Count _____________________________________
        $status_id = DB::table('project_status')->where('name','=','Completed')->pluck('id')->all();
        $expense = DB::table('miscellaneous_expenses')->sum('expense');
        $projects = DB::table('projects')->get();
        $total_contractors = DB::table('users')->where('id','=',3)->count();
        $completed_projects = DB::table('projects')->where('status_id', '=', $status_id)->count();
        $current_projects =  DB::table('projects')->where('status_id', '!=', $status_id)->count();
        //_______________________________________________________________________________________


        //_________________________ Monthly Graph _______________________________________________

        //_______________________________________________________________________________________

        //_______________ ____________ Material List _____________________________________________



        //_______________________________________________________________________________________

        //____________________________Current Projects___________________________________________


        //_______________________________________________________________________________________


        //____________________________Order Details______________________________________________

         $orders = DB::table('order_details')->paginate(5);



        //_______________________________________________________________________________________


        //____________________________Users Box__________________________________________________
            
        // $total_free_contractors = DB::table('users')->where('id','=',3)->count();
        // $working_contractors = 

        //_______________________________________________________________________________________


        //DB::table()->where('status_id','=',$status_id)->get()->count();

       // dd($completed_projects);
        return view('home', compact('projects','total_contractors','completed_projects','current_projects','expense','orders'));
       
    }

    public function addcontractor()
    {
        return view('contractors/add_contractor')->with('success', 'New Contractor has been added');
    }

    public function addlabor()
    {
        return view('labors/add_labor');
    }

    public function addmanager()
    {
        return view('managers/add_manager');
    }

    public function addsupplier()
    {
        return view('suppliers/add_supplier');
    }

    public function starter()
    {
        return view('starter');
    }

    public function usermanagement()
    {
        return view('user_management');
    }


    public function profile()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        return view('profile');

    }


    public function updateImage(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);
        $user->name = Auth::user()->name;

        $request->validate([
            'name' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);


        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')) . '-' . time();
            // Define folder path
            $folder = 'images/profile/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
            $this->deleteOne('public', Auth::user()->profile_image);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
}
