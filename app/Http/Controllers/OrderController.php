<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\orders;
use Validator;

class OrderController extends Controller
{

    function index()
    {
        return view('orders/create');
    }



    function insert(Request $request)
    {
       
        //echo "In Insert";
     if($request->ajax())
     {
      $rules = array(
       'item_id.*'  => 'required',
       'status.*'  => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }
      $items_id = $request->input('items_id');
      $status = $request->input('status');

     // dd($items_id);

      for($count = 0; $count < count($items_id); $count++)
      {
       $data = array(
        'item_id' => $items_id[$count],
        'status'  => $status[$count]
       );
       $insert_data[] = $data; 
      }

      DB::table('orders')::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
     }
    }
}





/*
    public function addMore()
    {
        return view("orders/create");
    }


    public function addMorePost(Request $request)
    {
        $rules = [];


        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {


            foreach($request->input('name') as $key => $value) {
                Orders::create(['name'=>$value]);
            }


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }

*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*

   public function index()
    {
        //
    }
    
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
   /*
    public function create()
    {
        //

    }

*/
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
   /*
    public function store(Request $request)
    {
        $bio =  new orders;
        $bio->details = $request->get('name');
        //dd($request->get('name'));
        $bio->save();
        return "Success";

        
    }
    */

    /**
     * Display the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
   /*


    public function show(Order $order)
    {
        //
    }
*/
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
   /*

    public function edit(Order $order)
    {
        //
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
   
/*
    public function update(Request $request, Order $order)
    {
        //
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
   
/*
    public function destroy(Order $order)
    {
        //
    }
*/
