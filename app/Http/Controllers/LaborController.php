<?php

namespace App\Http\Controllers;

use App\labor;
use Illuminate\Http\Request;
use DB;
use Gate;
use Auth;

class LaborController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isManager')) {
            // ____________________________ADD query to show just record of specific manager projects labors____________
            $project_status_ID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $stopped_status_ID = DB::table('project_status')->where('name','=','Stopped')->pluck('id')->first();
            $not_started_status_ID = DB::table('project_status')->where('name','=','Not Started')->pluck('id')->first();
            $labor_by_projects = DB::table('projects')->where('assigned_by','=',Auth::user()->id)->get();

             /*
             $labor_by_projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('labors','labors.project_id','=','projects.id')
            ->where('projects.assigned_by','=',Auth::user()->id)
            ->select('labors.id','projects.id','projects.title','labors.rate','users.name as contractor_name')
            ->paginate(5);
            */
           /*
            $labors = DB::table('labors')
            ->leftjoin('projects','projects.id','=','labors.project_id')
            ->where('projects.assigned_by','=',Auth::user()->id)
            ->select('labors.id','labors.name','labors.project_id','labors.rate')
            ->get();
            */

            $labors = DB::table('labors')
                ->leftjoin('projects','projects.id','=','labors.project_id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->select('labors.name','labors.id','labors.rate','labors.address','labors.phone','projects.id as project_id')
                ->get()
                ->all();
            $totallabor = DB::table('labors')->count();
            $projects = DB::table('projects')->where('assigned_by', '=', Auth::user()->id)->where('status_id','!=',$project_status_ID)->where('status_id','!=',$stopped_status_ID)->where('status_id','!=',$not_started_status_ID)->get();
            return view('labors/index', compact('labors', 'totallabors', 'projects', 'labor_by_projects'));

        }
        if (Gate::allows('isAdmin')) 
        {
            $project_status_ID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $stopped_status_ID = DB::table('project_status')->where('name','=','Stopped')->pluck('id')->first();
            $not_started_status_ID = DB::table('project_status')->where('name','=','Not Started')->pluck('id')->first();
            $labor_by_projects = DB::table('projects')->get();
            /*
            $labor_by_projects = DB::table('projects')
            ->leftjoin('users','projects.assigned_to','=','users.id')
            ->leftjoin('labors','labors.project_id','=','projects.id')
            ->select('labors.id','projects.id','projects.title','labors.rate','users.name as contractor_name')
            ->paginate(5);
            */
            //$labors = DB::table('labors')->get();
            $totallabor = DB::table('labors')->count();
             $labors = DB::table('labors')
                ->leftjoin('projects','projects.id','=','labors.project_id')
                ->select('labors.name','labors.id','labors.rate','labors.address','labors.phone','projects.id as project_id')
                ->get()
                ->all();
            $projects = DB::table('projects')->where('status_id','!=',$project_status_ID)->where('status_id','!=',$stopped_status_ID)->where('status_id','!=',$not_started_status_ID)->get();
            return view('labors/index', compact('labors', 'totallabors', 'projects','labor_by_projects'));
        }
             

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if(Gate::allows('isManager'))
        {
            $project_status_ID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $stopped_status_ID = DB::table('project_status')->where('name','=','Stopped')->pluck('id')->first();
            $not_started_status_ID = DB::table('project_status')->where('name','=','Not Started')->pluck('id')->first();

            $projects = DB::table('projects')->where('assigned_by','=', Auth::user())->where('status_id','!=',$project_status_ID)
            ->where('status_id','!=',$stopped_status_ID)
            ->where('status_id','!=',$not_started_status_ID)
            ->get();

        }
        if(Gate::allows('isAdmin'))
        {
            $project_status_ID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $stopped_status_ID = DB::table('project_status')->where('name','=','Stopped')->pluck('id')->first();
            $not_started_status_ID = DB::table('project_status')->where('name','=','Not Started')->pluck('id')->first();

            $projects = DB::table('projects')->where('status_id','!=',$project_status_ID)->where('status_id','!=',$stopped_status_ID)->where('status_id','!=',$not_started_status_ID)->get();
        }
        return view('labors/add_labor',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $labor_status = DB::table('labor_status')->count('id');
        if($labor_status == 0)
        {
            return redirect()->back()->with('message',"Contact Your Admin. Please Add Labor Status first");
        }
        $request->validate([$request,
            'name' => 'required',
            'rate' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'cnic' => 'required',
            'project_id' => 'required',
        ]);
        $projID = DB::table('projects')
            ->where('title', '=', $request->input('project_id'))
            ->pluck('id')
            ->first();

        $labors = new Labor([
            'name' => $request->get('name'),
            'rate' => $request->get('rate'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'phone' => $request->get('phone'),
            'cnic' => $request->get('cnic'),
            'project_id' => $projID,
        ]);
        $labors->save();

        return redirect()->back()->with('success', 'New Labor has been Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\labor $labor
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        $labors = DB::table('labors')->get();
        return view('labors/index', compact('labors'));
        // $labors = Labor::paginate(10);
        //return view('labors.index',compact('labors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\labor $labor
     * @return \Illuminate\Http\Response
     */
    public function search_labor(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_name');
        $search_phone = $request->get('search_phone');
        if (!is_null($search)) {
            $labors = DB::table('labors')->where('name', 'like', '%' . $search . '%')->paginate(20);
            return view('labors/index', ['labors' => $labors]);
        }
        if (!is_null($search_phone)) {
            $labors = DB::table('labors')->where('phone', 'like', '%' . $search_phone . '%')->paginate(20);
            return view('labors/index', ['labors' => $labors]);
        } else {
            $labors = Labor::paginate(20);
            return view('labors/index', ['labors' => $labors]);

        }

    }

    public function edit($id)
    {
        $labors = Labor::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($labors == null || count($labors) == 0) {
            return redirect()->intended('labors/index');
        }
        //$users = User::paginate(10);
        return view('labors/edit', ['labors' => $labors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\labor $labor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'cnic' => 'required',
            'phone' => 'required',
            'rate' => 'required',
            // 'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);
        $labors = Labor::find($id);
        $labors->name = $request->input('name');
        $labors->address = $request->input('address');
        $labors->city = $request->input('city');
        $labors->cnic = $request->input('cnic');
        $labors->phone = $request->input('phone');
        $labors->rate = $request->input('rate');

        if ($labors->save()) {
            return redirect()->back()->with('success', 'Data Updated');
        } else {
            return redirect()->back()->with('error', 'Labor Record is not Updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\labor $labor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //return redirect()->intended('labors/index');

        $labor_attendances = DB::table('labor_attendances')->where('labor_id', '=', $id)->count();
        //$orders = DB::table('order_details')->where('project_id','=',$id)->count();
        if ($labor_attendances <= 0) {
            Labor::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Labor has been deleted');
        } else {
            if (Gate::allows('isAdmin')) {
                return redirect()->back()->with('message', ' Labor Attendance Exists. Please delete Labor Attendance from project first');
            }
            if (Gate::allows('isManager')) {
                return redirect()->back()->with('message', ' Labor Attendance Exists. Please Contact Admin to Delete Attendance from project first');
            }

        }
    }


}
