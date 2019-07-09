@extends('adminlte::page')
@section('title', 'AdminLTE')
@include('materialrequest.MaterialRequest_Table.material_request_datatable')
@include('common')

@section('content')

    {{--  @yield('bootstrap_jquery') --}}
    @yield('error_logs')
    @yield('breadcrumbs')


    <div class="box-body" style="margin-top: 0px; padding: 0px;">
        <div class="box box-primary" style=" background-color: #f4f4f487; ">
            <div class="row" style="padding: 12px;">
                <div class="row">
                    <div
                        class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1  "
                        style="padding: 0px;">
                        <div class="col-xs-12 col-md-3 col-sm-4 col-lg-4 col-xl-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Spent</h2>
                                    <span class="info-box-number label label-warning pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ $spent }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>

                        <div class="col-xs-12 col-md-4 col-sm-4 col-lg-4 col-xl-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Budget Left</h2>
                                    <span class="info-box-number label label-danger pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ $balance }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>
                    {{-- {{     dd($data) }}  --}}
                    <!-- /.col -->
                        <div class="col-xs-12 col-md-3 col-sm-4 col-lg-4 col-xl-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Total Budget</h2>
                                    <span class="info-box-number label label-success pull-right"
                                          style="margin-top: 0px; font-size: 16px;"> {{ $projects->estimated_budget }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>

                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4 col-md-offset-1 col-sm-6 col-lg-4 col-lg-offset-1">

                        <div class="box box-primary">
                            <div class="box-body {{-- box-profile --}}">
                                {{--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="Project Image">
                    --}}
                                <?php
                                //dd($projects);
                                ?>
                                <h3 class="profile-username text-center"> {{$projects->title }}  </h3>
                                <p class="text-muted text-center"> {{ $projects->area }}  </p>
                                <b><p class="text-muted text-center"> {{ $projects->city }}  </p></b>
                                <hr>
                                <strong><i class="fa fa-book margin-r-5"></i>Customer Name</strong>
                                <p class="text-muted float-right">
                                    {{ $customers->name }}
                                </p>
                                <strong><i class="fa fa-book margin-r-5"></i>Customer Contact</strong>
                                <b><p class="text-muted float-right">
                                        {{ $customers->phone }}
                                    </p>

                                    <strong><i class="fa fa-book"></i>Project Details</strong>
                                    <div class="box-body">

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Size</b> <a class="pull-right"> <span
                                                        class="label label-danger"> {{ $projects->plot_size }}   </span></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Number of Floors</b> <a
                                                    class="pull-right">  {{ $projects->floor}}   </a>
                                            </li>

                                            <li class="list-group-item">
                                                <b>Completion Time</b> <a
                                                    class="pull-right"> {{ $projects->estimated_completion_time }}   </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Assigned To</b> <a
                                                    class="pull-right">  {{ $contractors->name }}  </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Contact</b> <a class="pull-right"> {{ $contractors->phone }}  </a>
                                            </li>
                                        </ul>
                                        <!-- /.box-body -->
                                        <strong><i class="fa fa-file-text-o "></i> {{ $projects->description }}</strong>

                                        <p></p>
                                    </div>

                                    <a href="{{ route('projects.edit', ['id' => $projects->id]) }}"
                                       class="btn btn-primary btn-block"><b>Edit</b></a>
                                </b>
                            </div>
                        </div>
                    </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <div class="row" style="margin-top: 3%;">
            <div class="col-md-6"> 
               {!! $percentage_chart->html() !!}
            </div>

             <div class="col-md-6"> 
               {!! $percentage_chart_budget->html() !!}
            </div>
         </div>
     </div>

                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-3 col-xl-12" style="margin-top: 2%;">

                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Received</h2>
                                    <span class="info-box-number label label-warning pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ $received_payments }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>
{{-- 
                        <div class="col-xs-12 col-md-3 col-sm-4 col-lg-2 col-xl-12" style="margin-top: 2%;">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Balance</h2>
                                    <span class="info-box-number label label-danger pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ $balance }}</span>
                                </div>
                              
                            </div>
                         --}}
                 
                    <!-- /.col -->
                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-3 col-xl-12" style="margin-top: 2%;">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Receivable</h2>
                                    <span class="info-box-number label label-success pull-right"
                                          style="margin-top: 0px; font-size: 16px;"> {{ $projects->estimated_budget }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>

          

             
                    <div class="col-md-6 col-lg-6 col-sm-12" style="margin-top: 2%;">
                        <div class="box box-primary" style="">
                            <div class="box-header with-border">
                                <h3 class="box-title">About Project</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Number of Workers</b> <a class="pull-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Current Phase</b> <a class="pull-right">5</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Project Status</b> <a class="pull-right">In Progress</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Floor Number</b> <a class="pull-right">2</a>
                                    </li>

                                </ul>
                            </div> <!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>

      </div>
<div class="row">

<div class="col-md-10 col-md-offset-1" style="padding: 1%;">
    <div class="panel panel-primary" >

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
         </div>

        </div>
      </div>
   
  


    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
    {!! $pie_chart->script() !!}
    {!! $percentage_chart->script() !!}
{!! $percentage_chart_budget->script() !!}

</div>
                    <div class="col-md-6 col-md-offset-1 col-sm-12 col-sm-offset-0 col-lg-6 col-lg-offset-1">
                        <div class="box box-primary" style="margin-bottom: 10px;">
                            <div class="box-header with-border">
                                <h3 class="box-title">Material Requests</h3>

                                <div class="box-tools pull-right">
                                    <a href="{{ route('order.create')}}"
                                       class="btn btn-sm btn-primary btn-flat pull-left">Place
                                        Order</a>


                                    {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                 class="fa fa-minus"></i>
                                     </button> --}}
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                                    <table class="table no-margin table-bordered table-striped project">
                                        <thead>
                                        <tr>
                                            <th>Request ID</th>

                                            <th>Item Name</th>
                                            <th>Quantity</th>

                                            <th>Instructions</th>
                                            @can('isAdmin')
                                                <th>Seen</th>
                                            @endcan
                                            <th>Status</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($materialrequests as $materialrequest)
                                            <tr>
                                                <td>MR0000{{ $materialrequest->id }}</td>

                                                <td>{{ $materialrequest->item_name }}</td>
                                                <td>{{ $materialrequest->quantity }}</td>

                                                <td>{{ $materialrequest->instructions }}</td>
                                                @can('isAdmin')
                                                    <td>@if($materialrequest->seen==1)

                                                            <div class="label label-success col-md-12">Seen</div>
                                                        @endif
                                                        @if($materialrequest->seen==0)

                                                            <div class="label label-warning col-md-12">Not Seen</div>
                                                        @endif
                                                    </td>
                                                @endcan
                                                <td>{{ $materialrequest->status_name }}</td>


                                            </tr>


                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">

                                <a href="{{ route('requests.pending')}}"
                                   class="btn btn-sm btn-primary btn-flat pull-right">View All
                                    Requests</a>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">
                                            Showing {{ count($materialrequests) }} of {{ $total_pending_requests }}
                                            Pending Requests

                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            {{--  {{ $projects->links() }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>

                    <div class="col-md-4 col-md-offset-0 col-sm-12 col-lg-4 col-lg-offset-0">
                        <div class="box box-primary" style="margin-bottom: 10px;">
                            <div class="box-header with-border">
                                <h3 class="box-title">Orders Details</h3>

                                <div class="box-tools pull-right">
                                    {{--  <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-left">Place New Order</a> --}}


                                    {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                 class="fa fa-minus"></i>
                                     </button> --}}
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
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td><a href="#">OR{{ $order->id }}</a></td>

                                                <td>{{ $order->item_id }}</td>
                                                <td>{{ $order->quantity}}</td>
                                                <td>{{ $order->status }}</td>
                                                <td><span
                                                        class="label label-success col-md-10">{{ $order->status }}</span>
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

                                <a href="{{ route('orders.projectorders',['id' => $projects->id ]) }}"
                                   class="btn btn-sm btn-default btn-flat pull-right">View All
                                    Orders</a>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">
                                            Showing 1
                                            to {{count($orders)}} of {{ $total_orders_count }} entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            {{--  {{ $projects->links() }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>


                </div>


                <div style="padding: 0px 2px;"
                     class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                    {{--   style="padding: 5px;" --}} >
                    <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                        <div class="box-header with-border ">
                            <h4><span class="box-title col-md-8">Labor Record</span></h4>
                            <div class="box-tools pull-right">
                                <a type="links" {{-- href="{{ route('labors.create') }}" --}}  data-toggle="modal"
                                   data-target="#applicantADDModal" class="btn btn-primary pul-right">Add Labor</a>
                            </div>
                        </div>
                        <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                            <table class="table no-margin table-bordered table-striped labor">
                                <thead>
                                <tr>

                                    <th>Labor ID</th>
                                    <th>Name</th>
                                    <th>Project Id</th>
                                    <th>Present</th>
                                    <th>Labor Rate</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($labors as $labor)
                                    <tr>
                                        <td>lb0000{{ $labor->id }}</td>
                                        <td>{{ $labor->name }}</td>
                                        <td>PR0000{{ $labor->project_id}}</td>
                                        <td>23</td>
                                        <td>{{ $labor->rate }}</td>
                                        <td>25000</td>

                                        <td> 

                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-success btn-sm" type="button">Action</button>
                                                <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle"
                                                        type="button">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>

                                                <ul role="menu" class="dropdown-menu">

                                                    <li><a href="{{ route('labors.edit', ['id' => $labor->id]) }}"><i
                                                                class="fa fa-edit"></i>Edit</a></li>

                                                    <li><a type="links" data-toggle="modal"
                                                           data-target="#applicantDeleteModal-{{ $labor->id }}"><i
                                                                class="fa fa-remove"></i>Delete</a></li>
                                                </ul>

                                            </div>

                                        </td>
                                    </tr>

                                    <div id="applicantDeleteModal-{{ $labor->id }}" class="modal fade" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                         style="display: none;">
                                        <div class="modal-dialog"
                                             style="min-width:40%; align-content: center; text-align: center;">
                                            <div class="modal-content">
                                                <form class="row" method="POST"
                                                      action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    {{-- <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}"
                                                          method="POST" class="remove-record-model"> --}}
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                        <h4 class="modal-title text-center"
                                                            id="custom-width-modalLabel">Delete Applicant Record</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong><b><h3>Are You Sure? <br>You Want Delete This Record?
                                                                </h3></b></strong>
                                                        <input type="hidden" , name="applicant_id" id="app_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-danger waves-effect remove-data-from-delete-form">
                                                            Delete
                                                        </button>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                {{--____________________________   This is ADD MODAL CODE  ______________________________ --}}


                <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="min-width:70%; align-content: center;">
                        <div class="modal-content">

                            <form method="post" action="{{ route('labors.store') }}" enctype="">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close pull-right" data-dismiss="modal"
                                            aria-hidden="true">x
                                    </button>
                                    <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                            Labor</h3></strong>
                                </div>
                                <div class="modal-body">

                                    <div style=" width: 100%;">

                                        <div class="row" style="margin-top: 5px; margin-left: 1%;">

                                            <div class="box-body">

                                                <div
                                                    class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xl-10 col-xl-offset-2 ">
                                                    <div class="form-group">


                                                        <label for="name">Labor Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                               placeholder="Labor Name" name="name">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cnic">Labor CNIC</label>
                                                        <input type="text" class="form-control" id="cnic"
                                                               placeholder="Labor CNIC" name="cnic">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Labor Contact</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                            <input type="text" maxlength="14"
                                                                   class="form-control"

                                                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                                                   data-mask="" id="phone" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Labor Address</label>
                                                        <input type="text" class="form-control" id="address"
                                                               placeholder="Home Address"
                                                               name="address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">Labor City</label>
                                                        <input type="text" class="form-control" id="city"
                                                               placeholder="Home City" name="city">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="rate">Labor Price</label>
                                                        <input type="text" class="form-control" id="rate"
                                                               placeholder="Labor Rate(per Day)"
                                                               name="rate">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_id">Project ID</label>
                                                        <select class="form-control" id="project_id" name="project_id">
                                                            <option> {{ $projects->title }} </option>
                                                        </select>
                                                    </div>

                                                    <button type="submit"
                                                            class="btn btn-block btn-primary btn-xs form-control"
                                                            style="margin-top: 20px;">Add Labor
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @yield('datatable_stylesheets')
    <script type="text/javascript">

        $('.labor').DataTable({
            select: true,
            "order": [[0, "asc"]],
            //"scrollY"  : "380px",
            "scrollCollapse": true,
            "paging": true,
            "bProcessing": true,
            // fixedHeader: {
            //     header: false,
            //     // headerOffset: 100,
            //     },
            //scrollX: true,
            // scrollY: true
        });

    </script>

@stop
