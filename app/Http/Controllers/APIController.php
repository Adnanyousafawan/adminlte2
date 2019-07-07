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
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class APIController extends Controller
{

    use AuthenticatesUsers;
    use UploadTrait;


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

        $user = User::where('email', '=', $email)
            ->first();
        $role = User::where('email', '=', $email)
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->pluck('roles.name')
            ->first();

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

        $projects = Project::all()
            ->where('assigned_to', '=', $id)
            ->sortByDesc('created_at');

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
                "status" => DB::table("project_status")->where('id', '=', $project_statusID)->first(),
                "phase" => DB::table('project_phase')->where('id', '=', $project_phaseID)->first(),
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

        $inProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $projects = DB::table('projects')
            ->where('assigned_to', '=', $id)
            ->where('status_id', '=', $inProgress)
            ->get()
            ->all();

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

        $id = Project::all()
            ->where('title', '=', $request->input('project_id'))
            ->sortByDesc('created_at');

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

        $inProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $projects = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('status_id', '=', $inProgress)
            ->sortByDesc('created_at');

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
                $labors = DB::table('labors')
                    ->where('project_id', '=', $project->id)
                    ->count();
                $check[$index] = [
                    "id" => $project->id,
                    "title" => $project->title,
                    "status" => DB::table('project_status')
                        ->where('name', '!=', "Completed")
                        ->where('id', '=', $project->status_id)
                        ->pluck('name')->first(),
                    "labors" => $labors
                ];
                $index++;
            }
        }
        return response()->json($check);
    }

    public function api_stopped_projects(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $inProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $notStarted = DB::table('project_status')
            ->where('name', '=', 'Not Started')
            ->pluck('id')
            ->first();

        $completed = DB::table('project_status')
            ->where('name', '=', 'Completed')
            ->pluck('id')
            ->first();

        $projects = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('status_id', '!=', $inProgress)
            ->where('status_id', '!=', $completed)
            ->where('status_id', '!=', $notStarted)
            ->sortByDesc('created_at');

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
                $labors = DB::table('labors')
                    ->where('project_id', '=', $project->id)
                    ->count();
                $check[$index] = [
                    "id" => $project->id,
                    "title" => $project->title,
                    "status" => DB::table('project_status')
                        ->where('name', '!=', "Completed")
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

        $completed = DB::table('project_status')
            ->where('name', '=', 'Completed')
            ->pluck('id')
            ->first();

        $projects = Project::all()->where('assigned_to', '=', $id)
            ->where('status_id', '=', $completed)
            ->sortByDesc('created_at');

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
            ->sortByDesc('created_at')
            ->pluck('id');

        $record = [];
        $index = 0;

        foreach ($projectsID as $projectID) {
            $labors = DB::table('labors')
                ->where('project_id', '=', $projectID)
                ->get();

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
                    'status_id' => $labor->status_id,
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
        $floor = Project::all()->pluck('floor');

        return response()->json(['phases' => $phase, 'status' => $status]);
    }

    public function api_projects_longpress_dialog_update(Request $request)
    {
        $status = $request->get("status");
//        $phase = $request->get("phase");
        $project_title = $request->get("project_title");

        $statusID = DB::table('project_status')->where('name', '=', $status)->get('id')->first();
//        $phaseID = DB::table('project_phase')->where('name', '=', $phase)->get('id')->first();

        $projectID = DB::table('projects')
            ->where('title', '=', $project_title)
            ->get('id')
            ->first();

        $project = Project::find($projectID->id);

        $project->status_id = $statusID->id;
//        $project->phase_id = $phaseID->id;

        if ($project->save()) {
            return "success";
        } else {
            return "failed";
        }

    }

    public function api_contractor_profile(Request $request)
    {
        $roleContractor = DB::table('roles')
            ->where('name', '=', 'Contractor')
            ->pluck('id')
            ->first();

        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->where('role_id', '=', $roleContractor)
            ->pluck('id')
            ->first();

        if ($id != null) {
            $user = DB::table('users')
                ->where('id', '=', $id)
                ->first();

            $projects = DB::table('projects')
                ->where('assigned_to', '=', $user->id)
                ->get('*');

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
            $progress = (($project->phase_id) / 6) * 100;

        } else {
            $progress = (($project->phase_id - 1) / 6) * 100;
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

        $inProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $projects = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('status_id', '=', $inProgress)
            ->sortByDesc('created_at');

        $titles = [];
        $index = 0;
        foreach ($projects as $project) {
            $titles[$index] = $project->title;
            $index++;
        }

        $items = DB::table('items')
            ->get(['name', 'unit']);

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
        $pending = DB::table('material_request_statuses')
            ->where('name', '=', 'Pending')
            ->pluck('id')
            ->first();

        $material_request = new MaterialRequest([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'project_id' => $projectID,
            'requested_by' => $id,
            'seen' => 0,
            'request_status_id' => $pending,
            'instructions' => $instructions
        ]);

//        dd($material_request);

        if ($material_request->save()) {
            return "success" . $material_request->id;
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

        $inProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $projects = DB::table('projects')
            ->where('assigned_to', '=', $id)
            ->where('status_id', '=', $inProgress)
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

        $inProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $projectID = Project::all()
            ->where('title', '=', $request->get('title'))
            ->where('assigned_to', '=', $id)
            ->where('status_id', '=', $inProgress)
            ->pluck('id');

        $active = DB::table('labor_status')
            ->where('name', '=', "Active")
            ->pluck('id')->first();

        $labors = DB::table('labors')
            ->where('project_id', '=', $projectID)
            ->where('status_id', '=', $active)
            ->pluck('id');

        $result = [];
        $index = 0;

        foreach ($labors as $labor) {

            $currentStatus = DB::table('labor_attendances')
                ->where('labor_id', '=', $labor)
                ->where('date', '=', $date)
                ->pluck('status')
                ->first();

            $currentPaid = DB::table('labor_attendances')
                ->where('labor_id', '=', $labor)
                ->where('date', '=', $date)
                ->pluck('paid')
                ->first();

//            print "current before: " . $currentStatus;

            if ($currentPaid == 0 && !is_null($currentPaid)) {
                $currentPaid = 0;
            } else if (is_null($currentPaid) || $currentPaid == 1) {
                $currentPaid = 1;
            }

            if ($currentStatus == 0 && !is_null($currentStatus)) {
                $currentStatus = 0;
            } else if (is_null($currentStatus) || $currentStatus == 1) {
                $currentStatus = 1;
            }

            $result[$index] = [
                'labor' => DB::table('labors')
                    ->where('id', '=', $labor)
                    ->pluck('name')
                    ->first(),
                'attendanceStatus' => $currentStatus,
                'attendancePaid' => $currentPaid,
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
            $paid = $labor_attendance['attendance'][$i]['attendancePaid'];
            $labor_id = DB::table('labors')
                ->where('name', '=', $labor_attendance['attendance'][$i]['labor'])
                ->pluck('id')
                ->first();

//            dd($paid);

            if (($selected_yyyy < $current_yyyy) ||
                (($selected_yyyy >= $current_yyyy) && ($selected_mm < $current_mm)) ||
                (($selected_yyyy >= $current_yyyy) && ($selected_mm >= $current_mm) && ($selected_dd < $current_dd))) {
                $getLabor = DB::table('labor_attendances')
                    ->where('date', '=', $selected_dd . '-' . $selected_mm . '-' . $selected_yyyy)
                    ->where('labor_id', '=', $labor_id)
                    ->get();

                if (count($getLabor) == 0) {
                    $newRecord = new LaborAttendance([
                        'labor_id' => $labor_id,
                        'status' => $status,
                        'paid' => $paid,
                        'date' => $selected_dd . '-' . $selected_mm . '-' . $selected_yyyy,
                    ]);

//                    dd($newRecord);
                    $response = $newRecord->save();
                    $action = "added";

                } else {

                    $response = LaborAttendance::where('id', $getLabor[0]->id)
                        ->update(['status' => $status]);
                    LaborAttendance::where('id', $getLabor[0]->id)
                        ->update(['paid' => $paid]);
                    $action = "updated";
                };

            } else {

                $found = LaborAttendance::all()
                    ->where('labor_id', '=', $labor_id)
                    ->where('date', '=', $current_dd . '-' . $current_mm . '-' . $current_yyyy);

                if (count($found) == 0) {
                    $attendance = new LaborAttendance([
                        'labor_id' => $labor_id,
                        'status' => $status,
                        'paid' => $paid,
                        'date' => $current_dd . '-' . $current_mm . '-' . $current_yyyy,
                    ]);

//                    dd($attendance);
                    $response = $attendance->save();
                    $action = "added";
                } else {
                    $response = LaborAttendance::where('labor_id', $labor_id)
                        ->where('date', '=', $current_dd . '-' . $current_mm . '-' . $current_yyyy)
                        ->update(['status' => $status]);

                    LaborAttendance::where('labor_id', $labor_id)
                        ->where('date', '=', $current_dd . '-' . $current_mm . '-' . $current_yyyy)
                        ->update(['paid' => $paid]);

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

    public function api_assigned_projects(Request $request)
    {
        $contractorID = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $notStarted = DB::table('project_status')
            ->where('name', '=', 'Not Started')
            ->pluck('id')
            ->first();

        $assignedProjects = DB::table('projects')
            ->where('status_id', '=', $notStarted)
            ->where('assigned_to', '=', $contractorID)
            ->get();


        foreach ($assignedProjects as $assignedProject) {
            $assignedProject->manager = DB::table('users')
                ->where('id', '=', $assignedProject->assigned_by)
                ->pluck('name')
                ->first();
        }

        return response()->json($assignedProjects);

    }

    public function api_active_labors(Request $request)
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

        $active = DB::table('labor_status')
            ->where('name', '=', 'Active')
            ->pluck('id')
            ->first();

        foreach ($projectsID as $projectID) {
            $labors = DB::table('labors')
                ->where('project_id', '=', $projectID)
                ->where('status_id', '=', $active)
                ->get();

            foreach ($labors as $labor) {
                $record[$index] = [
                    'id' => $labor->id,
                    'name' => $labor->name,
                    'cnic' => $labor->cnic,
                    'phone' => $labor->phone,
                    'address' => $labor->address,
                    'city' => $labor->city,
                    'rate' => $labor->rate,
                    'project_title' => DB::table('projects')
                        ->where('id', '=', $labor->project_id)
                        ->pluck('title')
                        ->first(),
                    'status_id' => $labor->status_id,
                    'days' => DB::table('labor_attendances')->where('labor_id', '=', $labor->id)
                        ->where('status', '=', 1)->count()
                ];
                $index++;
            }
        }
        return response()->json($record);
    }

    public function api_not_active_labors(Request $request)
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

        $active = DB::table('labor_status')
            ->where('name', '=', 'Not Active')
            ->pluck('id')
            ->first();

        foreach ($projectsID as $projectID) {
            $labors = DB::table('labors')
                ->where('project_id', '=', $projectID)
                ->where('status_id', '=', $active)
                ->get();

            foreach ($labors as $labor) {
                $record[$index] = [
                    'id' => $labor->id,
                    'name' => $labor->name,
                    'cnic' => $labor->cnic,
                    'phone' => $labor->phone,
                    'address' => $labor->address,
                    'city' => $labor->city,
                    'rate' => $labor->rate,
                    'project_title' => DB::table('projects')
                        ->where('id', '=', $labor->project_id)
                        ->pluck('title')
                        ->first(),
                    'status_id' => $labor->status_id,
                    'days' => DB::table('labor_attendances')->where('labor_id', '=', $labor->id)
                        ->where('status', '=', 1)->count()
                ];
                $index++;
            }
        }
        return response()->json($record);
    }

    public function api_suspended_labors(Request $request)
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

        $active = DB::table('labor_status')
            ->where('name', '=', 'Suspended')
            ->pluck('id')
            ->first();

        foreach ($projectsID as $projectID) {
            $labors = DB::table('labors')
                ->where('project_id', '=', $projectID)
                ->where('status_id', '=', $active)
                ->get();

            foreach ($labors as $labor) {
                $record[$index] = [
                    'id' => $labor->id,
                    'name' => $labor->name,
                    'cnic' => $labor->cnic,
                    'phone' => $labor->phone,
                    'address' => $labor->address,
                    'city' => $labor->city,
                    'rate' => $labor->rate,
                    'project_title' => DB::table('projects')
                        ->where('id', '=', $labor->project_id)
                        ->pluck('title')
                        ->first(),
                    'status_id' => $labor->status_id,
                    'days' => DB::table('labor_attendances')->where('labor_id', '=', $labor->id)
                        ->where('status', '=', 1)->count()
                ];
                $index++;
            }
        }
        return response()->json($record);
    }

    public function api_accept_project(Request $request)
    {

        $statusInProgress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $response = DB::table('projects')
            ->where('title', '=', $request->get('title'))
            ->update(['status_id' => $statusInProgress]);

        if ($response > 0)
            return "success";
        else
            return "failure";
    }

    public function api_all_labors_on_project(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $title = $request->get('title');

        $projectID = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('title', '=', $title)
            ->pluck('id')
            ->first();

        $record = [];
        $index = 0;

        $labors = DB::table('labors')
            ->where('project_id', '=', $projectID)
            ->get();

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
                'status_id' => $labor->status_id,
                'days' => DB::table('labor_attendances')
                    ->where('labor_id', '=', $labor->id)
                    ->where('status', '=', 1)
                    ->count()
            ];
            $index++;
        }
        return response()->json($record);
    }

    public function api_active_labors_on_project(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $title = $request->get('title');

        $projectID = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('title', '=', $title)
            ->pluck('id')
            ->first();

        $record = [];
        $index = 0;

        $active = DB::table('labor_status')
            ->where('name', '=', 'Active')
            ->pluck('id')
            ->first();

        $labors = DB::table('labors')
            ->where('project_id', '=', $projectID)
            ->where('status_id', '=', $active)
            ->get();

        foreach ($labors as $labor) {
            $record[$index] = [
                'id' => $labor->id,
                'name' => $labor->name,
                'cnic' => $labor->cnic,
                'phone' => $labor->phone,
                'address' => $labor->address,
                'city' => $labor->city,
                'rate' => $labor->rate,
                'project_title' => DB::table('projects')
                    ->where('id', '=', $labor->project_id)
                    ->pluck('title')
                    ->first(),
                'status_id' => $labor->status_id,
                'days' => DB::table('labor_attendances')
                    ->where('labor_id', '=', $labor->id)
                    ->where('status', '=', 1)
                    ->count()
            ];
            $index++;
        }
        return response()->json($record);
    }

    public function api_not_active_labors_on_project(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $title = $request->get('title');

        $projectID = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('title', '=', $title)
            ->pluck('id')
            ->first();

        $record = [];
        $index = 0;

        $notActive = DB::table('labor_status')
            ->where('name', '=', 'Not Active')
            ->pluck('id')
            ->first();

        $labors = DB::table('labors')
            ->where('project_id', '=', $projectID)
            ->where('status_id', '=', $notActive)
            ->get();

        foreach ($labors as $labor) {
            $record[$index] = [
                'id' => $labor->id,
                'name' => $labor->name,
                'cnic' => $labor->cnic,
                'phone' => $labor->phone,
                'address' => $labor->address,
                'city' => $labor->city,
                'rate' => $labor->rate,
                'project_title' => DB::table('projects')
                    ->where('id', '=', $labor->project_id)
                    ->pluck('title')
                    ->first(),
                'status_id' => $labor->status_id,
                'days' => DB::table('labor_attendances')
                    ->where('labor_id', '=', $labor->id)
                    ->where('status', '=', 1)
                    ->count()
            ];
            $index++;
        }
        return response()->json($record);
    }

    public function api_suspended_labors_on_project(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $title = $request->get('title');

        $projectID = Project::all()
            ->where('assigned_to', '=', $id)
            ->where('title', '=', $title)
            ->pluck('id')
            ->first();

        $record = [];
        $index = 0;

        $suspended = DB::table('labor_status')
            ->where('name', '=', 'Suspended')
            ->pluck('id')
            ->first();

        $labors = DB::table('labors')
            ->where('project_id', '=', $projectID)
            ->where('status_id', '=', $suspended)
            ->get();

        foreach ($labors as $labor) {
            $record[$index] = [
                'id' => $labor->id,
                'name' => $labor->name,
                'cnic' => $labor->cnic,
                'phone' => $labor->phone,
                'address' => $labor->address,
                'city' => $labor->city,
                'rate' => $labor->rate,
                'project_title' => DB::table('projects')
                    ->where('id', '=', $labor->project_id)
                    ->pluck('title')
                    ->first(),
                'status_id' => $labor->status_id,
                'days' => DB::table('labor_attendances')
                    ->where('labor_id', '=', $labor->id)
                    ->where('status', '=', 1)
                    ->count()
            ];
            $index++;
        }
        return response()->json($record);
    }

    public function api_change_password(Request $request)
    {
        $user = User::all()
            ->where('email', '=', $request->get('email'))
            ->first();

        $oldPassword = $request->get('oldPassword');
        $newPassword = $request->get('newPassword');

        if (Hash::check($oldPassword, $user->password)) {

            if ($oldPassword == $newPassword) {
                return "New password can not be same as old password";
            }

            $user->password = Hash::make($newPassword);

            if ($user->save()) {
                return "Password has been changed successfully";
            } else {
                return "Password has not been changed";
            }
        } else {
            return "Old password does not matched";
        }
    }

    public function api_change_picture(Request $request)
    {
        $email = $request->get('email');

        $img_str = $request->get('image');
        $base64_image = base64_decode($img_str);
        $imageName = '/images/profile/' . $request->get('name') . '.png';

        $path = '/public' . $imageName;

        $previousImage = '/public' . DB::table('users')
                ->where('email', '=', $email)
                ->pluck('profile_image')
                ->first();

        Storage::disk('local')->put($path, $base64_image);

        DB::table('users')
            ->where('email', '=', $email)
            ->update(['profile_image' => $imageName]);

        if (Storage::disk('local')->delete($previousImage)) {
            return "Your profile picture is successfully updated.";
        } else {
            return "Encountered problem while updating profile picture";
        }
    }

    public function api_all_material_requests(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $requests = [];
        $innerIndex = 0;

        $allRequests = MaterialRequest::all()
            ->where('requested_by', '=', $id)
            ->sortByDesc('created_at');


        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        foreach ($allRequests as $singleRequest) {

            $project_status = DB::table('projects')
                ->where('id', '=', $singleRequest->project_id)
                ->pluck('status_id')
                ->first();

            if ($project_status == $in_progress) {
                $requests[$innerIndex] = [
                    "request_id" => $singleRequest->id,
                    "item_instructions" => $singleRequest->instructions,
                    "item_quantity" => $singleRequest->quantity,
                    "item_name" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('name')
                        ->first(),
                    "item_unit" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('unit')
                        ->first(),
                    "item_status" => DB::table('material_request_statuses')
                        ->where('id', '=', $singleRequest->request_status_id)
                        ->pluck('name')
                        ->first(),
                    "project_title" => DB::table('projects')
                        ->where('id', '=', $singleRequest->project_id)
                        ->pluck('title')
                        ->first(),
                    "request_date" => $singleRequest->created_at,
                ];
                $innerIndex++;
            }
        }
        return response()->json($requests);
    }

    public function api_approved_material_requests(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $requests = [];
        $innerIndex = 0;

        $approved = DB::table('material_request_statuses')->where('name', '=', 'Approved')
            ->pluck('id')->first();

        $allRequests = MaterialRequest::all()
            ->where('request_status_id', '=', $approved)
            ->where('requested_by', '=', $id)
            ->sortByDesc('created_at');

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        foreach ($allRequests as $singleRequest) {

            $project_status = DB::table('projects')
                ->where('id', '=', $singleRequest->project_id)
                ->pluck('status_id')
                ->first();

            if ($project_status == $in_progress) {
                $requests[$innerIndex] = [
                    "request_id" => $singleRequest->id,
                    "item_instructions" => $singleRequest->instructions,
                    "item_quantity" => $singleRequest->quantity,
                    "item_name" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('name')
                        ->first(),
                    "item_unit" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('unit')
                        ->first(),
                    "item_status" => DB::table('material_request_statuses')
                        ->where('id', '=', $singleRequest->request_status_id)
                        ->pluck('name')
                        ->first(),
                    "project_title" => DB::table('projects')
                        ->where('id', '=', $singleRequest->project_id)
                        ->pluck('title')
                        ->first(),
                    "request_date" => $singleRequest->created_at,
                ];
                $innerIndex++;
            }
        }
        return response()->json($requests);
    }

    public function api_rejected_material_requests(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $requests = [];
        $innerIndex = 0;

        $rejected = DB::table('material_request_statuses')
            ->where('name', '=', 'Rejected')
            ->pluck('id')->first();

        $allRequests = MaterialRequest::all()
            ->where('request_status_id', '=', $rejected)
            ->where('requested_by', '=', $id)
            ->sortByDesc('created_at');

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();


        foreach ($allRequests as $singleRequest) {

            $project_status = DB::table('projects')
                ->where('id', '=', $singleRequest->project_id)
                ->pluck('status_id')
                ->first();

            if ($project_status == $in_progress) {
                $requests[$innerIndex] = [
                    "request_id" => $singleRequest->id,
                    "item_instructions" => $singleRequest->instructions,
                    "item_quantity" => $singleRequest->quantity,
                    "item_name" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('name')
                        ->first(),
                    "item_unit" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('unit')
                        ->first(),
                    "item_status" => DB::table('material_request_statuses')
                        ->where('id', '=', $singleRequest->request_status_id)
                        ->pluck('name')
                        ->first(),
                    "project_title" => DB::table('projects')
                        ->where('id', '=', $singleRequest->project_id)
                        ->pluck('title')
                        ->first(),
                    "request_date" => $singleRequest->created_at,
                ];
                $innerIndex++;
            }
        }
        return response()->json($requests);
    }

    public function api_pending_material_requests(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $requests = [];
        $innerIndex = 0;

        $pending = DB::table('material_request_statuses')
            ->where('name', '=', 'Pending')
            ->pluck('id')->first();

        $allRequests = MaterialRequest::all()
            ->where('request_status_id', '=', $pending)
            ->where('requested_by', '=', $id)
            ->sortByDesc('created_at');

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();


        foreach ($allRequests as $singleRequest) {
            $project_status = DB::table('projects')
                ->where('id', '=', $singleRequest->project_id)
                ->pluck('status_id')
                ->first();

            if ($project_status == $in_progress) {
                $requests[$innerIndex] = [
                    "request_id" => $singleRequest->id,
                    "item_instructions" => $singleRequest->instructions,
                    "item_quantity" => $singleRequest->quantity,
                    "item_name" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('name')
                        ->first(),
                    "item_unit" => DB::table('items')
                        ->where('id', '=', $singleRequest->item_id)
                        ->pluck('unit')
                        ->first(),
                    "item_status" => DB::table('material_request_statuses')
                        ->where('id', '=', $singleRequest->request_status_id)
                        ->pluck('name')
                        ->first(),
                    "project_title" => DB::table('projects')
                        ->where('id', '=', $singleRequest->project_id)
                        ->pluck('title')
                        ->first(),
                    "request_date" => $singleRequest->created_at,
                ];
                $innerIndex++;
            }
        }
        return response()->json($requests);
    }

    public function api_password_forgot(Request $request)
    {

        $contractor = DB::table('roles')
            ->where('name', '=', 'Contractor')
            ->pluck('id')
            ->first();

        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->where('role_id', '=', $contractor)
            ->count();

        if ($id < 1) {
            return "User with this email is not found.";
        } else {
            return "A mail with reset password link has been sent to your email address.";
        }
    }

    public function api_update_project_phase(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')->first();

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $projects = DB::table('projects')
            ->where('assigned_to', '=', $id)
            ->where('status_id', '=', $in_progress)
//            ->orderByDesc('created_at')
            ->get();

        $response = [];
        $index = 0;

        foreach ($projects as $project) {
            $response[$index] = [
                'title' => $project->title,
                'floors' => $project->floor,
                'phase' => DB::table('project_phase')->where('id', '=', $project->phase_id)->pluck('name')->first(),
                'status' => DB::table('project_status')->where('id', '=', $project->status_id)->pluck('name')->first()

            ];
            $index++;
        }

        $phases = ProjectPhase::all()->pluck('name');
        $statuses = ProjectStatus::all()->pluck('name');

        return response()->json(['projects' => $response, 'phases' => $phases, 'statuses' => $statuses]);

    }

    public function api_orders_all(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $orders = DB::table('order_details')
            ->distinct()
            ->pluck('invoice_number');

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $response = [];
        $index = 0;

        for ($i = 0; $i < $orders->count(); $i++) {
            $record = DB::table('order_details')
                ->where('invoice_number', '=', $orders[$i])
                ->select('project_id', 'created_at', 'supplier_id', 'status')
                ->first();

            $project_title = DB::table('projects')
                ->where('id', '=', $record->project_id)
                ->where('status_id', '=', $in_progress)
                ->where('assigned_to', '=', $id)
                ->pluck('title')
                ->first();

            if ($project_title != null) {
                $response[$index] = [
                    'invoice_number' => $orders[$i],
                    'project_title' => $project_title,
                    'supplier_name' => DB::table('suppliers')
                        ->where('id', '=', $record->supplier_id)
                        ->pluck('name')
                        ->first(),
                    'status' => $record->status,
                    'order_date' => $record->created_at
                ];
                $index++;
            }
        }
        return response()->json([
            'orders' => $response
        ]);
    }

    public function api_orders_received(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $orders = DB::table('order_details')
            ->distinct()
            ->pluck('invoice_number');

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $response = [];
        $index = 0;

        for ($i = 0; $i < $orders->count(); $i++) {

            $record = DB::table('order_details')
                ->where('invoice_number', '=', $orders[$i])
                ->where('status', '=', 'Received')
                ->select('project_id', 'created_at', 'supplier_id', 'status')
                ->first();

            if ($record != null) {
                $project_title = DB::table('projects')
                    ->where('id', '=', $record->project_id)
                    ->where('status_id', '=', $in_progress)
                    ->where('assigned_to', '=', $id)
                    ->pluck('title')
                    ->first();

                if ($project_title != null) {
                    $response[$index] = [
                        'invoice_number' => $orders[$i],
                        'project_title' => $project_title,
                        'supplier_name' => DB::table('suppliers')
                            ->where('id', '=', $record->supplier_id)
                            ->pluck('name')
                            ->first(),
                        'status' => $record->status,
                        'order_date' => $record->created_at
                    ];
                    $index++;
                }
            }
        }
        return response()->json([
            'orders' => $response
        ]);

    }

    public function api_orders_pending(Request $request)
    {
        $id = DB::table('users')
            ->where('email', '=', $request->get('email'))
            ->pluck('id')
            ->first();

        $orders = DB::table('order_details')
            ->distinct()
            ->pluck('invoice_number');

        $in_progress = DB::table('project_status')
            ->where('name', '=', 'In Progress')
            ->pluck('id')
            ->first();

        $response = [];
        $index = 0;

        for ($i = 0; $i < $orders->count(); $i++) {

            $record = DB::table('order_details')
                ->where('invoice_number', '=', $orders[$i])
                ->where('status', '=', 'Pending')
                ->select('project_id', 'created_at', 'supplier_id', 'status')
                ->first();

            if ($record != null) {
                $project_title = DB::table('projects')
                    ->where('id', '=', $record->project_id)
                    ->where('status_id', '=', $in_progress)
                    ->where('assigned_to', '=', $id)
                    ->pluck('title')
                    ->first();

                if ($project_title != null) {
                    $response[$index] = [
                        'invoice_number' => $orders[$i],
                        'project_title' => $project_title,
                        'supplier_name' => DB::table('suppliers')
                            ->where('id', '=', $record->supplier_id)
                            ->pluck('name')
                            ->first(),
                        'status' => $record->status,
                        'order_date' => $record->created_at
                    ];
                    $index++;
                }
            }
        }
        return response()->json([
            'orders' => $response
        ]);

    }

    public function api_orders_details(Request $request)
    {

        $invoice_number = $request->get('invoice_number');

        $items = DB::table('order_details')
            ->where('invoice_number', '=', $invoice_number)
            ->get();

        return response()->json($items);

    }

}