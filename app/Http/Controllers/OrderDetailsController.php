<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\OrderDetail;
use DB;
use Validator;
use Gate;

class OrderDetailsController extends Controller
{
 function index()
 { 
   if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        } 

        $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->select('order_details.id','project_id','order_details.invoice_number', 'order_details.quantity', 
                'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at',
                'order_details.status')  
                ->get(); 
                //dd($orders);
    //  $orders = DB::table('order_details')->get();
      $items = DB::table('items')->get();
      $suppliers = DB::table('suppliers')->get();
     $projects = DB::table('projects')->get();
      return view('orders/allorders',compact('orders','projects','items','suppliers'));
}
 
function insert(Request $request)
{ 
  
     if($request->ajax()) 
     {
      $rules = array(
       //'item_id.*'  => 'required',
      // 'supplier_id.*' => 'required',
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
    $supplier_id = $request['supplier_id'];
    $quantity = $request['quantity'];
    //dd($project_id);

    $invoice = DB::table('order_details')->pluck('invoice_number')->last();
    if($invoice == 0)
    {
      $invoice = 1000;
    }
    else
    {
      $invoice++;
    }

    for($count = 0; $count < count($item_id); $count++){
      //  return response()->json($item_id[$count]);
      $set_rate = DB::table('items')->where('id','=',$item_id[$count])->pluck('selling_rate')->first();
      $obj = new OrderDetail([

      'item_id' => $item_id[$count],
      // DB::table('items')->where('name','=',  $item_id[$count])->pluck('id')->first(),
      'project_id' => DB::table('projects')->where('title','=',  $project_id)->pluck('id')->first(),
      'supplier_id' => $supplier_id,
      //$supplier_id[$count],
      // DB::table('suppliers')->where('name','=',  $supplier_id[$count])->pluck('id')->first(),
      'quantity' => $quantity[$count],
      'set_rate' => $set_rate,
      'invoice_number' =>  $invoice,
     
      //'status' => $status[$count],
      ]); 

       //dd($obj);
      $obj->save();
    }
        // DB::table('order_details')->insert($data);
   return response()->json([
     'success'  => 'Order Added successfully.']
   );
}
}

function create()
      {
         if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }
         // $items = DB::table('items')->get();
          $suppliers['data'] =DB::table('suppliers')->orderBy('id', 'asc')->get();
          $projects = DB::table('projects')->get(); 
          //dd($suppliers);
          return view('orders/create',compact('projects','suppliers'));



      }

    public function getItems($supplier_id)
    {
        //dd('in items');
        $itemData['data'] = DB::table('items')->where('supplier_id', $supplier_id)->get();
        //echo response()->json($itemData);
        
        echo json_encode($itemData);
        exit;
    }

     // return redirect()->route('orderdetails.index')->with('success', 'Data Updated');
      //OrderDetail::insert($insert_data);
     //return response()->json($data);

  public function destroy($id)
    {
        OrderDetail::where('id', $id)->delete();
        return redirect()->intended('orders'); 
    }

    public function update(Request $request,$id)
    {
        
         $request->validate([
            'item_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'project_id' => 'required',
         
        ]);
 
       $orders = OrderDetail::find($id);

       $orders->project_id = DB::table('projects')->where('title','=', $request->input('project_id'))->pluck('id')->first();
       $orders->supplier_id = DB::table('suppliers')->where('name','=', $request->input('supplier_id'))->pluck('id')->first();
       $orders->item_id = DB::table('items')->where('name','=',$request->input('item_id'))->pluck('id')->first();
       $orders->quantity = $request->input('quantity');

       if($orders->save())
       {
        return redirect()->back()->with('success',"Order Updated successfully");
       }
       else
       {
        return redirect()->back()->with('message',"Order is not Updated");
       }

    }

   public function pending()
    {
       $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->where('order_details.status','=','Pending')
                ->select('order_details.id','project_id','order_details.invoice_number', 'order_details.quantity', 
                'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at',
                'order_details.status')  
                ->get(); 
        //$orders = DB::table('order_details')->get();
        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        $projects = DB::table('projects')->get();

 // $users = DB::table('users')->get();
         return view('orders/allorders',compact('orders','suppliers','projects','items'));
    }
      public function cancelled()
    {
       $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->where('order_details.status','=','Cancelled')
                ->select('order_details.id','project_id','order_details.invoice_number', 'order_details.quantity', 
                'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at',
                'order_details.status')  
                ->get(); 
      //$orders = DB::table('order_details')->where('order_details.status','=','sad')->get();
       $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        $projects = DB::table('projects')->get();
      return view('orders/allorders',compact('orders','suppliers','projects','items'));
    }
    public function recieved()
    {
       $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->where('order_details.status','=','Received')
                ->select('order_details.id','project_id','order_details.invoice_number', 'order_details.quantity', 
                'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at',
                'order_details.status')  
                ->get(); 
      //$orders = DB::table('order_details')->where('order_details.status','=','ok')->get();
       $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        $projects = DB::table('projects')->get();
      return view('orders/allorders',compact('orders','suppliers','projects','items'));
    }
     public function cancelorder($id)
    {
      $order = OrderDetail::find($id);
      // DB::table('order_details')->where('id','=',$id)->get();
      //dd($order);
      //$obj = OrderDetail
      $order->status = 'Cancelled';
      if($order->save())
      {
         return redirect()->back()->with('message'," Order is Cancelled");
      } 
      else
      {
         return redirect()->back()->with('succes'," Order is Cancelled"); 
      }

       
     // return view('orders/allorders',compact('orders','suppliers','projects','items'));
    }



    public function projectorders($id)
    {
       if(Gate::allows('isContractor'))
        {
            abort(420,'You Are not Allowed to access this site');
        }

      $orders = DB::table('order_details')->where('project_id','=',$id)->get();
       $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        $projects = DB::table('projects')->get();
      return view('orders/allorders', compact('orders','suppliers','projects','items'));
    }
}