@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@include('common')
   @can('isAdmin') <h1> Admin Dashboard</h1> @endcan
   @can('isManager') <h1> Manager Dashboard</h1> @endcan
   @yield('datatable_stylesheets') 
@stop
@section('content')
@yield('meta_tags')
@yield('error_logs')
@yield('breadcrumbs')

 

<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $current_projects }}</h3>

              <p>Current Projects</p> 
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('projects.inprogress') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3> {{ $completed_projects }}</h3>

              <p>Completed Projects</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square"></i>
                {{-- ion ion-stats-bars --}} 
            </div>
            <a href="{{ route('projects.completed') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $total_contractors }}</h3> 

              <p>Total Contrators</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('users.contractor') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $expenses }}</h3> 

              <p>Expenses History</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('expenses.list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    
  
@can('isAdmin')
<div class="row">
        
        <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cloud-download-outline"></i></span>
                <!-- ion ion-ios-gear-outline -->

                <div class="info-box-content">
                    <span class="info-box-text">Company Balance</span>
                    <span class="info-box-number">{{ $company_balance }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div> 
        <!-- /.col --> 

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Customers</span>
                    <span class="info-box-number">{{ DB::table('customers')->count('id') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div> 
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Labor</span>
                    <span class="info-box-number">{{ DB::table('labors')->count('id') }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Company Expenses</span>
                    <span class="info-box-number">{{$company_expense}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    
        <div class="panel panel-primary">

         <div class="panel-heading">Charts</div>

          <div class="panel-body">    
            <div class="row">
            <div class="col-md-6"> 
               {!! $chart->html() !!}
            </div>

            <br/><br/>

            <div class="col-md-6">  
               {!! $pie_chart->html() !!}
            </div>
            {{-- 

            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $line_chart->html() !!}
            </div>

            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $areaspline_chart->html() !!}
            </div>

            <br/><br/>
            

            <div class="col-md-6"> 
               {!! $geo_chart->html() !!}
            </div>

            <br/><br/>
            

            <div class="col-md-6"> 
               {!! $area_chart->html() !!}
            </div>

            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $donut_chart->html() !!}
            </div>


            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $percentage_chart->html() !!}
            </div>

 --}}
         </div>

        </div>
      </div>
   
  


    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
     {!! $pie_chart->script() !!}
{{-- 
   

    {!! $line_chart->script() !!}

    {!! $areaspline_chart->script() !!}

    {!! $percentage_chart->script() !!}

    {!! $geo_chart->script() !!}

    {!! $area_chart->script() !!}

    {!! $donut_chart->script() !!} --}}

    <!-- TABLE: LATEST ORDERS -->
    @endcan
<div class="row">

<div class="col-md-6">

     <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Orders Details</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Project ID</th>
                            </tr>
                            </thead>
                            <tbody>
                           
                               @foreach($orders as $order)
                                 <tr>
                                  <td><a href=" ">OR1000{{ $order->id }}</a></td>
                                  <td>{{ $order->item_id }}</td>
                                  <td>{{ $order->quantity }}</td>

                                  <td><span class="label label-success col-md-8">{{ $order->status }}</span></td>
                                  <td><a href="{{ route('projects.view', ['id' => $order->project_id]) }}" data-height="20">PR000{{ $order->project_id }}</a>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('order.create')}}" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                    <a href="{{route('orders.list')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div> 
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>


<div class="col-md-4">
<div class="box box-solid">
      <div class="box-header with-border">
        @can('isAdmin')
        <h3 class="box-title"><i class="fa fa-users dashbord-icon-color" aria-hidden="true"></i> &nbsp; Users</h3>
        @endcan
         @can('isManager')
        <h3 class="box-title"><i class="fa fa-users dashbord-icon-color" aria-hidden="true"></i> &nbsp; Contractors</h3>
        @endcan


        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            @can('isManager')
            <h5>Contractors</h5><hr>
            @endcan
             @can('isAdmin')
            <h5>Users</h5><hr>
            @endcan

            <div class="vendor-info-count">
              <ul>
                @can('isAdmin')
                 <li><i class="fa fa-users"></i>&nbsp;&nbsp; <a href="{{ route('users.all') }}">{{  DB::table('users')->count('id') }} &nbsp;&nbsp;Total User</a></li>
          
                 <li><i class="fa fa-users"></i>&nbsp;&nbsp; <a href="{{ route('users.manager') }}">{{  DB::table('users')->where('role_id','=','2')->count() }} &nbsp;&nbsp;Total Managers</a></li>
                @endcan
                
                <li><i class="fa fa-users"></i>&nbsp;&nbsp; <a href="{{route('users.contractor') }}">{{  DB::table('users')->where('role_id','=','3')->count() }} &nbsp;&nbsp;Total Contrators</a></li>
                <li><i class="fa fa-check"></i>&nbsp;&nbsp; <a href="{{route('users.contractor') }}">{{  DB::table('users')->where('role_id','=','3')->count() }} &nbsp;&nbsp;Working Contractors</a></li>
                <li><i class="fa fa-close"></i>&nbsp;&nbsp; <a href="{{route('users.contractor') }}"> &nbsp;&nbsp;Free Contractors</a></li>

                
              </ul>
            </div>
          </div>
         
        </div>
      </div>
    </div>
</div>
</div>  
  
@stop

 