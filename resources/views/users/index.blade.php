@extends('adminlte::page')
@section('title', 'AdminLTE')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
<link rel="stylesheet" href="/css/jquery.dataTables.css">
<link rel="stylesheet" href="/css/jquery.dataTables.css">
{{-- <link rel="stylesheet" href="/images"> --}}
<script src="/js/jquery-3.4.1.js"></script>
<script src="/js/jquery.dataTables.js"></script>

@section('content')

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

    @if (session('status'))
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session('message'))
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        <div class="alert alert-danger" role="alert">
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

    <div class="row">


        <div class="box-body" id="screen"
        >
            <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
                <div class="box-header">
                    <h3><span
                            class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                            style="margin-bottom: 10px; padding: 0px;">User Details</span></h3>


                </div>

                <div
                    class="container col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1">
                    @can('isAdmin')
                        <a class="active" href=" {{ route('users.all') }}" style="font-size: 18px;">All &nbsp; |
                            &nbsp; </a>
                        <a class="active" href=" {{ route('users.manager') }}" style="font-size: 18px;">Managers &nbsp;
                            | &nbsp;</a>
                        <a class="active" href=" {{ route('users.contractor') }}" style="font-size: 18px;">Contractors
                            &nbsp; | &nbsp;</a>
                    @endcan

                </div>


                {{-- _________________________________All User DataTable_____________________________________--}}
                <div
                    class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                    style="padding: 5px;">
                    <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                        <div class="box-header with-border ">
                            <h4><span class="box-title col-md-8">User Record</span></h4>
                            <div class="box-tools pull-right">
                                <a type="links" href="{{ route('users.create') }}"  {{-- data-toggle="modal"
                                   data-target="#applicantADDModal"  --}}class="btn btn-primary pul-right">Add User</a>
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                            <table class="table no-margin table-bordered table-striped project">
                                <thead>
                                <tr>

                                    <th>Profile</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>CNIC</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>Us0000{{ $user->id }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->address}}</td>
                                        <td>{{ $user->phone}}</td>
                                        <td>{{ $user->cnic}}</td>
                                        <td>{{ $user->role_id }}</td>

                                        <td style="max-width: 50px;">

                                            <div class="btn-group">

                                                {{-- <button class="btn btn-success" type="button">Action</button> --}}
                                                <button data-toggle="dropdown" class="btn btn-success dropdown-toggle"
                                                        type="button">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>

                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a target="_blank"
                                                           href="{{-- {{ route('users.view', ['id' => $user->id]) }} --}}"><i
                                                                class="fa fa-edit"></i>View</a></li>

                                                    <li><a href="{{ route('users.edit', ['id' => $user->id]) }}"><i
                                                                class="fa fa-edit"></i>Edit</a></li>

                                                    <li><a type="links" data-toggle="modal"
                                                           data-target="#applicantDeleteModal-{{ $user->id }}"><i
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
                                    </tr>


                                    {{-- ______________________________Delete Modal ______________________________________________--}}

                                    <div id="applicantDeleteModal-{{ $user->id }}" class="modal fade" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                         style="display: none;">
                                        <div class="modal-dialog"
                                             style="min-width:40%; align-content: center;  text-align: center;">
                                            <div class="modal-content">
                                                <form class="row" method="POST"
                                                      action="{{ route('users.destroy', ['id' => $user->id]) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}"
                                                          method="POST" class="remove-record-model">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">×
                                                            </button>
                                                            <h4 class="modal-title text-center"
                                                                id="custom-width-modalLabel">Delete User Record</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong><b><h3>Are You Sure? <br>You Want Delete This
                                                                        Record?
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


                {{-- _______________________________________Model Add New User______________________________--}}

                <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="min-width:70%; align-content: center;">
                        <div class="modal-content">

                            <form method="post" action="{{ route('users.store') }}" enctype="">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close pull-right" data-dismiss="modal"
                                            aria-hidden="true">x
                                    </button>
                                    <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                            User</h3></strong>
                                </div>

                                <div class="modal-body">

                                    <div style=" width: 100%;">

                                        <div class="row" style="margin-top: 5px;">
                                            

                                            <div
                                                class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2{{-- col-sm-10 col-xs-offset-1 col-sm-offset-0 col-xs-10 col-lg-8 col-xl-8 --}} "
                                                style="/*max-width: 70%;*/ padding-bottom: 30px;">
                                                <div>

                                                    <div class="box-body">

                                                        <div class="col-lg-9 col-lg-offset-2">
                                                            <div class="form-group">

                                                                <div class="form-group">
                                                                    <label for="name">User Name</label>
                                                                    <input type="text" class="form-control" id="name"
                                                                           name="name" placeholder="User Name" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="email">User Email</label>
                                                                    <input type="text" class="form-control" id="email"
                                                                           name="email" placeholder="Email" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="cnic">User CNIC</label>
                                                                    <input type="text" class="form-control" id="cnic"
                                                                           name="cnic" placeholder="User CNIC" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="phone">User Contact</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-phone"></i>
                                                                        </div>
                                                                        <input type="Number" class="form-control"
                                                                               placeholder="Contact Number"
                                                                               data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                                                               data-mask="" id="phone" name="phone"
                                                                               required>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="address">Address</label>
                                                                    <input type="text" class="form-control"
                                                                           id="user_address" name="address"
                                                                           placeholder="Home Address" required>
                                                                </div>
                                                                @can('isAdmin')
                                                                <div class="form-group">
                                                                    <label for="role">Select Role</label>
                                                                    <select class="form-control" id="role" name="role">
                                                                       {{--  @foreach($roles as $role)
                                                                            <option>{{ $role->name }}</option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>
                                                                @endcan
                                                                @can('isManager')
                                                                <div class="form-group">
                                                                    <label for="role">Select Role</label>
                                                                    <select class="form-control" id="role" name="role">
                                                                       {{--  @foreach($roles as $role)
                                                                            <option>{{ $role->name }}</option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>
                                                                @endcan
                                                                <button type="submit"
                                                                        class="btn btn-block btn-primary btn-xs form-control"
                                                                        style="margin-top: 20px;">Add User
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
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

