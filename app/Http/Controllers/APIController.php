<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class APIController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function api_login(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::where('email', '=', $email)->first();

        if (Hash::check($password, $user->password)) {
            print "success";
        } else {
            print "failed";
        }

    }

    public function api_logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

//        return $this->loggedOut($request) ?: redirect('/');

        return "successfully logged out";
    }

    public function api_all_contractors(){
        $contractors = Contractor::all();

        $contractor['success'] = 1;

        return response()->json($contractors);
    }
}
