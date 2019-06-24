@extends('adminlte::page')
@section('title', 'All Projects')
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
    <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i>  &nbsp;Dashboard</a></li>
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



<div class="col-md-offset-1 col-lg-offset-1 col-xl-offset-1">

<div class="container">
    <a class="active" href=" {{ route('projects.all') }}" style="font-size: 18px;">All &nbsp; | &nbsp; </a> 
    <a class="active" href=" {{ route('projects.current') }}" style="font-size: 18px;">Current Projects &nbsp; | &nbsp;</a>
    <a class="active" href=" {{ route('projects.completed') }}"  style="font-size: 18px;">Completed &nbsp; | &nbsp;</a>
     <a class="active" href=" {{ route('projects.pending') }}"  style="font-size: 18px;">Pending &nbsp; | &nbsp;</a>
    <a class="active" href=" {{ route('projects.cancelled') }}"  style="font-size: 18px;">Cancelled &nbsp; | &nbsp;</a>
  </div>
</div>
            {{-- _________________________________All Projects DataTable_____________________________________--}}
            <div
                class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                style="padding: 5px;">
                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Customers Record</span></h4>
                    
                    </div>
                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr>

                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Project ID</th>
                                <th>Project Title</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>CNIC</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($customers as $customer)
                                <tr>
                                    <td>CU0000{{ $customer->id }}</td>
                                    <td>{{ $customer->c_name }}</td>
                                    <td>Project id Here</td>
                                    <td>Project Title Here</td>
                                    <td>{{ $customer->phone}}</td>
                                    <td>{{ $customer->address}}</td>
                                    <td>{{ $customer->cnic}}</td>

                                    <td style="max-width: 50px;">
                                        
                    <div class="btn-group">

                    {{-- <button class="btn btn-success" type="button">Action</button> --}}
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <ul role="menu" class="dropdown-menu">
                      {{-- <li><a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"><i class="fa fa-edit"></i>View</a></li> --}}
                       
                        {{-- <li><a href="{{ route('projects.edit', ['id' => $projects->id]) }}"><i class="fa fa-edit"></i>Edit</a></li> --}}
                                             
                        {{-- <li><a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"><i class="fa fa-remove"></i>Delete</a></li> --}}
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
{{-- 
                                <div id="applicantDeleteModal-{{ $project->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('projects.destroy', ['id' => $project->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action="{{ route('projects.destroy', ['id' => $project->id]) }}"
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
                            @endforeach

                        </tbody> 

                    </table>

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

