<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Labor;
use App\Project;
use App\ProjectPhase;
use App\ProjectStatus;
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
            $project_phaseID = $projects->pluck("phase_id")->get($i);
            $project_statusID = $projects->pluck("status_id")->get($i);

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
                "status" => DB::table("project_status")->where('id', '=', $project_statusID)->get("name")->first(),
                "phase" => DB::table('project_phase')->where('id', '=', $project_phaseID)->get("name")->first(),
            ];

        }

//    return View::make('testing')->with(compact('projects', 'contractors', 'customers'));
//    return response()->json(compact('projects', 'contractors', 'customers'));
        return response()->json($check);
    }

    public function api_project_list()
    {
        $project = Project::all();
        return response()->json($project);

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

        if ($id->pluck('title')->first() != $request->input('project_id')) {
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
        $index = 0;
        for ($i = 0; $i < $projects->count(); $i++) {
            $projectID = DB::table('projects')->pluck('id')->get($i);
            $statusID = DB::table('projects')->pluck('status_id')->get($i);
            if ($statusID == 2) {
                continue;
            } else {
                $labors = DB::table('labors')->where('project_id', '=', $projectID)->count();
                $check[$index] = [
                    "id" => DB::table("projects")->pluck("id")->get($i),
                    "title" => DB::table("projects")->pluck("title")->get($i),
                    "status" => DB::table("project_status")
                        ->where('id', '=', $statusID)
                        ->get('name')
                        ->first(),
                    "labors" => $labors
                ];
                $index++;
            }
        }
        return response()->json($check);
    }

    public function api_completed_projects()
    {
        $projects = Project::all();
        $check = [];


        $index = 0;
        for ($i = 0; $i < $projects->count(); $i++) {
            $projectID = DB::table('projects')->pluck('id')->get($i);
            $statusID = DB::table('projects')->pluck('status_id')->get($i);
            if ($statusID != 2) {
                continue;
            } else {
                $labors = DB::table('labors')->where('project_id', '=', $projectID)->count();
                $check[$index] = [
                    "id" => DB::table("projects")->pluck("id")->get($i),
                    "title" => DB::table("projects")->pluck("title")->get($i),
                    "status" => DB::table("project_status")
                        ->where('id', '=', $statusID)
                        ->get('name')
                        ->first(),
                    "labors" => $labors
                ];
                $index++;
            }
        }
        return response()->json($check);
    }

    public function api_all_labors()
    {
        $labors = Labor::all();

        return response()->json($labors);
    }

    public function api_project_details(Request $request)
    {
        $title = $request->get("title");

        $result = DB::table('projects')->where('title', '=', $title)->first();

        return response()->json($result);
    }

    public function api_update_labor_status(Request $request)
    {
        $labor_name = $request->get("labor_name");

        $labor_id = DB::table('labors')
            ->where('name', '=', $labor_name)
            ->get("id")
            ->first();

        $status = $request->get("status");

        $labor = Labor::findOrFail($labor_id->id);

        $labor->status = $status;

        if ($labor->save()) {
            return "status updated";
        } else {
            return "status not updated";
        }

    }

    public function api_projects_longpress_dialog()
    {
        $phase = ProjectPhase::all();
        $status = ProjectStatus::all();

        return response()->json(['phases' => $phase, 'status' => $status]);
    }

    public function api_projects_longpress_dialog_update(Request $request)
    {
        $status = $request->get("status");
        $phase = $request->get("phase");
        $project_title = $request->get("project_title");

        $statusID = DB::table('project_status')->where('name', '=', $status)->get('id')->first();
        $phaseID = DB::table('project_phase')->where('name', '=', $phase)->get('id')->first();

        $projectID = DB::table('projects')
            ->where('title', '=', $project_title)
            ->get('id')
            ->first();


        $project = Project::find($projectID->id);

//        dd($statusID->id);

        $project->status_id = $statusID->id;
        $project->phase_id = $phaseID->id;

        if ($project->save()) {
            return "success";
        } else {
            return "failed";
        }


    }
}
