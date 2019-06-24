@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
    <div class="box box-primary">
        <div class="box-header">
            <h2 class="text-center">Update User</h2>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('users.update', ['id' => $users->id]) }}"
                  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                
                <div class="col-lg-8 col-lg-offset-2">

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ $users->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('name') }}</strong>                              
                      </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               value="{{ $users->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('email') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               value="{{ $users->password }}">
                        @if ($errors->has('password'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('password') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="cnic">User CNIC</label>
                        <input type="text" class="form-control" id="cnic" name="cnic"
                               value="{{ $users->cnic }}">
                        @if ($errors->has('cnic'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('cnic') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">User Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" value="{{ $users->phone }}"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="phone" name="phone">
                            @if ($errors->has('phone'))
                                <span class="help-block alert-danger">
                        <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                               value="{{ $users->address }}">
                        @if ($errors->has('address'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('address') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city"
                               value="{{ $users->city }}">
                        @if ($errors->has('city'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('city') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select class="form-control" id="role" name="role">
                            <option>Manager</option>
                            <option>Contractor</option>
                        </select>
                    </div>
                    {{--
                                <div class="form-group">
                                  <label for="profile_image">Upload Profile</label>
                                    <input type="file" class="form-control custom-file-input" id="profile_image" name="profile_image">
                                    </div>
                 --}}

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
