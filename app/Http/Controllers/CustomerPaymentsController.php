<?php

namespace App\Http\Controllers;

use App\CustomerPayment;
use Illuminate\Http\Request;
use Gate;
use DB;
use Validator; 

class CustomerPaymentsController extends Controller
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
       // $payments = DB::table('customer_payments')->get();

        //$projects = DB::table('Projects')->where('id','=',$payment->project_id)->pluck('title')->first()
        $payments = DB::table('customer_payments')
        ->leftJoin('projects', 'customer_payments.project_id', '=', 'projects.id')
        ->select('customer_payments.id','projects.id as project_id', 'projects.title','customer_payments.received', 
        'customer_payments.receivable','customer_payments.created_at','projects.estimated_budget as budget')
        ->get();
        //dd($expenses);
        
       

        return view('payments/customerpayments',compact('payments'));
    }

public function insert(Request $request)
{

     if($request->ajax())
     {
      $rules = array(
       'project_id.*' =>'required',
       'received_amount.*'  => 'required',
      );

      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

  
    $project_id = $request['project_id'];
    $received_amount = $request['received_amount'];
   // $receivable = DB::table()
   // dd($received_amount);
   
    for($count = 0; $count < count($received_amount); $count++){
      //  return response()->json($item_id[$count]);
      $obj = new CustomerPayment([
     'received' =>  $received_amount[$count],
     'project_id' => $project_id[$count],
      ]); 
      //dd($obj);
      $obj->save();
    }

        // DB::table('order_details')->insert($data);
   return response()->json([
     'success'  => 'Data Added successfully.']
   );
}
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = DB::table('projects')->get();
        return view('payments/create',['projects' => $projects]);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer_payments  $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function show(customer_payments $customer_payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer_payments  $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function edit(customer_payments $customer_payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer_payments  $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
          $request->validate([
            'received' => 'required',
        ]);

       $payments = CustomerPayment::find($id);
        $payments->received = $request->input('received');

       if($payments->save())
       {
        return redirect()->back()->with('success',"Payment Updated successfully");
       }
       else
       {
        return redirect()->back()->with('message',"Payment is not Updated");
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer_payments  $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomerPayment::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Item Deleted Succuessfully.');
    }
}
