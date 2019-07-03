<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        date_default_timezone_set('asia/ho_chi_minh');
        $format = 'Y/m/d';
        $now = date($format);
        //$to = date($format, strtotime("+30 days")); --}}
        $to = date($format, strtotime("+1 days"));

        $constraints = [
            'from' => $now,
            'to' => $to,
            'proj' => '',
            'proj_name' => '' 
            
        ];

        $orders = DB::table('order_details')
        ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
        ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
        ->where('order_details.created_at','>=',$now)
        ->where('order_details.created_at','<=',$to)
        ->select('order_details.invoice_number', 'order_details.quantity', 
        'suppliers.name as supplier_name','items.name', 'items.rate','order_details.created_at')
        ->get();

        $projects = DB::table('projects')->pluck('title')->all();

      
        return view('reports/index', ['orders' => $orders, 'projects' => $projects, 'searchingVals' => $constraints]);
    }

    public function exportPDF(Request $request) {
       $proj_name = DB::table('projects')->where('id','=', $request->input('project_id'))->pluck('title')->first(); 
         $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'proj' => $request->input('project_id'),
            'proj_name' => $proj_name 
        ];

        $projects = DB::table('projects')->pluck('title')->all();
        $orders =  $this->getExportingData($constraints);// DB::table('order_details')->get();
        $pdf = PDF::loadView('reports/pdf', ['orders' => $orders, 'searchingVals' => $constraints]);
        return $pdf->download('project'.$request['project_id'].'report_from_'. $request['from'].'_to_'.$request['to'].'pdf');
        return view('reports/index', ['orders' => $orders,'projects' => $projects, 'searchingVals' => $constraints]);
    }
    
   
    public function search(Request $request) {
       $proj_name = DB::table('projects')->where('id','=', $request->input('project_id'))->pluck('title')->first(); 
       
        $projID = DB::table('projects')
            ->where('title', '=', $request->input('project'))
            ->pluck('id')->first();
            
        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'proj' => $projID,
            'proj_name' => $proj_name 
            
        ];

        $orders = $this->getOrderList($constraints);
        $projects = DB::table('projects')->pluck('title')->all();
        return view('reports/index', ['orders' => $orders,'projects' => $projects, 'searchingVals' => $constraints]);
    }

    private function getOrderList($constraints) {
      
        $orders = OrderDetail::where('created_at', '>=', $constraints['from'])
                        ->where('created_at', '<=', $constraints['to'])
                        ->where('project_id','=',$constraints['proj'])
                        ->get();
        return $orders;
    }

    private function getExportingData($constraints) {
       
        return DB::table('order_details')
        ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
        ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
        ->select('order_details.invoice_number', 'order_details.quantity', 
        'suppliers.name as supplier_name','items.name', 'items.rate','order_details.created_at')
        ->where('order_details.created_at', '>=', $constraints['from'])
        ->where('order_details.created_at', '<=', $constraints['to'])
        ->where('order_details.project_id','=',$constraints['proj'])
        ->get()
        ->map(function ($item, $key) {
        return (array) $item;
        })
        ->all();
    }
}
