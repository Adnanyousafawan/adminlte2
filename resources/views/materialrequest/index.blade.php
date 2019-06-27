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
 {{-- 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{csrf_token()}}"> --}}

        {{--    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
           <script src="/js/jquery-3.4.1.js"></script>
           --}}

@section('content_header')
    <h1>Material Requests</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('succes') }}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
    @endif


    <ol class="breadcrumb">
        <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a></li>
        <?php $segments = ''; ?>
        @foreach(Request::segments() as $segment)
            <?php $segments .= '/' . $segment; ?>
            <li>
                <a href="{{ $segments }}">{{$segment}}</a>
            </li>
        @endforeach
    </ol>


        <div class="box-body" id="screen">
            <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
                <div class="box-header">
                    <h3><span
                            class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                            style="margin-bottom: 10px; padding: 0px;">Material Requests</span></h3>
                    <div class="box-tools pull-right">
                        <a type="links" href="{{ route('order.create') }}" class="btn btn-primary pull-right">Place
                            Order</a>
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
                                <a class="active" href=" {{ route('requests.index') }}" style="font-size: 20px;">All
                                    &nbsp; | &nbsp; </a>
                                <a class="active" href=" {{ route('requests.approved') }}" style="font-size: 20px;">Approved
                                    &nbsp; | &nbsp; </a>
                                <a class="active" href=" {{ route('requests.rejected') }}" style="font-size: 20px;">Rejected
                                    &nbsp; | &nbsp;</a>
                                 <a class="active" href=" {{ route('requests.pending') }}"  style="font-size: 20px;">Pending</a> 
                            </div>

                            <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                                <div class="box-header with-border ">
                                    <h4><span class="box-title col-md-8">Material Request Details</span></h4>

                                </div>

                                <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                                    <table class="table no-margin table-bordered table-striped project">
                                        <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Project ID</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Requested by</th>
                                            <th>Instructions</th>
                                            @can('isAdmin')
                                            <th>Seen</th>
                                            <th>Status</th>
                                            @endcan
                                            <th>Action</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($materialrequests as $materialrequest)
                                            <tr>
                                                <td>MR0000{{ $materialrequest->id }}</td>
                                                <td>{{ $materialrequest->project_id }}</td>
                                                <td>{{ $materialrequest->item_id }}</td>
                                                <td>{{ $materialrequest->quantity }}</td>
                                                <td>{{ $materialrequest->requested_by }}</td>
                                                <td>{{  $materialrequest->instructions }}</td>
                                                @can('isAdmin')
                                                   
                                                    <td><input type="checkbox" <?php if($materialrequest->seen==1){echo "checked";}?> disabled></td>
                                                    <td>{{ $materialrequest->request_status_id }}</td>
                                                     <td style="max-width: 50px;">
                                                   
                                                    <div class="btn-group">
                                                     <button data-toggle="dropdown"--}}
                                                               class="btn btn-success dropdown-toggle" type="button">
                                                        <span class="caret"></span>
                                                          <span class="sr-only">Toggle Dropdown</span>
                                                       </button>

                                                        <ul role="menu" class="dropdown-menu">
                                                           
                                                            <li><a type="links" data-toggle="modal" data-target="#EditModal-{{ $materialrequest->id }}"><i class="fa fa-edit"></i>Edit</a></li> 

                                                          


                                                            <li><a type="links" data-toggle="modal"
                                                                   data-target="#applicantDeleteModal-{{ $materialrequest->id }}"> <i
                                                                        class="fa fa-remove"></i>Delete</a></li>
                                                        </ul>

                                                    </div>
                                                    {{--   <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                                         style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>

                                                      <a type="links" href="{{ route('projects.edit', ['id' => $project->id]) }}"
                                                         style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                                      <a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"
                                                         style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a> --}}

                                                </td>
                                                @endcan
                                                @can('isManager')
                                                <td>
                                                @if($materialrequest->request_status_id == 3)
                                                <form method="POST" id="actionform">
                                                
                                                    <a type="submit" id="reject" name="reject" class="glyphicon glyphicon-remove" style="color: red; margin-right: 10px"></a>
                                                    <a type="submit" name="accept" id="accept" class="glyphicon glyphicon-ok" style="color: green;" ></a>
                                                    </form>
                                                    @endif
                                                    @if($materialrequest->request_status_id == 2)
                                                        {{ $materialrequest->request_status_id  }}
                                                        <a type="links" href="" class=" glyphicon glyphicon-edit pull-right" style="color: red;"></a>
                                                    @endif
                                                      @if($materialrequest->request_status_id == 1)
                                                        {{ $materialrequest->request_status_id  }}
                                                        <a type="links" href="" class=" glyphicon glyphicon-ok pull-right" style="color: red;"></a>
                                                    @endif

                                                </td>


                                                @endcan

                                               
                                            </tr>
 
        {{-- ______________________________EdiT  Modal ______________________________________________--}}

                                            <div id="EditModal-{{ $materialrequest->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; text-align: center;">
                                                    <div class="modal-content">
                                                            <form
                                                                action=" {{ route('requests.update', ['id' => $materialrequest->id]) }}"
                                                                method="POST" >
                                                                {{ csrf_field() }}


                                                                {{-- {{ method_field('POST') }} --}}
                                                               
                                                             

                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Edit Material Request
                                                                        </h4>
                                                                </div>
                                                                <div class="row">
                                                                <div class="modal-body">
                                                                    <div class="col-md-10 col-md-offset-1 form-group ">
                                                                    <label class="form-control" for="project">Project:</label> 
                                                                    <p id="project">{{ $materialrequest->project_id }}</p>
                                                                      <label class="form-control" for="contractor">Contractor:</label> 
                                                                    <p id="contractor">{{ $materialrequest->requested_by }}</p>
                                                                      <label class="form-control" for="item">Item:</label> 
                                                                    <p id="item">{{ $materialrequest->item_id }}</p>
                                                                      <label class="form-control" for="quantity">Quantity:</label> 
                                                                    <p id="quantity">{{ $materialrequest->quantity }}</p>
                                                                      <label class="form-control" for="instructions">Instruction:</label> 
                                                                    <p id="instructions">{{ $materialrequest->instructions }}</p>
                                                                    
                                                                    </div>

                                                                     <div class="col-md-10 col-md-offset-1 form-group" style="margin-bottom: 20px;">
                                                                    <label class="radio-inline"><input type="radio" name="optradio" value="1" <?php if($materialrequest->request_status_id==1){echo "checked";}?>  >Approved</label>
                                                                    <label class="radio-inline"><input type="radio" name="optradio" value="2" <?php if($materialrequest->request_status_id==2){echo "checked";}?>>Reject</label>
                                                                    <label class="radio-inline"><input type="radio" name="optradio" value="3" <?php if($materialrequest->request_status_id==3){echo "checked";}?>>Pending</label>
                                                                    </div>
            
                                                                    </div>
                                                                  
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-primary">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                    </form>
                                                 
                                                </div>
                                            </div>
                                            </div>







                                            {{-- ______________________________Delete Modal ______________________________________________--}}

                                            <div id="applicantDeleteModal-{{ $materialrequest->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; text-align: center;">
                                                    <div class="modal-content">
                                                        <form class="row" method="POST"
                                                              action="{{ route('requests.destroy', ['id' => $materialrequest->id]) }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">
                                                            <form
                                                                action=" {{ route('requests.destroy', ['id' => $materialrequest->id]) }}"
                                                                method="POST" class="remove-record-model">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}

                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Delete Material Request
                                                                        </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong><b><h3>Are You Sure? <br>You Want Delete
                                                                                This Record?
                                                                            </h3></b></strong>
                                                                    <input type="hidden" , name="applicant_id"
                                                                           id="app_id">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger waves-effect remove-data-from-delete-form">
                                                                        Delete
                                                                    </button>
                                                                </div>

                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>


                {{--
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


                <div class="box-body">


                  <ul class="todo-list ui-sortable">

                    @foreach($materialrequests as $materialrequest)
                    <li>


                      <input type="checkbox" <?php if($materialrequest->seen==1){echo "checked";}?>>

                      <span class="text">{{ $materialrequest->item_id }} is required at {{ $materialrequest->project_id }}</span>

                      <p class="label label-danger pull-right"><i class="fa fa-clock-o"></i>{{ $materialrequest->instructions }}</p>

                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>

                <div class="box-footer clearfix no-border">
                  <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                </div>
              </div>
    </div>
     --}}

<h4 id="result"></h4>
<script type="text/javascript">





        $('.project').DataTable({
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



            //$(document).ready(function () {
     
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
             

            //   var $valu = '1';

            // $('#accept').click(function () {
               
            //     //insert = insert.toString();
            //     $.ajax({
            //         type: 'POST',
            //         url: 'materialrequest/insert',
            //         data: { value: $valu},
                
            //         //console.log("in ajax");
             
            //         success: function (data) {
            //             //console.log(data);
            //             if (data.error) {
            //                 $('#result').html(data);
            //             } else 
            //                 $('#result').html(data);
            //             }
            //         });
            //     });
            // });


        // });
    </script>

@stop
