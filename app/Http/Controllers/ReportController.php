<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use Carbon;

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
    
    public function index()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $format = 'Y/m/d';
        //$now = date($format);
        // $now = Carbon\Carbon::now()->format('d/m/Y');
        $now = date($format);
        //$now = $now->toRfc850String(); 
        //$to = date($format, strtotime("+30 days")); --}}
        $to = date($format, strtotime("-1 days"));

        $constraints = [
            'from' => $now,
            'to' => $to,
        ];
        $check = DB::table('projects')->get()->count();
        if ($check == 0) {
            return redirect()->intended('home')->with('message', "Cant Generate reports. No Project exist");
        } else {
            $check = DB::table('items')->get()->count();
            if ($check == 0) {
                return redirect()->intended('home')->with('message', "Cant Generate reports. As there are no Items");
            } else {
                $orders = DB::table('order_details')
                    ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                    ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                    ->where('order_details.created_at', '<=', $now)
                    ->where('order_details.created_at', '>=', $to)
                    ->select('project_id', 'order_details.invoice_number', 'order_details.quantity',
                        'suppliers.name as supplier_name', 'items.name', 'order_details.set_rate', 'order_details.created_at')
                    ->get();
                return view('reports/index', ['orders' => $orders, 'searchingVals' => $constraints]);
            }
        }
    }

    public function weekly()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $format = 'Y/m/d';
        //$now = date($format);
        // $now = Carbon\Carbon::now()->format('d/m/Y');
        $now = date($format);
        //$now = $now->toRfc850String(); 
        //$to = date($format, strtotime("+30 days")); --}}
        $to = date($format, strtotime("-7 days"));

        $constraints = [
            'from' => $now,
            'to' => $to,
        ];
        //dd($constraints['type']);
        $check = DB::table('projects')->get()->count();

        if ($check == 0) {
            return redirect()->intended('firstview')->with('message', "Cant Generate reports. No Project exist");
        }

        $orders = DB::table('order_details')
            ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
            ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
            ->where('order_details.created_at', '<=', $now)
            ->where('order_details.created_at', '>=', $to)
            ->select('project_id', 'order_details.invoice_number', 'order_details.quantity',
                'suppliers.name as supplier_name', 'items.name', 'order_details.set_rate', 'order_details.created_at')
            ->get();


        return view('reports/index', ['orders' => $orders, 'searchingVals' => $constraints]);

    }

    public function monthly()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $format = 'Y/m/d';
        //$now = date($format);
        // $now = Carbon\Carbon::now()->format('d/m/Y');
        $now = date($format);
        //$now = $now->toRfc850String(); 
        //$to = date($format, strtotime("+30 days")); --}}
        $to = date($format, strtotime("-30 days"));

        $constraints = [
            'from' => $now,
            'to' => $to,
        ];
        $check = DB::table('projects')->get()->count();

        if ($check == 0) {
            return redirect()->intended('firstview')->with('message', "Cant Generate reports. No Project exist");
        }
        $orders = DB::table('order_details')
            ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
            ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
            ->where('order_details.created_at', '<=', $now)
            ->where('order_details.created_at', '>=', $to)
            ->select('project_id', 'order_details.invoice_number', 'order_details.quantity',
                'suppliers.name as supplier_name', 'items.name', 'order_details.set_rate', 'order_details.created_at')
            ->get();

        return view('reports/index', ['orders' => $orders, 'searchingVals' => $constraints]);
    }


    public function exportPDF(Request $request)
    {
        // $proj_name = DB::table('projects')->where('id','=', $request->input('project_id'))->pluck('title')->first();


        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            //'proj' => $request->input('project_id'),
            //'proj_name' => $proj_name 
        ];
        // check($constraints['type']);
        //$check = $constraints['type'];

        $orders = $this->getExportingData($constraints);// DB::table('order_details')->get();
        $pdf = PDF::loadView('reports/pdf', ['orders' => $orders, 'searchingVals' => $constraints]);
        return $pdf->download('report_from_' . $request['from'] . '_to_' . $request['to'] . 'pdf');
        return view('reports/index', ['orders' => $orders, 'searchingVals' => $constraints]);
    }


    public function search(Request $request)
    {
        //$proj_name = DB::table('projects')->where('id','=', $request->input('project_id'))->pluck('title')->first();

        /* $projID = DB::table('projects')
             ->where('title', '=', $request->input('project'))
             ->pluck('id')->first();
             */

        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            //'proj' => $projID,
            // 'proj_name' => $proj_name
        ];

        $orders = $this->getOrderList($constraints);
        //$projects = DB::table('projects')->pluck('title')->all();
        return view('reports/index', ['orders' => $orders, 'searchingVals' => $constraints]);
    }

    private function getOrderList($constraints)
    {

        $orders = OrderDetail::leftJoin('items', 'order_details.item_id', '=', 'items.id')
            ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
            ->select('project_id', 'order_details.invoice_number', 'order_details.quantity',
                'suppliers.name as supplier_name', 'items.name', 'order_details.set_rate', 'order_details.created_at')
            ->where('order_details.created_at', '<=', $constraints['from'])
            ->where('order_details.created_at', '>=', $constraints['to'])
            //->where('order_details.project_id','=',$constraints['proj'])
            ->get();
        return $orders;
    }

    private function getExportingData($constraints)
    {

        return DB::table('order_details')
            ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
            ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
            ->select('project_id', 'order_details.invoice_number', 'order_details.quantity',
                'suppliers.name as supplier_name', 'items.name', 'order_details.set_rate', 'order_details.created_at')
            ->where('order_details.created_at', '<=', $constraints['from'])
            ->where('order_details.created_at', '>=', $constraints['to'])
            //->where('order_details.project_id','=',$constraints['proj'])
            ->get()
            ->map(function ($item, $key) {
                return (array)$item;
            })
            ->all();
    }
}
