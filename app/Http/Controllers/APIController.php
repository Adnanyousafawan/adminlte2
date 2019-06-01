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
        $projects = Project::all();


        $check = [];
        for ($i = 0; $i < $projects->count(); $i++) {

            $contractorID = $projects->pluck("assigned_to")->get($i);
            $customerID = $projects->pluck("customer_id")->get($i);
            $managerID = $projects->pluck("assigned_by")->get($i);
            $phaseID = $projects->pluck("phase_id")->get($i);

            $check[$i] = [
                "id" => DB::table("projects")->pluck("id")->get($i),
                "title" => DB::table("projects")->pluck("title")->get($i),
                "area" => DB::table("projects")->pluck("area")->get($i),
                "city" => DB::table("projects")->pluck("city")->get($i),
                "plot_size" => DB::table("projects")->pluck("plot_size")->get($i),
                "customer" => DB::table('customers')->where('id', '=', $customerID)->get("name")->first(),
                "estimated_completion_time" => DB::table("projects")->pluck("estimated_completion_time")->get($i),
                "estimated_budget" => DB::table("projects")->pluck("estimated_budget")->get($i),
                "floor" => DB::table("projects")->pluck("floor")->get($i),
                "description" => DB::table("projects")->pluck("description")->get($i),
                "contract_image" => DB::table("projects")->pluck("contract_image")->get($i),
                "assigned_to" => DB::table('users')->where('id', '=', $contractorID)->get("name")->first(),
                "assigned_by" => DB::table('users')->where('id', '=', $managerID)->get("name")->first(),
                "status" => DB::table("projects")->pluck("status")->get($i),
                "phase" => DB::table('phases')->where('id', '=', $phaseID)->get("name")->first(),
            ];

        }

//    return View::make('testing')->with(compact('projects', 'contractors', 'customers'));
//    return response()->json(compact('projects', 'contractors', 'customers'));
        return response()->json($check);
    }

    public function api_project_list()
    {
//        if ($request->input("check") == "1") {
//
//            $id = DB::table('projects')
//                ->where('title', '=', $request->input('project'))
//                ->get('id');
//            $labor = new Labor([
//                'name' => $request->input('name'),
//                'rate' => $request->input('rate'),
//                'project_id' => $id[0]->id
//            ]);
//
//            $labor->save();
//
//            return "Record added";
//        } else {
        $project = Project::all();
        return response()->json($project);
//        }

    }


    public function api_add_labor(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'rate' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'cnic' => 'required',
            'project_id' => 'required'
        ]);


        $id = DB::table('projects')
            ->where('title', '=', $request->input('project_id'));

        if ($id->pluck('title')->first() != $request->input('project_id')){
            return "Error";
        }

        $labor = new Labor([
            'name' => $request->input('name'),
            'rate' => $request->input('rate'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'cnic' => $request->input('cnic'),
            'project_id' => $id->pluck('id')->first()
        ]);


        if ($labor->save()) {
            return "Record added";
        } else {
            return "Labor record not added";
        }


    }

    public function api_ongoing_projects()
    {
        $projects = Project::all();
        $check = [];
        for ($i = 0; $i < $projects->count(); $i++) {
            $projectID = DB::table('projects')->pluck('id')->get($i);
            if (DB::table("projects")->pluck("status")->get($i) == "Completed" ||
                DB::table("projects")->pluck("status")->get($i) == "Stopped"){
                continue;
            } else {
                $labors = DB::table('labors')->where('project_id','=', $projectID)->count();
                $check[$i] = [
                    "id" => DB::table("projects")->pluck("id")->get($i),
                    "title" => DB::table("projects")->pluck("title")->get($i),
                    "status" => DB::table("projects")->pluck("status")->get($i),
                    "labors" => $labors
                ];
            }
        }
        return response()->json($check);
    }

    public function api_completed_projects()
    {
        $projects = Project::all();
        $check = [];
        for ($i = 0; $i < $projects->count(); $i++) {
            $projectID = DB::table('projects')->pluck('id')->get($i);
            if (DB::table("projects")->pluck("status")->get($i) != "Completed"){
                continue;
            } else {
                $labors = DB::table('labors')->where('project_id','=', $projectID)->count();
                $check[$i] = [
                    "id" => DB::table("projects")->pluck("id")->get($i),
                    "title" => DB::table("projects")->pluck("title")->get($i),
                    "status" => DB::table("projects")->pluck("status")->get($i),
                    "labors" => $labors
                ];
            }
        }
        return response()->json($check);
    }


}
