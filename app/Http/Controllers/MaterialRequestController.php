<?php

namespace App\Http\Controllers;

use App\MaterialRequest;
use Illuminate\Http\Request;
use DB;
use Validator;
use Gate;
use Auth;

class MaterialRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
         
        if(Gate::allows('isManager'))
        {
            $seens = DB::table('material_requests')->pluck('id')->all();
            $request_status_pending = DB::table('material_request_statuses')->where('name','=','Pending')->pluck('id')->first();
            foreach ($seens as $seen) 
            {
                $seentstatus = MaterialRequest::find($seen);
                $seentstatus->seen = '1';
                if($seentstatus->request_status_id == NULL)
                {
                    $seentstatus->request_status_id = $request_status_pending;
                }
                $seentstatus->save();
            }
              $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('projects.assigned_by','=',Auth::user()->id)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
        }

if(Gate::allows('isAdmin'))
{
        $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
}
        return view('materialrequest/index', compact('materialrequests'));
    }

    public function tester($id)
    {
        dd('in tester controller');

    }

    public function approved()
    {
        if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
         if(Gate::allows('isManager'))
        {
            $seens = DB::table('material_requests')->pluck('id')->all();
            $request_status_pending = DB::table('material_request_statuses')->where('name','=','Pending')->pluck('id')->first();
            foreach ($seens as $seen) 
            {
                $seentstatus = MaterialRequest::find($seen);
                $seentstatus->seen = '1';
                if($seentstatus->request_status_id == NULL)
                {
                    $seentstatus->request_status_id = $request_status_pending;
                }
                $seentstatus->save();
            }
             $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('projects.assigned_by','=',Auth::user()->id)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
        }
        if(Gate::allows('isAdmin'))
        {

        $request_status = DB::table('material_request_statuses')->where('name','=','approved')->pluck('id')->first();

        $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('request_status_id','=',$request_status)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
          }
       // dd($materialrequests);

        //$materialrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)->get()->all();
        return view('materialrequest/index', compact('materialrequests')); 
    }
     public function rejected()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
         if(Gate::allows('isManager'))
        {
            $seens = DB::table('material_requests')->pluck('id')->all();
            $request_status_pending = DB::table('material_request_statuses')->where('name','=','Pending')->pluck('id')->first();
            foreach ($seens as $seen) 
            {
                $seentstatus = MaterialRequest::find($seen);
                $seentstatus->seen = '1';
                if($seentstatus->request_status_id == NULL)
                {
                    $seentstatus->request_status_id = $request_status_pending;
                }
                $seentstatus->save();
            }
             $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('projects.assigned_by','=',Auth::user()->id)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
        }
      
         if(Gate::allows('isAdmin'))
        {

        $request_status = DB::table('material_request_statuses')->where('name','=','approved')->pluck('id')->first();

        $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('request_status_id','=',$request_status)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
          }
        return view('materialrequest/index', compact('materialrequests'));
    }
     public function pending()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        if(Gate::allows('isManager'))
        {
            $seens = DB::table('material_requests')->pluck('id')->all();
            $request_status_pending = DB::table('material_request_statuses')->where('name','=','Pending')->pluck('id')->first();
            foreach ($seens as $seen) 
            {
                $seentstatus = MaterialRequest::find($seen);
                $seentstatus->seen = '1';
                if($seentstatus->request_status_id == NULL)
                {
                    $seentstatus->request_status_id = $request_status_pending;
                }
                $seentstatus->save();
            }
        $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('projects.assigned_by','=',Auth::user()->id)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
        }

         if(Gate::allows('isAdmin'))
        {

        $request_status = DB::table('material_request_statuses')->where('name','=','approved')->pluck('id')->first();

        $materialrequests = DB::table('material_requests')
        ->leftjoin('items','items.id','=','material_requests.item_id')
        ->leftjoin('material_request_statuses','material_request_statuses.id','=','material_requests.request_status_id')
        ->leftjoin('projects','projects.id','=','material_requests.project_id')
        ->leftjoin('users','users.id','=','material_requests.requested_by')
        ->where('request_status_id','=',$request_status)
        ->select('material_requests.id','material_request_statuses.name as status_name','material_request_statuses.id as request_status_id','material_requests.quantity','material_requests.seen' ,'material_requests.instructions','projects.title','items.name as item_name','users.name as contractor_name')->get();
          }
         return view('materialrequest/index', compact('materialrequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

public function insert(Request $request)
{
    //

    //return redirect()->with('message',"phnch gaya");
}
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialRequest $materialRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $materialrequest = MaterialRequest::find($id);
        
            $materialrequest->request_status_id = $request->get('optradio');
            if($materialrequest->save())
            {
                return redirect()->back()->with('success',"Material Request Status Updated");
            }
            else
            {
                return redirect()->back()->with('message',"Material Request Status is not Updated");
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       /* if(MaterialRequest::where('id', $id)->delete())
        {
            return redirect()->back()->with('success','Record Successfully Deleted.');
        }
        else
        {
            return redirect()->back()->with('message','Record is not Deleted.');

        }
        */
        
    }


}
