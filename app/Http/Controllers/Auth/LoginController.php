<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $date = Carbon::now();
        $check = DB::table('roles')->get()->count();
        if ($check == 0)
        {
                DB::table('roles')->insert([
                    ['name' => 'Admin','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Manager','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Contractor','created_at'=> $date , 'updated_at'=> $date]
                    ]); 
        }
         $check = DB::table('project_phase')->get()->count();
        if ($check == 0)
        {
                DB::table('project_phase')->insert([
                    ['name' => 'Not Started'],
                    ['name' => 'Excavation'],
                    ['name' => 'Foundation'],
                    ['name' => 'Flooring'],
                    ['name' => 'Side Walls'],
                    ['name' => 'Lantar'],
                    ['name' => 'Roofing'],
                    ['name' => 'Sanitary'],
                    ['name' => 'Electricity Works'],
                    ['name' => 'Tiling'],
                    ['name' => 'Paint'],
                    ['name' => 'Finish']
                    ]);
        }
        $check = DB::table('project_status')->get()->count();
        if ($check == 0)
        {
                DB::table('project_status')->insert([
                    ['name' => 'Not Started'],
                    ['name' => 'In Progress'],
                    ['name' => 'Completed'],
                    ['name' => 'Stopped'],
                    ['name' => 'Halt']
                    ]);
        }
        $check = DB::table('labor_status')->get()->count();
        if ($check == 0)
        {
                DB::table('labor_status')->insert([
                    ['name' => 'Active'],
                    ['name' => 'Not Active']
                    ]);
        }
        $check = DB::table('material_request_statuses')->get()->count();
        if ($check == 0)
        {
                DB::table('material_request_statuses')->insert([
                    ['name' => 'Pending','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Approved','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Rejected','created_at'=> $date , 'updated_at'=> $date]
                    ]);
        }
        $check = DB::table('users')->get()->count();
        if ($check == 0)
        {
            $rollID = DB::table('roles')->where('name','=','Admin')->pluck('id')->first();
                DB::table('users')->insert([
                    ['name' => 'Admin','email'=>'admin@cstms.com','role_id'=>$rollID,'password'=>'$2y$10$UzENq9Ls52fSOPyj2aSONekXSCE3qDPhTEIJxV/fHIVKEHFQp61aO','created_at'=> $date , 'updated_at'=> $date]
                    ]);
                 Auth::logout();
        }
       
        $this->middleware('guest')->except('logout');
    }

}
