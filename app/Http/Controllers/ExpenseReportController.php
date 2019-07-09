<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use Carbon;

class ExpenseReportController extends Controller
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
        $last_expense = DB::table('miscellaneous_expenses')->pluck('id')->last();
        //$last_id = DB::table('miscellaneous_expenses')->pluck('expense_number')->last();  


        $constraints = [
            'from' => $now,
            'to' => $to,
            'proj' => '',
            'proj_name' => '',
            'last_expense' => $last_expense
        ];

        $expenses = DB::table('miscellaneous_expenses')
            ->leftJoin('projects', 'miscellaneous_expenses.project_id', '=', 'projects.id')
            ->where('miscellaneous_expenses.created_at', '<=', $now)
            ->where('miscellaneous_expenses.created_at', '>=', $to)
            ->select('miscellaneous_expenses.id', 'miscellaneous_expenses.expense_number', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description',
                'miscellaneous_expenses.expense', 'miscellaneous_expenses.created_at')
            ->get();

        $projects = DB::table('projects')->pluck('title')->all();


        return view('expenses/report/project_expenses', ['expenses' => $expenses, 'projects' => $projects, 'searchingVals' => $constraints]);
    }

    public function exportPDF(Request $request)
    {
        $proj_name = DB::table('projects')->where('id', '=', $request->input('project_id'))->pluck('title')->first();
        $last_expense = DB::table('miscellaneous_expenses')->pluck('id')->last();

        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'proj' => $request->input('project_id'),
            'proj_name' => $proj_name,
            'last_expense' => $last_expense
        ];

        $projects = DB::table('projects')->pluck('title')->all();

        $expenses = $this->getExportingData($constraints);// DB::table('order_details')->get();
        $pdf = PDF::loadView('expenses/report/pdf_project_expense', ['expenses' => $expenses, 'searchingVals' => $constraints]);
        return $pdf->download('project' . $request['project_id'] . 'report_from_' . $request['from'] . '_to_' . $request['to'] . 'pdf');
        return view('expenses/report/project_expenses', ['expenses' => $expenses, 'projects' => $projects, 'searchingVals' => $constraints]);
    }


    public function search(Request $request)
    {
        $proj_name = DB::table('projects')->where('id', '=', $request->input('project_id'))->pluck('title')->first();

        $projID = DB::table('projects')
            ->where('title', '=', $request->input('project'))
            ->pluck('id')->first();

        $last_expense = DB::table('miscellaneous_expenses')->pluck('id')->last();


        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'proj' => $projID,
            'proj_name' => $proj_name,
            'last_expense' => $last_expense
        ];

        $expenses = $this->getOrderList($constraints);
        $projects = DB::table('projects')->pluck('title')->all();
        return view('expenses/report/project_expenses', ['expenses' => $expenses, 'projects' => $projects, 'searchingVals' => $constraints]);
    }

    private function getOrderList($constraints)
    {

        $expenses = DB::table('miscellaneous_expenses')
            ->leftJoin('projects', 'miscellaneous_expenses.project_id', '=', 'projects.id')
            ->where('miscellaneous_expenses.created_at', '<=', $constraints['from'])
            ->where('miscellaneous_expenses.created_at', '>=', $constraints['to'])
            ->where('miscellaneous_expenses.project_id', '=', $constraints['proj'])
            ->select('miscellaneous_expenses.id', 'miscellaneous_expenses.expense_number', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description',
                'miscellaneous_expenses.expense', 'miscellaneous_expenses.created_at')
            ->get();
        return $expenses;
    }

    private function getExportingData($constraints)
    {

        return DB::table('miscellaneous_expenses')
            ->leftJoin('projects', 'miscellaneous_expenses.project_id', '=', 'projects.id')
            ->where('miscellaneous_expenses.created_at', '<=', $constraints['from'])
            ->where('miscellaneous_expenses.created_at', '>=', $constraints['to'])
            ->where('miscellaneous_expenses.project_id', '=', $constraints['proj'])
            ->select('miscellaneous_expenses.id', 'miscellaneous_expenses.expense_number', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description',
                'miscellaneous_expenses.expense', 'miscellaneous_expenses.created_at')
            ->get()
            ->map(function ($item, $key) {
                return (array)$item;
            })
            ->all();
    }
}
