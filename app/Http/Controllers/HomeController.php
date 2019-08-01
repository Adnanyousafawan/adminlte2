<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MiscellaneousExpense;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use View;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Project;
use Gate;
use Charts; 

 
class HomeController extends Controller
{
    use UploadTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function goBackToHome()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        return view('welcome');
    }

    public function index()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
            if (Gate::allows('isManager')) {
                //_________________________ Dashboard Boxes Count _____________________________________
                $status_id = DB::table('project_status')->where('name', '=', 'Completed')->pluck('id')->first();
                $completed_projects = DB::table('projects')->where('status_id', '=', $status_id)
                    //->where('assigned_by', '=', Auth::User()->id)
                ->count();

                //if ($status_id != 0) {
                    $current_projects = DB::table('projects')->where('status_id', '!=', $status_id)
                        ->where('assigned_by', '=', Auth::User()->id)
                        ->count();
                        
                    $projects = DB::table('projects')->where('assigned_by', '=', Auth::User()->id)->get();
                    //dd($projects);
                    
                    $expense = 0;
                    $expenses = 0;
                    $orders = 0;
                    foreach ($projects as $project) {
                        $expense = DB::table('miscellaneous_expenses')->where('project_id', '=', $project->id)->pluck('expense')->first();
                      
                        if ($expense == 0) {
                            $expense = 0;
                        } else {
                            $expense = $expense + $expenses;
                            $expenses = $expense;
                        }
                    }
                    
                    $total_contractors = DB::table('users')->where('role_id', '=', 3)->count();
                  

                    //$completed_projects = DB::table('projects')->where('status_id', '=', $status_id)->count();

                    //_______________________________________________________________________________________
                $orders = DB::table('order_details')
                ->leftJoin('items', 'order_details.item_id', '=', 'items.id')
                ->leftJoin('suppliers', 'order_details.supplier_id', '=', 'suppliers.id')
                ->leftJoin('projects', 'order_details.project_id', '=', 'projects.id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->select('order_details.id', 'projects.title as project_title', 'projects.id as project_id', 'order_details.invoice_number', 'order_details.quantity',
                    'suppliers.name as supplier_name', 'suppliers.id as supplier_id', 'items.id as item_id', 'items.name as item_name', 'items.selling_rate', 'order_details.created_at',
                    'order_details.status')
                ->paginate(5);

                    //$orders = DB::table('order_details')->paginate(5);


                    //_________________________ Monthly Graph _______________________________________________

                    //____________________________ 
        $CompanyExpense = MiscellaneousExpense::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chart = Charts::database($CompanyExpense, 'bar', 'highcharts')
            ->title("Expense Details")
            ->elementLabel("Company Expenses")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), true);

        $pie_chart = Charts::create('pie', 'highcharts')
                            ->title('Company Income')
                            ->labels(['Projects', 'Material'])
                            ->values([100000,10000])
                            ->dimensions(1000, 500)
                            ->responsive(true);

           
                    return view('home', compact('projects', 'total_contractors', 'completed_projects', 'current_projects', 'expenses', 'orders','chart','pie_chart'));
                //}
            }
            if (Gate::allows('isAdmin')) 
            {
                //_________________ Completed Projects ___________________________________
                $status_id = DB::table('project_status')->where('name', '=', 'Completed')->pluck('id')->first();
                $completed_projects = DB::table('projects')->where('status_id', '=', $status_id)->count();
                //_________________ Current Projects ___________________________________
                $current_projects = DB::table('projects')->where('status_id', '!=', $status_id)->count();
                //_________________ Total Contractors ___________________________________
                $total_contractors = DB::table('users')->where('role_id', '=',3)->count();
                //_________________ Projects Expense History ___________________________________
                $expenses = DB::table('miscellaneous_expenses')
                    ->where('project_id', '!=', null)
                    ->sum('expense');
                //_________________ Total Customers ___________________________________
                $total_customers =  DB::table('customers')->count();
                //_________________ Total Labor ___________________________________
                $total_labor =  DB::table('labors')->count();
                //_________________ Company Expense ___________________________________
                $company_expense = DB::table('miscellaneous_expenses')
                    ->where('others', '=', 1)
                    ->sum('expense');
                //_________________ Company Balance ___________________________________
                $temp = 0;
                $material_profit = 0;
                $checking = DB::table('order_details')
                   ->select('order_details.quantity','order_details.set_rate','order_details.purchase_rate')
                   ->get();
                foreach($checking as $check)
                {
                    $temp = ($check->set_rate*$check->quantity) - ($check->purchase_rate*$check->quantity);
                    $material_profit = $temp + $material_profit;
                }
                //$company_balance = $material_profit - $company_expense;
              
//____________________________ ADD Customers payments left + matrial profit + profit from projects __________________________________________________
      

        //_________________ Profit From Projects ___________________________________
            
        $ProjectsProfit = 0;
        $ProjectsLoss =0;
        $ProjectsProfit_OR_Loss =0;
        $spent = 0;
        $ProjStatusID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
        $Comp_projects = DB::table('projects')->where('status_id','=',$ProjStatusID)->get();
       
        
    $total_labor_cost = 0;
       
       foreach ($Comp_projects as $proj)
        {
            $labors = DB::table('labors')->where('project_id', '=', $proj->id)->get()->all();
            foreach ($labors as $labor) 
            {
                $temp = DB::table('labor_attendances')
                ->where('labor_id','=',$labor->id)
                ->where('status','=',1)
                ->where('paid','=',1)
                ->count();
                $cost = $temp * $labor->rate;
                $total_labor_cost = $total_labor_cost + $cost;
            }
       }
       //dd($total_labor_cost);
        $all_projects = DB::table('projects')
        ->where('status_id','=',$ProjStatusID)
        ->where('project_balance','>=',0)
        ->sum('project_balance');
        $ProjectsProfit_OR_Loss = $all_projects - $total_labor_cost;
        //dd($ProjectsProfit);
        if($ProjectsProfit_OR_Loss > 0)
        {
            $ProjectsProfit = $ProjectsProfit_OR_Loss;
        }
        if($ProjectsProfit_OR_Loss < 0)
        {
            $ProjectsLoss = $ProjectsProfit_OR_Loss;
        }
 
        /*
        foreach ($all_projects as $project) 
        {
            $total_orders = DB::table('order_details')->where('order_details.project_id','=',$project->id)->get();
            $orders_sum = 0;
            $total = 0;
                foreach ($total_orders as $order)
                {
                    $total =  $order->set_rate * $order->quantity;
                    $orders_sum = $total + $orders_sum;
                }
            $expense = DB::table('miscellaneous_expenses')->where('miscellaneous_expenses.project_id','=',$project->id)->pluck('expense')->first();
            $projects = DB::table('projects')->where('id', '=', $project->id)->get()->first();
            $spent = $orders_sum + $expense;
            $ProjectsProfit = $projects->estimated_budget - $spent;
        }
        */
           // $received_payments = DB::table('customer_payments')->where('project_id','=',$id)->sum('received');
            $company_balance = DB::table('company_balance')->sum('balance'); 


                //_________________ Orders ___________________________________
                $orders = DB::table('order_details')->paginate(5);

                //____________________________Users Box__________________________________________________

                    // $total_free_contractors = DB::table('users')->where('id','=',3)->count();
                    // $working_contractors =

                    //_______________________________________________________________________________________
                $CompanyExpense = DB::table('miscellaneous_expenses')
                ->where('others', '=', 1)
                ->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))
                ->get();
                /*$expense = MiscellaneousExpense::where('project_id', '!=', null)where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();*/
                $chart = Charts::database($CompanyExpense, 'bar', 'highcharts')
                    ->title("Expense Details")
                    ->elementLabel("Company Expense")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByMonth(date('Y'), true);

                $pie_chart = Charts::create('pie', 'highcharts')
                    ->title('Company Income')
                    ->labels(['Projects', 'Material'])
                    ->values([$ProjectsProfit,$material_profit])
                    ->dimensions(1000, 500)
                    ->responsive(true);
                    //DB::table()->where('status_id','=',$status_id)->get()->count();

                    // dd($completed_projects);
                return view('home', compact('total_contractors', 'completed_projects', 'current_projects', 'expenses', 'orders', 'company_balance','company_expense','chart','pie_chart'));
            //}
        }
    }
    public function addcontractor()
    {
        return view('contractors/add_contractor')->with('success', 'New Contractor has been added');
    }

    public function addlabor()
    {
        return view('labors/add_labor');
    }

    public function addmanager()
    {
        return view('managers/add_manager');
    }

    public function addsupplier()
    {
        return view('suppliers/add_supplier');
    }

    public function starter()
    {
        return view('starter');
    }

    public function usermanagement()
    {
        return view('user_management');
    }


    public function profile()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        return view('profile');

    }


    public function updateImage(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);
        $user->name = Auth::user()->name;

        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);


        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')) . '-' . time();
            // Define folder path
            $folder = 'images/profile/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
            if(Auth::user()->profile_image != 'images/profile/default_user.png')
            {
                $this->deleteOne('public', Auth::user()->profile_image);
            } 
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
}
