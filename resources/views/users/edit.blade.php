@extends('adminlte::page')
@can('isAdmin')
@section('title', 'Update User')
@endcan
@can('isManager')
@section('title', 'Update Contractor')
@endcan
@include('common')

@section('content')
{{-- @yield('error_logs') --}} 
 @if (session('success'))
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
@yield('breadcrumbs')
 
<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
    <div class="box box-primary">
        <div class="box-header">
            @can('isAdmin')<h2 class="text-center">Update User</h2>@endcan
            @can('isManager')<h2 class="text-center">Update Contractor</h2>@endcan 
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('users.update', ['id' => $users->id]) }}"
                  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" class= "form-control" id="name" name="name"pattern="[A-Za-z0-9\w]{2,50}" title="Minimum 2 letters required for Name" 
                               value="{{ $users->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('name') }}</strong>                              
                      </span>
                        @endif
 
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Example : abc@mail.com"
                               value="{{ $users->email }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('email') }}</strong>                              
                      </span>
                        @endif
                    </div>
                    @can('isAdmin')
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password <span style="color: red;">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                               value="{{ $users->password }}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        @if ($errors->has('password'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('password') }}</strong>                              
                      </span>
                        @endif
                    </div>
                    @endcan

                    <div class="form-group {{ $errors->has('cnic') ? ' has-error' : '' }}">
                        <label for="cnic">CNIC <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="cnic" name="cnic"  maxlength="13"  pattern="[0-9]{13}"
                               value="{{ $users->cnic }}" title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )" required>
                        @if ($errors->has('cnic'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('cnic') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone">Contact <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" maxlength="11" class="form-control" value="{{ $users->phone }}"
                                   id="phone" pattern="[0-9]{11}" title="Enter 11 Digit Number. Example:(03330234334)" 
                                    name="phone" required>
                            @if ($errors->has('phone'))
                                <span class="help-block alert-danger">
                        <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address">Address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="address" name="address"
                               value="{{ $users->address }}" pattern="[A-Za-z0-9\w]{4,100}" 
                        title=" Minimum 4 letters required" required>
                        @if ($errors->has('address'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('address') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    @can('isAdmin')
                    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                        <label for="role">Select Role <span style="color: red;">*</span></label>
                        <select class="form-control" id="role" name="role" value="{{ $current_role }}">
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">
                                {{ $role->name }}
                                 </option>
                                @endforeach
                        </select>
                    </div>
                    @endcan
                    @can('isAdmin')
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Update User</button>
                    @endcan
                     @can('isManager')
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Update Contractor</button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@stop
