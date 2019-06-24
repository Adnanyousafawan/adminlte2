@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
    @if ($errors->any())
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
                <h2 class="text-center">Add User</h2>
            </div>

            <form method="post" action="{{ route('users.store') }}" style="max-width: 80%; margin-left: 10%;">
                @csrf
                <div class="form-group">
                    <label for="name"> Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password"
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
                        <input type="text" class="form-control" placeholder="Phone Number"
                               data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                               data-mask="" id="phone" name="phone">
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="Age">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                           placeholder="Home Address">
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Home City">
                </div>

                <div class="form-group">
                    <label for="assigned_to">Select Role</label>
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
                <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add User</button>

            </form>
        </div>
    </div>
</div>


@stop
