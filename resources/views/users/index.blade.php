@extends('adminlte::page')
@can('isAdmin')
@section('title', 'Users')
@endcan
@can('isManager')
@section('title', 'Contractors')
@endcan
@include('common')
@yield('meta_tags')
@section('content')
@yield('error_logs')
@yield('breadcrumbs')

    <div class="row">

        <div class="box-body" id="screen"
        >
            <div class="box box-body" style=" background-color: #f4f4f487;">
                <div class="box-header">
                   @can('isAdmin') <h3><span
                            class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                            style="margin-bottom: 10px; margin-left: 15px;">User Details</span></h3>
                    @endcan
                     @can('isManager') <h3><span
                            class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                            style="margin-bottom: 10px; margin-left: 15px;">Contractor Details</span></h3>
                    @endcan


                </div>

                {{-- _________________________________All User DataTable_____________________________________--}}
                <div
                    class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                    style="padding-left: 3%; padding-right: 3%;">
                    <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                        <div class="box-header with-border ">
                            <div class="row" style="margin-left: 2px; margin-right: 2px;">
                           @can('isAdmin')<h4><span class="box-title col-md-8">User Record</span></h4>@endcan
                           @can('isManager')<h4><span class="box-title col-md-8">Contractor Record</span></h4>@endcan
                           <div class="box-tools pull-right">
                                <a type="links" {{-- href="{{ route('users.create') }}" --}}  data-toggle="modal"
                                   data-target="#applicantADDModal"  class="btn btn-primary pul-right">Add User</a>
                            </div>
                         
</div>
                <div style="margin-top: 10px;" 
                    class="container col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0 style=">
                    @can('isAdmin')
                        <a class="active" href=" {{ route('users.all') }}" style="font-size: 18px;">All &nbsp; |
                            &nbsp; </a>
                        <a class="active" href=" {{ route('users.manager') }}" style="font-size: 18px;">Managers &nbsp;
                            | &nbsp;</a>
                        <a class="active" href=" {{ route('users.contractor') }}" style="font-size: 18px;">Contractors
                            &nbsp; | &nbsp;</a>
                    @endcan
                </div>

                            
                        </div>

                        <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                            <table class="table no-margin table-bordered table-striped project">
                                <thead>
                                <tr>

                                    <th>Profile</th>
                                    @can('isAdmin')
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    @endcan
                                    @can('isManager')
                                    <th>ID</th>
                                    <th>Name</th>
                                    @endcan
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>CNIC</th>
                                    @can('isAdmin')
                                    <th>Role</th>
                                    @endcan
                                    @can('isManager')
                                    <th>Project ID</th>
                                    @endcan
                                    <th style="min-width: 60px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>Profile Image</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->address}}</td>
                                        <td>{{ $user->phone}}</td>
                                        <td>{{ $user->cnic}}</td>
                                        @can('isAdmin')
                                        <td>{{ $user->role_id }}</td>
                                        @endcan
                                        @can('isManager')
                                        <td>Project ID</td>
                                        @endcan

                                        <td style="min-width: 60px;">

                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-success" type="button">Action</button>
                                                <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
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
                                    @can('isAdmin')<strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                            User</h3></strong>
                                    @endcan
                                      @can('isManager')<strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                            Contractor</h3></strong>
                                    @endcan
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
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" id="name"
                                                                           name="name" placeholder="Name" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="text" class="form-control" id="email"
                                                                           name="email" placeholder="Email" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="cnic">CNIC</label>
                                                                    <input type="text" class="form-control" id="cnic"
                                                                           name="cnic" placeholder="CNIC" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="phone">Contact</label>
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
                                                                        @foreach($roles as $role)
                                                                            <option>{{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>                                                                        
                                                                <button type="submit"
                                                                        class="btn btn-block btn-primary btn-xs form-control"
                                                                        style="margin-top: 20px;">Add User
                                                                </button>
                                                                 @endcan
                                                                 @can('isManager')
                                                                 <button type="submit"
                                                                        class="btn btn-block btn-primary btn-xs form-control"
                                                                        style="margin-top: 20px;">Add Contractor
                                                                </button>
                                                                 @endcan
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

@yield('datatable_stylesheets')
@yield('datatable_script')
@stop

