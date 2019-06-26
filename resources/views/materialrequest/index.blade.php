@extends('adminlte::page')

@section('title', 'Material Requests')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    {{-- <link rel="stylesheet" href="/images"> --}}
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/jquery.dataTables.js"></script>


@section('content_header')
    <h1>Material Requests</h1>
@stop

@section('content')


    @if (session('status'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('status') }}
        </div>
    @endif
 
<ol class="breadcrumb">
  <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a></li>
  <?php $segments = ''; ?>
  @foreach(Request::segments() as $segment)
     <?php $segments .= '/'.$segment; ?>
      <li>
        <a href="{{ $segments }}">{{$segment}}</a>
      </li>
  @endforeach
</ol>

  

<div class="col-md-6">
    <div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">«</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">»</a></li>
                </ul>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->

              <ul class="todo-list ui-sortable">

                @foreach($materialrequests as $materialrequest)
                <li>
                  <!-- drag handle -->
                 {{--  <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
 --}}
                  <!-- checkbox -->
                  <input type="checkbox" <?php if($materialrequest->seen==1){echo "checked";}?>>
                  <!-- todo text -->
                  <span class="text">{{ $materialrequest->item_id }} is required at {{ $materialrequest->project_id }}</span>
                  <!-- Emphasis label -->
                  <p class="label label-danger pull-right"><i class="fa fa-clock-o"></i>{{ $materialrequest->instructions }}</p>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>
</div>



<div class="box-body" id="screen">
        <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
            <div class="box-header">
                <h3><span
                        class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                        style="margin-bottom: 10px; padding: 0px;">Material Requests</span></h3>
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
                class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
        
                style="padding: 5px;">
<div class="container">
    <a class="active" href=" {{ route('orders.list') }}" style="font-size: 20px;">Approved &nbsp; | &nbsp; </a> 
    <a class="active" href=" {{ route('orders.recieved') }}" style="font-size: 20px;">Rejected &nbsp; | &nbsp;</a>
    {{-- <a class="active" href=" {{ route('orders.cancelled') }}"  style="font-size: 20px;">Cancelled</a> --}}
  </div>

                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Material Request Details</span></h4>
                     
                    </div>

                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr>
                                <th>Project ID</th>
                                <th>Project ID</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>OR0000{{ $order->id }}</td>
                                    <td>{{ $order->project_id }}</td>
                                    <td>{{ $order->item_id }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>join price</td>
                                    <td>find total</td>
                                    <td>{{ $order->status }}</td>
                                   
                                    <td style="max-width: 50px;">
                                        
                    <div class="btn-group">

                    {{-- <button class="btn btn-success" type="button">Action</button> --}}
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <ul role="menu" class="dropdown-menu">
                      <li><a target="_blank" href="{{-- {{ route('users.view', ['id' => $user->id]) }} --}}"><i class="fa fa-edit"></i>View</a></li>
                       
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


{{-- ______________________________Delete Modal ______________________________________________--}}

                                <div id="applicantDeleteModal-{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center;">
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


@stop
