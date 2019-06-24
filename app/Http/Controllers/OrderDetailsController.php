<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\OrderDetail;
use DB;
use Validator;


class OrderDetailsController extends Controller
{

 function index()
 {
  $orders = DB::table('order_details')->get();
  return view('orders/allorders',compact('orders'));
}

function insert(Request $request)
{ 
  
    //error_log($request);

       //Log::log($request);

     if($request->ajax())
     {
      $rules = array(
       'item_id.*'  => 'required',
       'quantity.*'  => 'required'
      );
      
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

    $item_id = $request['item_id'];
    $project_id = $request['project_id'];
    $quantity = $request['quantity'];
    $status =$request['status'];
    // $rate = $request->rate

//$insert_data = array();


    for($count = 0; $count < count($item_id); $count++){
      //  return response()->json($item_id[$count]);

      $obj = new OrderDetail([
      'item_id' => DB::table('items')->where('name','=',  $item_id[$count])->pluck('id')->first(),
     'quantity' =>  $quantity[$count],
      'project_id' =>DB::table('projects')->where('title','=',  $project_id)->pluck('id')->first(),
      'status' => $status[$count],
      
      ]);

      // dd($obj);
      $obj->save();
    }

        // DB::table('order_details')->insert($data);
   return response()->json([
     'success'  => 'Data Added successfully.']
   );
}
}

function create()
      {
          $items = DB::table('items')->get();
          $projects = DB::table('projects')->get();
          return view('orders/create', ['items' => $items],['projects' => $projects]);
      }

     // return redirect()->route('orderdetails.index')->with('success', 'Data Updated');
      //OrderDetail::insert($insert_data);
     //return response()->json($data);

  public function destroy($id)
    {
      
        OrderDetail::where('id', $id)->delete();
        return redirect()->intended('orders');
      
    }

   public function show()
    {
        $orders = DB::table('order_details')->get();
 // $users = DB::table('users')->get();
         return view('orders/allorders',compact('orders'));
    }
      public function cancelled()
    {
      $orders = DB::table('order_details')->where('order_details.status','=','sad')->get();
      return view('orders/allorders',compact('orders'));
    }
    public function recieved()
    {
      $orders = DB::table('order_details')->where('order_details.status','=','ok')->get();
      return view('orders/allorders',compact('orders'));
    }
   

}