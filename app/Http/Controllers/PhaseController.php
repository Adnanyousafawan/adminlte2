<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectPhase;
use Validator;
use DB;
use Gate;


class PhaseController extends Controller
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
        $phases = DB::table('project_phase')->get()->all();
        return view('projectphase/index',compact('phases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
       return view('projectphase/create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function insert(Request $request)
    {
    if($request->ajax())
       {
          $rules = array(

             'name.*'  => 'required'
         );

          $error = Validator::make($request->all(), $rules);
          if($error->fails())
          {
             return response()->json([
                'error'  => $error->errors()->all()
            ]);
         }

         $name = $request['name'];


         for($count = 0; $count < count($name); $count++)
         {
   
          $obj = new ProjectPhase([
              'name' => $name[$count],

          ]);
          //
          $obj->save();
      }
      return response()->json([
       'success'  => 'Data Added successfully.']
    );
    }
}
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Phase $phase
     * @return \Illuminate\Http\Response
     */
    public function show(Phase $phase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Phase $phase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phase = DB::table('project_phase')->find($id);
        return redirect()->back()->with('message','Think about Editing');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Phase $phase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phase $phase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Phase $phase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = DB::table('projects')->where('phase_id','=',$id)->count();
       if($count == 0)
       {
            ProjectPhase::where('id', $id)->delete();
            return redirect()->back()->with('success','Phase Deleted Successfully.');
       }
       else
       {
            return redirect()->back()->with('message','Some projects are in this Phase. Edit Phase Instead');
       }
       
    }
}
