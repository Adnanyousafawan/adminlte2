<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Carbon\Carbon;

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
        $check = DB::table('roles')->get()->count();
        if ($check == 0)
        {
            $date = Carbon::now();
                DB::table('roles')->insert([
                    ['name' => 'Admin','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Manager','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Contractor','created_at'=> $date , 'updated_at'=> $date]
                    ]); 
        }
        $check = DB::table('users')->get()->count();
        if ($check == 0)
        {
            $rollID = DB::table('roles')->where('name','=','Admin')->pluck('id')->first();
            $date = Carbon::now();
                DB::table('users')->insert([
                    ['name' => 'Admin','email'=>'admin@cstms.com','role_id'=>$rollID,'password'=>'$2y$10$UzENq9Ls52fSOPyj2aSONekXSCE3qDPhTEIJxV/fHIVKEHFQp61aO','created_at'=> $date , 'updated_at'=> $date]
                    ]);
        }
        $this->middleware('guest')->except('logout');

       
    }

}
