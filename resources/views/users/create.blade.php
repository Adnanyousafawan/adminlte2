@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
    @if ($errors->any())
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif

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
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="text" class="form-control" id="pass" name="pass" placeholder="Password"
                        >
                    </div>

                    <div class="form-group">
                        <label for="cnic">CNIC</label>
                        <input type="text" class="form-control" id="cnic" name="cnic" placeholder="User CNIC">
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="phone" name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                               placeholder="Home Address">
                    </div>

                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select class="form-control" id="role" name="role">
                            @foreach($roles as $role)
                                <option>{{ $role->name }}</option>
                                {{--  <option>Manager</option>
                                 <option>Contractor</option> --}}
                            @endforeach
                        </select>
                    </div>
                    {{--
                                <div class="form-group">
                                  <label for="profile_image">Upload Profile</label>
                                    <input type="file" class="form-control custom-file-input" id="profile_image" name="profile_image">
                                    </div>
                 --}}
                     @can('isAdmin')
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Update User</button>
                    @endcan
                     @can('isManager')
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Update Contractor</button>
                    @endcan

                </form>
            </div>
        </div>
    </div>


@stop
