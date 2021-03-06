@extends('adminlte::page')

@section('title', 'Material Requests')
@include('common')

@include('materialrequest.MaterialRequest_Table.material_request_datatable')

@yield('meta_tags')
<meta name="csrf-token" content="{{csrf_token()}}">
  {{-- <meta name="csrf-token" content="{{csrf_token()}}"> --}}
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

@section('content')
  @yield('error_logs')
    @yield('breadcrumbs')

        <div class="box-body" id="screen">
            <div class="box box-body" style=" background-color: #f4f4f487; padding: 2%;">
                <div class="box-header" >
                      <h1> Working in Tester </h1>

                     <div class="row" style="padding-left:14px; padding-right: 14px;">
                    <h3><span
                            class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                            style="margin-bottom: 10px; padding: 0px;">Material Requests</span></h3>
                    <div class="box-tools pull-right">
                        <a type="links" href="{{ route('order.create') }}" class="btn btn-primary pull-right">Place
                            Order</a>
                    </div>
                </div>
                   {{-- _________________________________All Material DataTable_____________________________________--}}
                        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"

                            style="padding: 0px; margin-left: 0px;">
                           
                            
                            <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                                <div class="box-header with-border ">
                                    <h4><span class="box-title col-md-8">Material Request Details</span></h4>
                                    <br>
                                     <div class="container">
                                <a class="active" href=" {{ route('requests.index') }}" style="font-size: 20px;">All
                                    &nbsp; | &nbsp; </a>
                                <a class="active" href=" {{ route('requests.approved') }}" style="font-size: 20px;">Approved
                                    &nbsp; | &nbsp; </a>
                                <a class="active" href=" {{ route('requests.rejected') }}" style="font-size: 20px;">Rejected
                                    &nbsp; | &nbsp;</a>
                                 <a class="active" href=" {{ route('requests.pending') }}"  style="font-size: 20px;">Pending</a> 
                            </div>
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
                                            <th style="max-width: 60px;">Action</th>
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
                                                <td>@if($materialrequest->seen==1)
                                                 
                                                   <div class="label label-success col-md-12">Seen</div>
                                                @endif
                                                @if($materialrequest->seen==0)
                                                 
                                                   <div class="label label-warning col-md-12">Not Seen</div>
                                                @endif
                                            </td>
                                                    <td>{{ $materialrequest->request_status_id }}</td>
                                                     <td style='max-width: 60px;'>
                                                   
                                                   {{--  <div class="btn-group">
                                                         <button class="btn btn-sm btn-success" type="button">Action</button> 
                                                     <button data-toggle="dropdown"
                                                               class="btn btn-success dropdown-toggle" type="button">
                                                        <span class="caret"></span>
                                                          <span class="sr-only">Toggle Dropdown</span>
                                                       </button>

                                                        <ul role="menu" class="dropdown-menu">
                                                           
                                                            <li><a type="links" data-toggle="modal" data-target="#EditModal-{{ $materialrequest->id }}"><i class="fa fa-edit"></i>Edit</a></li> 

                                                        
                                                            <li><a type="links" data-toggle="modal"
                                                                   data-target="#DeleteModal-{{ $materialrequest->id }}"> <i
                                                                        class="fa fa-remove"></i>Delete</a></li>
                                                        </ul>

                                                    </div> --}}

                                                     {{--  <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                                         style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>
 --}}
                                                      <a type="links" id="edit" name="edit" data-toggle="modal" data-target="#EditModal-{{ $materialrequest->id }}"
                                                         style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                                     {{--  <a type="links" data-toggle="modal" data-target="#DeleteModal-{{ $materialrequest->id }}"
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
                                                        <a type="links" href="" class=" glyphicon glyphicon-ok pull-right" style="color: green;"></a>
                                                    @endif

                                                </td>


                                                @endcan

                                            </tr>
 
        {{-- ______________________________EdiT  Modal ______________________________________________--}}

                                            <div id="EditModal-{{ $materialrequest->id }}" class="modal fade"
                                                 tabindex="-4" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; text-align: center;">
                                                    <div class="modal-content">
                                                            <form
                                                                action=" {{ route('requests.update', ['id' => $materialrequest->id]) }}"
                                                                method="POST" enctype="multipart/form-data" >
                                                                {{method_field('PATCH')}}                                                          
                                                                {{-- @method('PATCH') --}}
                                                                @csrf 
                                                                
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
                                                                    <label class="radio-inline"><input type="radio" name="radio" value="1" <?php if($materialrequest->request_status_id==1){echo "checked";}?>  >Approved</label>
                                                                    <label class="radio-inline"><input type="radio" name="radio" value="2" <?php if($materialrequest->request_status_id==2){echo "checked";}?>>Reject</label>
                                                                    <label class="radio-inline"><input type="radio" name="radio"  value="3" <?php if($materialrequest->request_status_id==3){echo "checked";}?>>Pending</label>
                                                                    </div>
                                                                     <input type="hidden" name="request_id" value="{{ $materialrequest->id }}">
            
                                                                    </div>
                                                                  {{-- <input type="hidden", name="requests_id" id="req_id"> --}}
                                                                 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="links" href="{{ route('requests.update',['id'=>$materialrequest->id]) }}"
                                                                            class="btn btn-primary">
                                                                        Save
                                                                    </button>
                                                                   
                                                                </div>
                                                    </form>
                                                 
                                                </div>
                                            </div>
                                            </div>


                                            {{-- ______________________________Delete Modal ______________________________________________--}}

                                           {{--  <div id="DeleteModal-{{ $materialrequest->id }}" class="modal fade"
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
 --}}
                                @endforeach
                                </tbody>
                                </table>
                            </div>

                </div>
            </div>
            </div>
        </div>

<h4 id="result"></h4>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){ 
  $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


 //  $('#edit').click(function() 
 //  {
 //   var bid = $(this).val(); // button ID 
 //   var trid = $(this).closest('tr').attr('id'); // table row ID 
 //   console.log(bid);
 // });
      $('input[type="radio"]').on('click',(function(){  
       // var id= document.getElementById("project_id").val(); 

            //console.log(id);
            var selval = $("[type='radio']:checked").val();  
            console.log(selval);
           $.ajax({  
                url:"materialrequest/test/"+selval,  
                method:"POST",  
                data:{selval:selval},  
                success:function(data){  
                     $('#result').html(data);  
                }  
           });  
      }));  
 });  

 </script>  

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
