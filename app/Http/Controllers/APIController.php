<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Labor;
use App\Project;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    public function api_all_contractors()
    {
        $contractors = Contractor::all();

        return response()->json($contractors);
    }

    public function api_all_projects()
    {
//        $projects = DB::raw('select contractors.cont_name, contractors.cont_contact from projects inner JOIN
//                contractors on projects.assigned_to = contractors.id where contractors.cont_name="Sibrah Batool" ');

//        $projects = DB::table('projects')
//            ->join('contractors', 'assigned_to', '=', 'contractors.id')
//            ->get();

        $projects = Project::all();

        return response()->json($projects);
    }

    public function api_project_list(Request $request)
    {
        if ($request->input("check") == "1") {

            $id = DB::table('projects')
                ->where('title', '=', $request->input('project') )
                ->get('id');
            $labor = new Labor([
                'name' => $request->input('name'),
                'rate' => $request->input('rate'),
                'project_id' => $id[0]->id
            ]);

            $labor->save();

            return "Record added";
        } else {
            $project = Project::all();
            return response()->json($project);
        }

    }


}
