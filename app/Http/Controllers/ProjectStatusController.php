<?php

namespace App\Http\Controllers;
use App\Phase;
use Illuminate\Http\Request;
use App\ProjectStatus;
use Validator;
use DB;


class ProjectStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = DB::table('project_status')->get()->all();
        return view('projectstatus/index',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('projectstatus/create');  
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
   
          $obj = new ProjectStatus([
              'name' => $name[$count],

          ]);
          //
          $obj->save();
      }
      return response()->json([
       'success'  => 'Status Added successfully.']
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
        $status = DB::table('project_status')->find($id);
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
        $count = DB::table('projects')->where('status_id','=',$id)->count();
           if($count == 0)
           {
                ProjectStatus::where('id', $id)->delete();
                return redirect()->back()->with('success','Status Deleted Successfully.');
           }
           else
           {
                return redirect()->back()->with('message','Some projects are in this Status. Edit Status Instead');
           }
        
    }
}
