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

    public function index()
    {
        return view('home');
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
        return view('profile');
    }

 public function datatable()
    {
        return view('datatable');
    }
    public function updateImage(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);
        $user->name = Auth::user()->name;

        $request->validate([
            'name' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);


        if ($request->has('profile')) {
            // Get image file
            $image = $request->file('profile');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')) . '-' . time();
            // Define folder path
            $folder = '/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
            $this->deleteOne( 'public', Auth::user()->profile);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile = $filePath;
        }
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
}