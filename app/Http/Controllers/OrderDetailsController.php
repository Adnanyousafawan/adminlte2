<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use DB;
use Validator;
use Gate;
use Auth;
use Carbon;
 
class OrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    function index()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->get();

        }
        if (Gate::allows('isManager')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }

        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('orders/allorders', compact('orders', 'projects', 'items', 'suppliers'));
    }

    function insert(Request $request)
    {
        $last_order_id = 0;
        if ($request->ajax()) {
            $rules = array(
                'item_id.*' => 'required',
                'supplier_id.*' => 'required',
                'quantity.*' => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $item_id = $request['item_id'];
            $project_id = $request['project_id'];
            $supplier_id = $request['supplier_id'];
            $quantity = $request['quantity'];
            $proj_ID = DB::table('projects')->where('title', '=', $project_id)->pluck('id')->first();

            
            $orders_all =  DB::table('order_details')->where('order_details.project_id','=',$proj_ID)->get();
            foreach ($orders_all as $order) {
                $last_order_id = $order->id;
            }
            $last_invoice_date = DB::table('order_details')->where('id','=',$last_order_id)->pluck('created_at')->first();
            $last_project_invoice_number = DB::table('order_details')->where('project_id','=',$proj_ID)->pluck('invoice_number')->last();
          
    $invoice = DB::table('order_details')->pluck('invoice_number')->last();

            $today = Carbon\Carbon::today();

            if ($invoice == 0) 
            {
                $invoice = 1000;

            } 
            else 
            {

                if($last_invoice_date == $today)
                {
                    $invoice = $last_project_invoice_number;
                }
                else
                {

                     $invoice++;
                }
            }
            for ($count = 0; $count < count($item_id); $count++) {

                $set_rate = DB::table('items')->where('id', '=', $item_id[$count])->pluck('selling_rate')->first();
                $purchase_rate = DB::table('items')->where('id', '=', $item_id[$count])->pluck('purchase_rate')->first();
                $obj = new OrderDetail([
                    'item_id' => $item_id[$count],
                    'project_id' => $proj_ID,
                    'supplier_id' => $supplier_id,
                    'quantity' => $quantity[$count],
                    'invoice_number' => $invoice,
                    'set_rate' => $set_rate,
                    'purchase_rate' => $purchase_rate,
                   
                ]);
                $obj->save();
                
                $last_order_id = DB::table('order_details')->pluck('id')->last();
                $set_rate = DB::table('order_details')->where('id', '=', $last_order_id)->pluck('set_rate')->first();
                $purchase_rate = DB::table('order_details')->where('id', '=', $last_order_id)->pluck('purchase_rate')->first();

                DB::table('order_details')->where('id','=',$last_order_id)
                ->update([
                    'created_at' => $today , 'set_rate' => $set_rate,
                    'purchase_rate' => $purchase_rate,]);


                $check = DB::table('company_balance')->count();
                $order_cost = $purchase_rate * $quantity[$count];
                $diff = $set_rate - $purchase_rate;
                $temp = $diff * $quantity[$count];
                $order_cost_for_project = $set_rate * $quantity[$count];


                $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                if($check != 0)
                {
                    $company_balance = $comp_blnc - $order_cost;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $temp;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);

                    $proj_spent = DB::table('projects')->where('id','=',$proj_ID)->pluck('project_spent')->first();
                    $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID)->pluck('project_balance')->first();

                    $project_spent = $proj_spent + $order_cost_for_project;

                    $proj_balance_available = $proj_balance_available - $order_cost_for_project;

                    DB::table('projects')->where('id','=',$proj_ID)->update([
                        'project_spent' => $project_spent , 'project_balance' => $proj_balance_available]);


                    $supplier_blnc = DB::table('suppliers')->where('id','=',$supplier_id)->pluck('balance')->first();
                    $mat_cost = DB::table('suppliers')->where('id','=',$supplier_id)->pluck('material_cost')->first();
                    $material_cost = $mat_cost + $order_cost;

                    $supplier_balance = $supplier_blnc - $order_cost;

                    DB::table('suppliers')->where('id','=',$supplier_id)->update([
                                    'material_cost' => $material_cost, 'balance' => $supplier_balance]);

                } 
                else
                {
                    $company_balance = $comp_blnc - $order_cost;
                    DB::table('company_balance')->insert(['balance' =>  $company_balance]);
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $temp;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);

                    $proj_spent = DB::table('projects')->where('id','=',$proj_ID)->pluck('project_spent')->first();
                    $project_spent = $proj_spent + $order_cost_for_project;

                    $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID)->pluck('project_balance')->first();
                    
                    $proj_balance_available = $proj_balance_available - $order_cost_for_project;

                    DB::table('projects')->where('id','=',$proj_ID)->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);


                    $supplier_blnc = DB::table('suppliers')->where('id','=',$supplier_id)->pluck('balance')->first();
                    $mat_cost = DB::table('suppliers')->where('id','=',$supplier_id)->pluck('material_cost')->first();
                    $material_cost = $mat_cost + $order_cost;

                    $supplier_balance = $supplier_blnc - $order_cost;

                    DB::table('suppliers')->where('id','=',$supplier_id)->update([
                                    'material_cost' => $material_cost,'balance' => $supplier_balance]); 
                } 
            }
            return response()->json([
                    'success' => 'Order Added successfully.']
            );
        }
    }

    function create()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) {
            $projects = DB::table('projects')->get();
        }
        if (Gate::allows('isManager')) {
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }
        $suppliers['data'] = DB::table('suppliers')->orderBy('id', 'asc')->get();
        return view('orders/create', compact('projects', 'suppliers'));

    }

    public function getItems($supplier_id)
    {
        $itemData['data'] = DB::table('items')->where('supplier_id', $supplier_id)->get();
        echo json_encode($itemData);
        exit;
    }

    public function destroy($id)
    {
        $orders = OrderDetail::find($id);

        if($orders->status != "Cancelled")
        {
            $old_quantity = $orders->quantity; 
            $old_purchase_rate = $orders->purchase_rate;
            $old_set_rate = $orders->set_rate;
            $prof_diff = $old_set_rate - $old_purchase_rate;
            $profit = $prof_diff * $old_quantity;

            $order_cost = $old_purchase_rate * $old_quantity;
            $order_cost_company = $order_cost - $profit;
            $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
            $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $order_cost_company;
            DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                                'balance' => $company_balance]);


            $old_order_cost_for_project = $old_set_rate * $old_quantity;
            $new_order_cost_for_project_customer = $old_order_cost_for_project;

            $proj_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('project_id')->first();
            $proj_spent = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_spent')->first();
            $project_spent = $proj_spent - $new_order_cost_for_project_customer;

            $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_balance')->first();
                        
            $proj_balance_available = $proj_balance_available + $new_order_cost_for_project_customer;

            DB::table('projects')->where('id','=',$proj_ID_from_order)->update([
                            'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);

            $supplier_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('supplier_id')->first();
            $supplier_blnc = DB::table('suppliers')->where('id','=',$supplier_ID_from_order)->pluck('balance')->first();
            $mat_cost = DB::table('suppliers')->where('id','=',$supplier_ID_from_order)->pluck('material_cost')->first();
            $material_cost = $mat_cost - $order_cost;

            $supplier_balance = $supplier_blnc + $order_cost;

            DB::table('suppliers')->where('id','=',$supplier_ID_from_order)->update([
            'material_cost' => $material_cost, 'balance' => $supplier_balance]);
        }
       
        OrderDetail::where('id', $id)->delete();
        return redirect()->intended('orders');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'item_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'project_id' => 'required',
        ]);

        $orders = OrderDetail::find($id);

        $old_set_rate = $orders->set_rate;
        $old_purchase_rate = $orders->purchase_rate;
        $old_quantity = $orders->quantity; 
        $new_quantity = $request->input('quantity');       
/*
        $orders->project_id = $request->input('project_id');
        $orders->supplier_id = $request->input('supplier_id');
        $orders->item_id = $request->input('item_id');
*/
        $orders->quantity = $request->input('quantity');
        $old_temp = 0;
        $temp = 0;
        $profit = 0;
        $company_balance = 0;
        $comp_blnc_ID = 0;
        $comp_blnc = 0;
        $proj_spent = 0;
        $project_spent = 0;

        $order_cost_for_project = 0;


        $new_purchase_rate = DB::table('items')->where('id', '=', $request->input('item_id'))->pluck('purchase_rate')->first();
        $new_set_rate = DB::table('items')->where('id', '=', $request->input('item_id'))->pluck('selling_rate')->first();


        if ($orders->save()) 
        {
            if($new_quantity > $old_quantity)
            {
                $old_diff = $old_set_rate - $old_purchase_rate;
                $old_temp = $old_diff * $old_quantity;

                $new_diff = $new_set_rate - $new_purchase_rate;
                $temp = $new_diff * $old_quantity;

                

                if($new_purchase_rate > $old_purchase_rate)
                {
                // __________________ NEW RATE IS SET Updated ordered items added COST in Balance _____________________

                    $rate_diff = $new_purchase_rate - $old_purchase_rate;
                    $old_order_cost_to_new = $rate_diff * $old_quantity;

                    $order_cost_for_project_diff = $new_set_rate - $old_set_rate;
                    $order_cost_for_project_customer = $order_cost_for_project_diff * $old_quantity;

                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc - $old_order_cost_to_new;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);


                // __________________ Profit from OLD Items is added in Balance items______________________

                    $prof_diff = $new_set_rate - $new_purchase_rate;
                    $old_order_profit_to_new = $prof_diff * $old_quantity;
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $old_order_profit_to_new;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);
                

                // __________________Updated ordered items added COST in Balance _____________________

                    $quantity_diff = $new_quantity - $old_quantity;
                    $new_order_cost = $new_purchase_rate * $quantity_diff;

                    $new_order_cost_for_project_customer = $new_set_rate * $quantity_diff;

                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc - $new_order_cost;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);


                // __________________ Profit from New Items is added in Balance items______________________

                    $prof_diff = $new_set_rate - $new_purchase_rate;
                    $new_order_prof = $prof_diff * $quantity_diff;
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $new_order_prof;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);

                    //_______________________add quaery New set rate , purchase rate in orderdetails 

                    $order_cost_for_project = $order_cost_for_project_customer + $new_order_cost_for_project_customer;

                    $proj_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('project_id')->first();
                    $proj_spent = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_spent')->first();
                    $project_spent = $proj_spent + $order_cost_for_project;


                    $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_balance')->first();
                    $proj_balance_available = $proj_balance_available - $order_cost_for_project;

                    DB::table('projects')->where('id','=',$proj_ID_from_order)->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);



                    DB::table('order_details')->where('id','=',$id)
                    ->update(
                        ['purchase_rate' => $new_purchase_rate,'set_rate' => $new_set_rate]
                        );
                }
                elseif ($new_purchase_rate < $old_purchase_rate) 
                {
                // __________________Updated ordered items added COST in Balance _____________________
                   
                    $quantity_diff = $new_quantity - $old_quantity;
                    $new_order_cost = $old_purchase_rate * $quantity_diff;

                    $new_order_cost_for_project_customer = $new_set_rate * $quantity_diff;

                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc - $new_order_cost;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);


                    $proj_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('project_id')->first();
                    $proj_spent = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_spent')->first();
                    $project_spent = $proj_spent + $new_order_cost_for_project_customer;

                    $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_balance')->first();
                    $proj_balance_available = $proj_balance_available - $new_order_cost_for_project_customer;

                    DB::table('projects')->where('id','=',$proj_ID_from_order)->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);


                // __________________ Profit from New Items is added in Balance items______________________

                    $prof_diff = $old_set_rate - $old_purchase_rate;
                    $new_order_prof = $prof_diff * $quantity_diff;
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $new_order_prof;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);

                }
                else
                {

                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                   
                    $old_order_cost = $old_purchase_rate * $old_quantity;
                    $new_order_cost = $old_purchase_rate * $new_quantity;
                    $order_cost = $new_order_cost - $old_order_cost;
                
                    $company_balance = $comp_blnc - $order_cost;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);


                    $old_order_cost_for_project = $old_set_rate * $old_quantity;
                    $new_order_cost_for_project = $old_set_rate * $new_quantity;
                    $new_order_cost_for_project_customer = $new_order_cost_for_project - $old_order_cost_for_project;

                    $proj_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('project_id')->first();
                    $proj_spent = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_spent')->first();
                    $project_spent = $proj_spent + $new_order_cost_for_project_customer;


                    $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_balance')->first();
                   
                    $proj_balance_available = $proj_balance_available - $new_order_cost_for_project_customer;

                    DB::table('projects')->where('id','=',$proj_ID_from_order)->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);

                }
            }
            elseif ($new_quantity < $old_quantity) 
            {
                /*
                $old_diff = $old_set_rate - $old_purchase_rate;
                $old_temp = $old_diff * $old_quantity;

                $new_diff = $new_set_rate - $new_purchase_rate;
                $temp = $new_diff * $old_quantity;

                if($new_purchase_rate > $old_purchase_rate)
                {
                // __________________ NEW RATE IS SET Updated ordered items added COST in Balance _____________________

                    $new_temp = $old_purchase_rate * $request->input('quantity');
                    $old_temp = $old_purchase_rate * $old_quantity;
                    $temp = $old_temp - $new_temp;

                    $rate_diff = $new_purchase_rate - $old_purchase_rate;
                    $old_order_cost_to_new = $rate_diff * $old_quantity;
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc - $old_order_cost_to_new;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);





                // __________________ Profit from OLD Items is added in Balance items______________________

                
                // __________________Updated ordered items added COST in Balance _____________________

                  

                // __________________ Profit from New Items is added in Balance items______________________

                   

                    //_______________________add quaery New set rate , purchase rate in orderdetails 
                    DB::table('order_details')->where('id','=',$id)
                    ->update(
                        ['purchase_rate' => $new_purchase_rate,'set_rate' => $new_set_rate]
                        );
                }
                elseif ($new_purchase_rate < $old_purchase_rate) 
                {
                // __________________Updated ordered items added COST in Balance _____________________
                 

                // __________________ Profit from New Items is added in Balance items______________________

                  

                }
                else
                {
                    */
                    $new_temp = $old_purchase_rate * $request->input('quantity');
                    $old_temp = $old_purchase_rate * $old_quantity;
                    $temp = $old_temp - $new_temp;
                    
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                        
                    $company_balance = $comp_blnc + $temp;
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                                'balance' => $company_balance]);


                    $old_order_cost_for_project = $old_set_rate * $old_quantity;
                    $new_order_cost_for_project = $old_set_rate * $request->input('quantity');
                    $new_order_cost_for_project_customer = $old_order_cost_for_project - $new_order_cost_for_project;

                    $proj_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('project_id')->first();
                    $proj_spent = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_spent')->first();
                    $project_spent = $proj_spent - $new_order_cost_for_project_customer;


                    $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_balance')->first();
                    $proj_balance_available = $proj_balance_available + $new_order_cost_for_project_customer;

                    DB::table('projects')->where('id','=',$proj_ID_from_order)->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);



              //  }
            }
            else
            {
                return redirect()->back()->with('success', "You have not updated any record.");
            }
            return redirect()->back()->with('success', "Order updated successfully");
        }
         else {
            return redirect()->back()->with('message', "Order is not updated");
        }

    }

    public function pending()
    {
        if (Gate::allows('isAdmin')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('order_details.status', '=', 'Pending')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->get();

        }
        if (Gate::allows('isManager')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->where('order_details.status', '=', 'Pending')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }

        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();

        return view('orders/allorders', compact('orders', 'suppliers', 'projects', 'items'));
    }

    public function cancelled()
    {
        if (Gate::allows('isAdmin')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('order_details.status', '=', 'Cancelled')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->get();

        }
        if (Gate::allows('isManager')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->where('order_details.status', '=', 'Cancelled')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }

        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('orders/allorders', compact('orders', 'suppliers', 'projects', 'items'));
    }

    public function recieved()
    {
        if (Gate::allows('isAdmin')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('order_details.status', '=', 'Received')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->get();

        }
        if (Gate::allows('isManager')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->where('order_details.status', '=', 'Received')
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }

        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        return view('orders/allorders', compact('orders', 'suppliers', 'projects', 'items'));
    }

    public function cancelorder($id)
    {
        $orders = OrderDetail::find($id);
        $orders->status = 'Cancelled';

        $old_quantity = $orders->quantity; 
        $old_purchase_rate = $orders->purchase_rate;
        $old_set_rate = $orders->set_rate;
        $prof_diff = $old_set_rate - $old_purchase_rate;
        $profit = $prof_diff * $old_quantity;

        $order_cost = $old_purchase_rate * $old_quantity;
        $order_cost_company = $order_cost - $profit;
        $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
        $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
        $company_balance = $comp_blnc + $order_cost_company;
        DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                            'balance' => $company_balance]);

        $old_order_cost_for_project = $old_set_rate * $old_quantity;
        $new_order_cost_for_project_customer = $old_order_cost_for_project;

        $proj_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('project_id')->first();
        $proj_spent = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_spent')->first();
        $project_spent = $proj_spent - $new_order_cost_for_project_customer;


        $proj_balance_available = DB::table('projects')->where('id','=',$proj_ID_from_order)->pluck('project_balance')->first();
        $proj_balance_available = $proj_balance_available + $new_order_cost_for_project_customer;

        DB::table('projects')->where('id','=',$proj_ID_from_order)->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]);

        $supplier_ID_from_order = DB::table('order_details')->where('id','=',$id)->pluck('supplier_id')->first();
        $supplier_blnc = DB::table('suppliers')->where('id','=',$supplier_ID_from_order)->pluck('balance')->first();
        $mat_cost = DB::table('suppliers')->where('id','=',$supplier_ID_from_order)->pluck('material_cost')->first();
        $material_cost = $mat_cost - $order_cost;

        $supplier_balance = $supplier_blnc + $order_cost;

        DB::table('suppliers')->where('id','=',$supplier_ID_from_order)->update([
            'material_cost' => $material_cost, 'balance' => $supplier_balance]);

        if ($orders->save()) {
            return redirect()->back()->with('message', " Order is Cancelled");
        } else {
            return redirect()->back()->with('succes', " Order is Cancelled");
        }
    }

    public function projectorders($id)
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('project_id', '=', $id)
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->get();

        }
        if (Gate::allows('isManager')) {
            $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->where('project_id', '=', $id)
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->get();
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }


        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        $projects = DB::table('projects')->get();
        return view('orders/allorders', compact('orders', 'suppliers', 'projects', 'items'));
    }
}
