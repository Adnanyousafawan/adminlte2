@extends('adminlte::page')
@section('title', 'Company Expenses')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    {{-- <link rel="stylesheet" href="/images"> --}}
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/jquery.dataTables.js"></script>
 
@section('content')

<ol class="breadcrumb">
    <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i> &nbsp;Home</a></li>
    <?php $segments = ''; ?>
    @foreach(Request::segments() as $segment)
        <?php $segments .= '/'.$segment; ?>
        <li>
            <a href="{{ $segments }}">{{$segment}}</a>
        </li>
    @endforeach
</ol>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

     @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif


<div class="box-body" id="screen">
        <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
            <div class="box-header">
                <h3><span
                        class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                        style="margin-bottom: 10px; padding: 0px;">Company Expense List</span></h3>
                        <div class="box-tools pull-right">
                            <a type="links" href="{{ route('expense.create') }}" class="btn btn-primary pul-right">Add Expense</a>
                        </div>
                    </div>


            {{-- _________________________________All Expenses DataTable_____________________________________--}}
            <div
                class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
        
                style="padding: 5px;">

                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Expenses Details</span></h4>
                     
                    </div>

                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr>
                                <th>Expense ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Expense Cost</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>Ex0000{{ $expense->id }}</td>
                                    <td>{{ $expense->name }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->expense }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expense->created_at)->format('Y-m-d') }}</td>
                                    <td >
                                        <a style="color: red;" type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $expense->id }}"><i class="fa fa-remove"></i>Delete</a>
                                        
                  {{--   <div class="btn-group">

                     <button class="btn btn-success" type="button">Action</button> 
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <ul role="menu" class="dropdown-menu">
                      <li><a type="links" data-toggle="modal" data-target="#EditModal-{{ $expense->id }}" ><i class="fa fa-edit"></i>Edit</a></li>
                       
                        <li></li>
                                          </ul>
                  </div> --}}
                                      {{--   <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                           style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>

                                        <a type="links" href="{{ route('projects.edit', ['id' => $project->id]) }}"
                                           style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                        <a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"
                                           style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a> --}}
 
                            </td>
                            </tr>

   {{-- ______________________________EdiT  Modal ______________________________________________--}}

                                            <div id="EditModal-{{ $expense->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; ">
                                                    <div class="modal-content">
                                                            <form
                                                                 action=" {{ route('company-expenses.update', ['id' => $expense->id]) }}"
                                                                method="POST" >
                                                                {{ csrf_field() }}
                                                         
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Edit Expense Details
                                                                    </h4>
                                                                </div> 
                                                                <div class="modal-body">
                                                                <div class="row">
                                                                <div class="col-md-10 col-md-offset-1 form-group ">
                                                                   

                                                                    <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" class="form-control" id="quantity" name="name" placeholder="Name" value="{{ $expense->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="description">Description</label>
                                                                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ $expense->description }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="expense">Expense</label>
                                                                            <input type="text" class="form-control" id="expense" name="expense" placeholder="Expense" value="{{ $expense->expense }}">
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

                                <div id="applicantDeleteModal-{{ $expense->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center; text-align: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('expenses.destroy', ['id' => $expense->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action=" {{ route('expenses.destroy', ['id' => $expense->id]) }}"
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

       
</script>

@stop

