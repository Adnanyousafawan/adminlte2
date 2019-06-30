@extends('adminlte::page')
@can('isAdmin')
@section('title', 'ADD User')
@endcan
@can('isManager')
@section('title', 'ADD Contractor')
@endcan

@include('common')
@yield('meta_tags')
@yield('datatable_stylesheets')

@section('content')
@yield('error_logs')
@yield('breadcrumbs')



    <div class="row">
        <div class="box-body col-md-8 col-md-offset-2">
            <div class="box box-primary" style="padding-bottom: 85px;">
                <div class="box-header">
                    @can('isAdmin')<h2 class="text-center">ADD User</h2>@endcan
                    @can('isManager')<h2 class="text-center">ADD Contractor</h2>@endcan

                </div>

                <form method="post" action="{{ route('users.store') }}" style="max-width: 80%; margin-left: 10%;">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z0-9\w]{4,20}" title="Minimum 4 letters required for Name" placeholder="User Name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Example : abc@mail.com" placeholder="Email">
                    </div>
{{-- 
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="Password" class="form-control" id="pass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password"
                        >
                    </div>
 --}}
                    <div class="form-group">
                        <label for="cnic">CNIC <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="cnic" name="cnic" placeholder="User CNIC">
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="number" maxlength="11" class="form-control" placeholder="Contact Number"
                                   pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Example:(03330416263)" 
                                   {{-- pattern="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" --}}
                                   data-mask="" id="phone" name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Home Address">
                    </div>
                    @can('isAdmin')
                    <div class="form-group">
                        <label for="role">Select Role <span style="color: red;">*</span></label>
                        <select class="form-control" id="role" name="role">
                            @foreach($roles as $role)
                                <option>{{ $role->name }}</option>
                                {{--  <option>Manager</option>
                                 <option>Contractor</option> --}}
                            @endforeach
                        </select>
                    </div>
                    @endcan
                 
                     @can('isAdmin')
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Add User</button>
                    @endcan
                     @can('isManager')
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Add Contractor</button>
                    @endcan

                </form>
            </div>
        </div>
    </div>


@stop
