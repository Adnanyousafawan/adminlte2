<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use DB;
use Validator;
use Gate;
use Auth;

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

            $invoice = DB::table('order_details')->pluck('invoice_number')->last();
            if ($invoice == 0) {
                $invoice = 1000;
            } else {
                $invoice++;
            }

            for ($count = 0; $count < count($item_id); $count++) {

                $set_rate = DB::table('items')->where('id', '=', $item_id[$count])->pluck('selling_rate')->first();
                $obj = new OrderDetail([
                    'item_id' => $item_id[$count],
                    'project_id' => DB::table('projects')->where('title', '=', $project_id)->pluck('id')->first(),
                    'supplier_id' => $supplier_id,
                    'quantity' => $quantity[$count],
                    'set_rate' => $set_rate,
                    'invoice_number' => $invoice,
                ]);
                $obj->save();
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

        $orders->project_id = $request->input('project_id');
        $orders->supplier_id = $request->input('supplier_id');
        $orders->item_id = $request->input('item_id');
        $orders->quantity = $request->input('quantity');

        if ($orders->save()) {
            return redirect()->back()->with('success', "Order Updated successfully");
        } else {
            return redirect()->back()->with('message', "Order is not Updated");
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
        $order = OrderDetail::find($id);
        $order->status = 'Cancelled';
        if ($order->save()) {
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
        $orders = DB::table('order_details')->where('project_id', '=', $id)->get();
        $items = DB::table('items')->get();
        $suppliers = DB::table('suppliers')->get();
        $projects = DB::table('projects')->get();
        return view('orders/allorders', compact('orders', 'suppliers', 'projects', 'items'));
    }
}
