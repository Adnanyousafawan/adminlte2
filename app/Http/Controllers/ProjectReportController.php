<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use Carbon;
class ProjectReportController extends Controller
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
        //$now = date($format);
       // $now = Carbon\Carbon::now()->format('d/m/Y');
        $now = date($format);
        //$now = $now->toRfc850String(); 
        //$to = date($format, strtotime("+30 days")); --}}
        $to = date($format, strtotime("-2 days"));
        $last_invoice = DB::table('order_details')->pluck('invoice_number')->last();  

        $constraints = [
            'from' => $now,
            'to' => $to,
            'proj' => '',
            'proj_name' => '',
            'last_invoice' => $last_invoice
        ];

        $orders = DB::table('order_details')
        ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
        ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
        ->where('order_details.created_at','<=',$now)
        ->where('order_details.created_at','>=',$to)
        ->select('order_details.invoice_number', 'order_details.set_rate','order_details.quantity', 
        'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at')
        ->get();
       // dd($orders);
        $last_invoice = DB::table('order_details')->pluck('invoice_number')->last();    

        $projects = DB::table('projects')->pluck('title')->all();

      
        return view('reports/index_by_project', ['orders' => $orders, 'projects' => $projects, 'searchingVals' => $constraints]);
    } 

    public function exportPDF(Request $request) {
       $proj_name = DB::table('projects')->where('id','=', $request->input('project_id'))->pluck('title')->first(); 
        $last_invoice = DB::table('order_details')->pluck('invoice_number')->last();    


         $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'proj' => $request->input('project_id'),
            'proj_name' => $proj_name,
            'last_invoice' => $last_invoice
        ]; 

        $projects = DB::table('projects')->pluck('title')->all();

        $orders =  $this->getExportingData($constraints);// DB::table('order_details')->get();
        $pdf = PDF::loadView('reports/pdf_by_project', ['orders' => $orders, 'searchingVals' => $constraints]);
        return $pdf->download('project'.$request['project_id'].'report_from_'. $request['from'].'_to_'.$request['to'].'pdf');
        return view('reports/index_by_project', ['orders' => $orders,'projects' => $projects, 'searchingVals' => $constraints]);
    }
    
   
    public function search(Request $request) {
       $proj_name = DB::table('projects')->where('id','=', $request->input('project_id'))->pluck('title')->first(); 
       
        $projID = DB::table('projects')
            ->where('title', '=', $request->input('project'))
            ->pluck('id')->first();

        $last_invoice = DB::table('order_details')->pluck('invoice_number')->last();    


            
        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'proj' => $projID,
            'proj_name' => $proj_name, 
            'last_invoice' => $last_invoice
        ];

        $orders = $this->getOrderList($constraints);
        $projects = DB::table('projects')->pluck('title')->all();
        return view('reports/index_by_project', ['orders' => $orders,'projects' => $projects, 'searchingVals' => $constraints]);
    }

    private function getOrderList($constraints) {
      
        $orders = OrderDetail::leftJoin('items', 'order_details.item_id', '=', 'items.id')
        ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
        ->select('order_details.invoice_number', 'order_details.quantity', 'order_details.set_rate',
        'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at')
        ->where('order_details.created_at', '<=', $constraints['from'])
        ->where('order_details.created_at', '>=', $constraints['to'])
        ->where('order_details.project_id','=',$constraints['proj'])
        ->get();
        return $orders;
    }

    private function getExportingData($constraints) {
       
        return DB::table('order_details')
        ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
        ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
        ->select('order_details.invoice_number', 'order_details.quantity', 'order_details.set_rate',
        'suppliers.name as supplier_name','items.name', 'items.selling_rate','order_details.created_at')
        ->where('order_details.created_at', '<=', $constraints['from'])
        ->where('order_details.created_at', '>=', $constraints['to'])
        ->where('order_details.project_id','=',$constraints['proj'])
        ->get()
        ->map(function ($item, $key) {
        return (array) $item;
        })
        ->all();
    }
}
