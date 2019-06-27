<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\MiscellaneousExpense;
use Validator;
use View;
use Gate;
class MiscellaneousExpenseController extends Controller
{
    
    function index()
    {
       if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
		    	 
		  $expenses = DB::table('miscellaneous_expenses')->get();

		  return view('expenses/allexpenses',['expenses' => $expenses]);
		     
    }

    function insert(Request $request)
    {  

         if($request->ajax())
         {
          $rules = array(
           'name.*'  => 'required',
           'project_id*'  => 'required',
           'description.*'  => 'required',
           'expenses.*'  => 'required'
          );
          
          $error = Validator::make($request->all(), $rules);
          if($error->fails())
          {
           return response()->json([
            'error'  => $error->errors()->all()
           ]);
          }

   	$name = $request['name'];
    $project_id = $request['project_id'];
    $description = $request['description'];
    $expenses =$request['expenses'];
    // $rate = $request->rate

//$insert_data = array();


    for($count = 0; $count < count($name); $count++){
      //  return response()->json($item_id[$count]);

      $obj = new MiscellaneousExpense([
      'name' => $name[$count],
      'description' =>  $description[$count],
      'project_id' =>DB::table('projects')->where('title','=',  $project_id)->pluck('id')->first(),
      'expense' => $expenses[$count],
      
      ]); 

      // dd($obj);
    
      $obj->save();
    }

        // DB::table('order_details')->insert($data);


   return response()->json([
     'success'  => 'Data Added successfully.']);

    } 
}
  function create()
      {
           if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
        $projects = DB::table('projects')->get();
        return view('expenses/create',compact('projects'));
      }

     // return redirect()->route('orderdetails.index')->with('success', 'Data Updated');
      //OrderDetail::insert($insert_data);
     //return response()->json($data);

  public function destroy($id)
    {
      
        MiscellaneousExpense::where('id', $id)->delete();
        return redirect()->intended('expenses')->with('success','Record Successfully Deleted.');
      
    }
  }