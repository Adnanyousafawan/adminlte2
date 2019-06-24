<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Labor;
use App\LaborAttendance;
use App\LaborStatus;
use App\MaterialRequest;
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
        $role = User::where('email', '=', $email)
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->pluck('roles.name')->first();

        if (Hash::check($password, $user->password)) {
            print "success" . "  " . $role;
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

    public function api_all_projects(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $projects = Project::all()->where('assigned_to', '=', $id);

        $check = [];
        $index = 0;
        foreach ($projects as $project) {

            $contractorID = $project->assigned_to;
            $customerID = $project->customer_id;
            $managerID = $project->assigned_by;
            $project_phaseID = $project->phase_id;
            $project_statusID = $project->status_id;

            $check[$index] = [
                "id" => $project->id,
                "title" => $project->title,
                "area" => $project->area,
                "city" => $project->city,
                "plot_size" => $project->plot_size,
                "customer" => DB::table('customers')->where('id', '=', $customerID)->get("name")->first(),
                "estimated_completion_time" => $project->estimated_completion_time,
                "estimated_budget" => $project->estimated_budget,
                "floor" => $project->floor,
                "description" => $project->description,
                "contract_image" => $project->contract_image,
                "assigned_to" => DB::table('users')->where('id', '=', $contractorID)->get("name")->first(),
                "assigned_by" => DB::table('users')->where('id', '=', $managerID)->get("name")->first(),
                "status" => DB::table("project_status")->where('id', '=', $project_statusID)->get("name")->first(),
                "phase" => DB::table('project_phase')->where('id', '=', $project_phaseID)->get("name")->first(),
            ];
            $index++;
        }

//    return View::make('testing')->with(compact('projects', 'contractors', 'customers'));
//    return response()->json(compact('projects', 'contractors', 'customers'));
        return response()->json($check);
    }

    public function api_project_list(Request $request)
    {

        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $projects = DB::table('projects')->where('assigned_to', '=', $id)->get()->all();

        return response()->json($projects);
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

    public function api_ongoing_projects(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $projects = Project::all()->where('assigned_to', '=', $id);

        $check = [];
        $index = 0;
        foreach ($projects as $project) {
            $status = DB::table('project_status')
                ->where('id', '=', $project->status_id)
                ->pluck('name')
                ->first();
            if ($status == "Completed") {
                continue;
            } else {
                $labors = DB::table('labors')->where('project_id', '=', $project->id)->count();
                $check[$index] = [
                    "id" => $project->id,
                    "title" => $project->title,
                    "status" => DB::table('project_status')->where('name', '!=', "Completed")
                        ->where('id', '=', $project->status_id)
                        ->pluck('name')->first(),
                    "labors" => $labors
                ];
                $index++;
            }
        }
        return response()->json($check);
    }

    public function api_completed_projects(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $projects = Project::all()->where('assigned_to', '=', $id);


        $index = 0;
        $check = [];
        foreach ($projects as $project) {
            $status = DB::table('project_status')
                ->where('id', '=', $project->status_id)
                ->pluck('name')
                ->first();
            if ($status == "Completed") {
                $labors = DB::table('labors')->where('project_id', '=', $project->id)->count();
                $check[$index] = [
                    "id" => $project->id,
                    "title" => $project->title,
                    "status" => DB::table('project_status')->where('name', '=', "Completed")
                        ->pluck('name')
                        ->first(),
                    "labors" => $labors
                ];
                $index++;
            } else {
                continue;
            }
        }

        return response()->json($check);
    }

    public function api_all_labors(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $projectsID = Project::all()
            ->where('assigned_to', '=', $id)
            ->pluck('id');

        $record = [];
        $index = 0;

        foreach ($projectsID as $projectID) {

            $labors = DB::table('labors')
                ->where('project_id', '=', $projectID)->get();

//            dd($labors);

            foreach ($labors as $labor) {
                $record[$index] = [
                    'id' => $labor->id,
                    'name' => $labor->name,
                    'cnic' => $labor->cnic,
                    'phone' => $labor->phone,
                    'address' => $labor->address,
                    'city' => $labor->city,
                    'rate' => $labor->rate,
                    'project_id' => $labor->project_id,
                    'status' => $labor->status_id,
                    'days' => DB::table('labor_attendances')->where('labor_id', '=', $labor->id)
                        ->where('status', '=', 1)->count()
                ];
                $index++;
            }
        }
        return response()->json($record);
    }

    public function api_update_labor_status_dialog()
    {
        $laborStatus = LaborStatus::all();
        return response()->json(['labor_status' => $laborStatus]);

    }

    public function api_update_labor_status(Request $request)
    {
        $labor_name = $request->get("labor_name");

        $labor_id = DB::table('labors')
            ->where('name', '=', $labor_name)
            ->get("id")
            ->first();

        $statusID = DB::table('labor_status')
            ->where('name', '=', $request->get("status"))
            ->pluck('id')
            ->first();


        $labor = Labor::findOrFail($labor_id->id);

        $labor->status_id = $statusID;

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

        $project->status_id = $statusID->id;
        $project->phase_id = $phaseID->id;

        if ($project->save()) {
            return "success";
        } else {
            return "failed";
        }

    }

    public function api_contractor_profile(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->email)
            ->where('role_id', '=', 3)
            ->pluck('id')
            ->first();

        if ($id != null) {
            $user = DB::table('users')
                ->where('id', '=', $id)
                ->first();


            $projects = DB::table('projects')
                ->where('assigned_to', '=', $user->id)
                ->get('*');

//        $labors = DB::table('labors')->where('project_id', '')

            foreach ($projects as $project) {
                $project->labor = DB::table('labors')
                    ->where('project_id', '=', $project->id)
                    ->count();
            }

            return response()->json(['profile' => $user, 'projects' => $projects]);
        } else {
            return "Unauthorized User";
        }


    }

    public function api_project_details(Request $request)
    {
        $title = $request->get("title");

        $project = DB::table('projects')
            ->where('title', '=', $title)
            ->get()
            ->first();

        $customer = DB::table('customers')
            ->where('id', '=', $project->customer_id)
            ->get()
            ->first();

        $statusName = DB::table('project_status')
            ->where('id', '=', $project->status_id)
            ->pluck('name')
            ->first();

        $phaseName = DB::table('project_phase')
            ->where('id', '=', $project->phase_id)
            ->pluck('name')
            ->first();

        if ($project->phase_id == 0) {
            $progress = (($project->phase_id) / 5) * 100;

        } else {
            $progress = (($project->phase_id - 1) / 5) * 100;
        }


        $labor = DB::table('labors')->where('project_id', '=', $project->id)->count();


        return response()->json([
            'project' => $project,
            'customer' => $customer,
            'status_name' => $statusName,
            'phase_name' => $phaseName,
            'progress' => $progress,
            'labor' => $labor
        ]);
    }

    public function api_material_request(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $projects = Project::all()->where('assigned_to', '=', $id);

//        dd($projects);


//        dd($id);
        $titles = [];
        $index = 0;
        foreach ($projects as $project) {
            $titles[$index] = $project->title;
            $index++;
        }

        $items = DB::table('items')->pluck('name');

        return response()->json([
                'projects' => $titles,
                'items' => $items
            ]
        );
    }

    public function api_material_request_store(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $itemID = DB::table('items')
            ->where('name', '=', $request->get('item'))
            ->pluck('id')
            ->first();

        $projectID = DB::table('projects')
            ->where('title', '=', $request->get('project'))
            ->pluck('id')
            ->first();

        $quantity = $request->get('quantity');
        $instructions = $request->get('instructions');

        $material_request = new MaterialRequest([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'project_id' => $projectID,
            'requested_by' => $id,
            'instructions' => $instructions
        ]);

        if ($material_request->save()) {
            return "success";
        } else {
            return "failed";
        }

    }

    public function api_projects_labor_attendance(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();


        $projects = DB::table('projects')
            ->where('assigned_to', '=', $id)
            ->pluck('title');

        return response()->json($projects);


    }

    public function api_get_labor_attendance(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $date = $request->get('date');
//        dd($date);

        $projectID = Project::all()
            ->where('title', '=', $request->get('title'))
            ->where('assigned_to', '=', $id)
            ->pluck('id');

        $labors = DB::table('labors')
            ->where('project_id', '=', $projectID)
            ->pluck('id');

        $result = [];
        $index = 0;

        foreach ($labors as $labor) {

            $result[$index] = [
                'labor' => DB::table('labors')
                    ->where('id', '=', $labor)
                    ->pluck('name')
                    ->first(),
                'attendanceStatus' => DB::table('labor_attendances')
                    ->where('labor_id', '=', $labor)
                    ->where('date', '=', $date)->pluck('status')->first(),
            ];
            $index++;
        }

        return response()->json(['attendance' => $result]);
    }

    public function api_add_labor_attendance(Request $request)
    {
        $response = "";
        $action = "";
        // selected date
        $selected_dd = $request->get('selected_dd');
        $selected_mm = $request->get('selected_mm');
        $selected_yyyy = $request->get('selected_yyyy');

        // current date
        $current_dd = $request->get('current_dd');
        $current_mm = $request->get('current_mm');
        $current_yyyy = $request->get('current_yyyy');

        $labor_attendance = json_decode($request->get('labor_attendance'), true);

        for ($i = 0; $i < count($labor_attendance['attendance']); $i++) {

            $status = $labor_attendance['attendance'][$i]['attendanceStatus'];
            $labor_id = DB::table('labors')
                ->where('name', '=', $labor_attendance['attendance'][$i]['labor'])
                ->pluck('id')->first();

            if (($selected_yyyy < $current_yyyy) ||
                (($selected_yyyy >= $current_yyyy) && ($selected_mm < $current_mm)) ||
                (($selected_yyyy >= $current_yyyy) && ($selected_mm >= $current_mm) && ($selected_dd < $current_dd))) {
                $getLabor = DB::table('labor_attendances')
                    ->where('date', '=', $selected_dd . '-' . $selected_mm . '-' . $selected_yyyy)
                    ->where('labor_id', '=', $labor_id)->get();

                if (count($getLabor) == 0) {
                    $newRecord = new LaborAttendance([
                        'labor_id' => $labor_id,
                        'status' => $status,
                        'date' => $selected_dd . '-' . $selected_mm . '-' . $selected_yyyy,
                    ]);
                    $response = $newRecord->save();
                    $action = "added";

                } else {
                    $response = LaborAttendance::where('id', $getLabor[0]->id)
                        ->update(['status' => $status]);
                    $action = "updated";
                };

            }
            else {

                $found = LaborAttendance::all()
                    ->where('labor_id', '=', $labor_id)
                    ->where('date', '=', $current_dd . '-' . $current_mm . '-' . $current_yyyy);

                if (count($found) == 0) {
                    $attendance = new LaborAttendance([
                        'labor_id' => $labor_id,
                        'status' => $status,
                        'date' => $current_dd . '-' . $current_mm . '-' . $current_yyyy,
                    ]);
                    $response = $attendance->save();
                    $action = "added";

                } else {
                    $response = LaborAttendance::where('labor_id', $labor_id)
                        ->where('date', '=', $current_dd . '-' . $current_mm . '-' . $current_yyyy)
                        ->update(['status' => $status]);
                    $action = "updated";
                }
            }
        }

        if ($response) {
            return "Attendance has been " . $action;
        } else {
            return "Attendance has been " . $action;
        }

    }

}
