@extends('adminlte::page')
@section('title', 'AdminLTE')
@include('common')
@yield('meta_tags')
@yield('datatable_stylesheets')

@section('content')
@yield('bootstrap_jquery')
@yield('error_logs')
@yield('breadcrumbs')


<div class="box-body" id="screen">
        <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
            <div class="box-header">
                <h3><span
                        class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                        style="margin-bottom: 10px; padding: 0px;">Items List</span></h3>
                        <div class="box-tools pull-right">
                            <a type="links" href="{{ route('item.create') }}" class="btn btn-primary pul-right">Add New Items</a>
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
                        <h4><span class="box-title col-md-8">Item Details</span></h4>
             
                     
                    </div>

                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr> 
                                <th>Item ID</th>                             
                                <th>Item Name</th>
                                <th>Supplier</th>
                                <th>Purchase Price</th>    
                                <th>Selling Price</th>                              
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($items as $item)
                                <tr>
                                    <td>0000{{ $item->id }}</td>                              
                                    <td>{{ $item->name }}</td>
                                    <td>{{  $item->supplier_name  }}</td>
                                    <td>{{  $item->purchase_rate }}</td>
                                    <td>{{  $item->selling_rate }}</td>
                                    <td>{{  $item->unit }}</td>
                                    <td style="max-width: 50px;">
                                        
                    <div class="btn-group">

                    <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" type="button">Action <span class="glyphicon glyphicon-triangle-bottom"></button> 
                    {{-- <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle " type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button> --}}

                    <ul role="menu" class="dropdown-menu">
                      <li><a type="links" data-toggle="modal" data-target="#EditModal-{{ $item->id }}"><i class="fa fa-edit"></i>Edit</a></li>
                       
                        {{-- <li><a href="{{ route('users.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i>Edit</a></li> --}}
                                             
                        <li><a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $item->id }}"><i class="fa fa-remove"></i>Delete</a></li>
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

                                            <div id="EditModal-{{ $item->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; ">
                                                    <div class="modal-content">
                                                            <form
                                                                 action=" {{ route('items.update', ['id' => $item->id]) }}"
                                                                method="POST" >
                                                                {{ csrf_field() }}
                                                                 {{ method_field('POST') }}
                                                               
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Edit Item Details
                                                                    </h4>
                                                                </div>
                                                                <div class="row">
                                                                <div class="modal-body">
                                                                    <div class="col-md-10 col-md-offset-1 form-group ">
                                                                        <div class="form-group">
                                                                            <label for="item_name">Item Name</label>
                                                                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Name" value="{{ $item->name }}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="supplier_id">Supplier</label>
                                                                            <select class="form-control" id="supplier_id" name="supplier_id">
                                                                                <option value="{{ $item->supplier_id }}">{{ $item->supplier_name }}</option>
                                                                                @foreach($suppliers as $supplier)
                                                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label for="purchase_rate">Purchase Rate</label>
                                                                            <input type="text" class="form-control" id="purchase_rate" name="purchase_rate" placeholder="Purchase Rate" value="{{ $item->purchase_rate }}">
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label for="selling_rate">Selling Rate</label>
                                                                            <input type="text" class="form-control" id="selling_rate" name="selling_rate" placeholder="Selling Rate" value="{{ $item->selling_rate }}">
                                                                        </div>
                                                                        
                                                                         <div class="form-group">
                                                                            <label for="unit">Unit</label>
                                                                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" value="{{ $item->unit }}">
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




{{-- ______________________________Delete Modal ______________________________________________--}}

                                <div id="applicantDeleteModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center; text-align: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('items.destroy', ['id' => $item->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action=" {{ route('items.destroy', ['id' => $item->id]) }}"
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
         @yield('datatable_stylesheets')
    @yield('datatable_script')
{{-- <script type="text/javascript">
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

       
</script> --}}

@stop

