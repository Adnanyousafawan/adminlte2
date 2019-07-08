@extends('adminlte::page')
@section('title', 'AdminLTE')
@include('common')
@yield('meta_tags')
@yield('datatable_stylesheets')


   {{--  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css"> --}}
    {{-- <link rel="stylesheet" href="/images"> --}}
   {{--  <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/jquery.dataTables.js"></script>
  --}}
@section('content')
@yield('bootstrap_jquery')
@yield('error_logs')
@yield('breadcrumbs')


<div class="box-body" id="screen">
        <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
            <div class="box-header">
                <h3><span
                        class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                        style="margin-bottom: 10px; padding: 0px;">Order List</span></h3>
                        <div class="box-tools pull-right">
                            <a type="links" href="{{ route('order.create') }}" class="btn btn-primary pul-right">Place Order</a>
                        </div>
<div class="vendor-list-status">
  <div class="row">
      <div class="btn-group">
                     
  </div>
</div>
          
            {{-- _________________________________All User DataTable_____________________________________--}}
            <div
                class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
        
                style="padding: 5px;">


                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Order Details</span></h4>
                        <br><br>
                        <div class="container">
    <a class="active" href=" {{ route('orders.list') }}" style="font-size: 20px;">All &nbsp; | &nbsp; </a> 
    <a class="active" href=" {{ route('orders.recieved') }}" style="font-size: 20px;">Recieved &nbsp; | &nbsp;</a>
    <a class="active" href=" {{ route('orders.cancelled') }}"  style="font-size: 20px;">Cancelled &nbsp; | &nbsp;</a>
    <a class="active" href=" {{ route('orders.pending') }}"  style="font-size: 20px;">Pending</a>

  </div>
                     
                    </div>

                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr>
                                <th>Order ID</th>
                                <th>Project ID</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>0000{{ $order->id }}</td>
                                    <td>0000{{ $order->project_id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->supplier_name }}</td>
                                    <td>{{ $order->selling_rate }}</td>
                                    <?php $Total = $order->selling_rate * $order->quantity  ?>
                                    <td>{{ $Total }}</td>
                                    <td>{{ $order->status }}</td>
                                   
                                    <td style="max-width: 50px;">
                                        
                    <div class="btn-group">

                    <button data-toggle="dropdown" class="btn btn-success btn-sm" type="button">Action</button>
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <ul role="menu" class="dropdown-menu">
                      <li><a type="links" data-toggle="modal" data-target="#EditModal-{{ $order->id }}"><i class="fa fa-edit"></i>Edit</a></li>
                      <li><a type="links" data-toggle="modal" data-target="#CancelModal-{{ $order->id }}"><i class="fa fa-edit"></i>Cancel</a></li>
                       
                        {{-- <li><a href="{{ route('users.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i>Edit</a></li> --}}
                                             
                        <li><a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $order->id }}"><i class="fa fa-remove"></i>Delete</a></li>
                                          </ul>

                  </div>
                                      {{--   <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                           style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>

                                        <a type="links" href="{{ route('projects.edit', ['id' => $project->id]) }}"
                                           style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                        <a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"
                                           style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a> --}}

                            </td>
                            </tr>


   {{-- ______________________________EdiT  Modal ______________________________________________--}}

                                            <div id="EditModal-{{ $order->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; ">
                                                    <div class="modal-content">
                                                            <form
                                                                 action=" {{ route('orders.update', ['id' => $order->id]) }}"
                                                                method="POST" >
                                                                {{ csrf_field() }}


                                                                {{-- {{ method_field('POST') }} --}}
                                                               
                                                             

                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Edit Order Details
                                                                    </h4>
                                                                </div>
                                                                <div class="row">
                                                                <div class="modal-body">
                                                                    <div class="col-md-10 col-md-offset-1 form-group ">
                                                                         <div class="form-group">
                                                                            <label for="project_id">Projects</label>
                                                                            <select class="form-control" id="project_id" name="project_id">
                                                                                <option value="">{{ DB::table('Projects')->where('id','=',$order->project_id)->pluck('title')->first() }}</option>
                                                                                @foreach($projects as $project)
                                                                                <option>{{ $project->title }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="item_id">Items</label>
                                                                            <select class="form-control" id="item_id" name="item_id">
                                                                                <option value="">{{-- {{ DB::table('items')->where('id','=',$order->item_id)->pluck('name')->first() }} --}}{{ $order->name }} </option>
                                                                                @foreach($items as $item)
                                                                                <option>{{ $item->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="supplier_id">Supplier</label>
                                                                            <select class="form-control" id="supplier_id" name="supplier_id">
                                                                                <option value="">{{-- {{ DB::table('suppliers')->where('id','=',$order->supplier_id)->pluck('name')->first() }} --}} {{ $order->supplier_name }}</option>
                                                                                @foreach($suppliers as $supplier)
                                                                                <option>{{ $supplier->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label for="quantity">Quantity</label>
                                                                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{ $order->quantity }}">
                                                                        </div>

                                                                    </div>

            
                                                                    </div>
                                                                  
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="save"
                                                                            class="btn btn-primary">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                    </form>
                                                 
                                                </div>
                                            </div>
                                            </div>
{{--__________________________________________Cancel Model _______________________________________  --}}

                                        <div id="CancelModal-{{ $order->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; text-align: center;">
                                                    <div class="modal-content">
                                                            <form
                                                                 action=" {{ route('orders.cancelorder', ['id' => $order->id]) }}"
                                                                method="POST" >
                                                                {{ csrf_field() }}

                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Cancel Order
                                                                    </h4>
                                                                </div>
                                                                <div class="row">
                                                                <div class="modal-body">
                                                                    <strong><b><h3>Are You Sure? <br>You Want Cancel This Order?
                                                                    </h3></b></strong>
                                                                    <input type="hidden" , name="cancel_order" id="cancel_order">


                                                                    </div>

            
                                                                    </div>
                                                                  
                                                             
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="save"
                                                                            class="btn btn-primary">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                    </form>
                                                 
                                                </div>
                                            </div>
                                            </div>

  {{--                                           
  <div id="applicantDeleteModal-{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center; text-align: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('orders.destroy', ['id' => $order->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action=" {{ route('orders.destroy', ['id' => $order->id]) }}"
                                                      method="POST" class="remove-record-model">
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
                                            </form>
                                                    </div>
                                        </div>
                                    </div>
  --}}


{{-- ______________________________Delete Modal ______________________________________________--}}

                                <div id="applicantDeleteModal-{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center; text-align: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('orders.destroy', ['id' => $order->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action=" {{ route('orders.destroy', ['id' => $order->id]) }}"
                                                      method="POST" class="remove-record-model">
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

            </div>
        </div>
<script type="text/javascript">


        $('.project').DataTable({
            select: true,
            "order": [[0, "dsc"]],
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

