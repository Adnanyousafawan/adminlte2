<?php

namespace App\Http\Controllers;

use App\MaterialRequest;
use Illuminate\Http\Request;
use DB;
use Validator;
use Gate;

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
        }
        $materialrequests = DB::table('material_requests')->get()->all();
        return view('materialrequest/index', compact('materialrequests'));
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
        }
        $request_status = DB::table('material_request_statuses')->where('name','=','approved')->pluck('id')->first();
        $materialrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)->get()->all();
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
        }
        $request_status = DB::table('material_request_statuses')->where('name','=','rejected')->pluck('id')->first();
        $materialrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)->get()->all();
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
        }
        $request_status = DB::table('material_request_statuses')->where('name','=','pending')->pluck('id')->first();
        $materialrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)->get()->all();
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
            $materialrequest->save();
      
            return redirect()->back()->with('message',"Changes");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(MaterialRequest::where('id', $id)->delete())
        {
            return redirect()->back()->with('success','Record Successfully Deleted.');
        }
        else
        {
            return redirect()->back()->with('message','Record is not Deleted.');

        }
        
    }


}
