@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')


    <div class="box box-primary" style="padding-bottom: 85px;">
        <div class="box-header">
            <h2 class="text-center">Update User</h2>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('users.update', ['id' => $users->id]) }}"
                  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                {{--  <input type="hidden" name="_method" value="PATCH">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                <div class="col-lg-8 col-lg-offset-2">

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="user_name">User Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name"
                               value="{{ $users->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('name') }}</strong>                              
                      </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="user_email">User Email</label>
                        <input type="text" class="form-control" id="user_email" name="user_email"
                               value="{{ $users->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('email') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_pass">User Password</label>
                        <input type="password" class="form-control" id="user_pass" name="user_pass"
                               value="{{ $users->password }}">
                        @if ($errors->has('password'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('password') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_cnic">User CNIC</label>
                        <input type="text" class="form-control" id="user_cnic" name="user_cnic"
                               value="{{ $users->cnic }}">
                        @if ($errors->has('cnic'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('cnic') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_phone_number">User Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" value="{{ $users->phone_number }}"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="user_phone_number" name="user_phone_number">
                            @if ($errors->has('phone_number'))
                                <span class="help-block alert-danger">
                        <strong>{{ $errors->first('phone_number') }}</strong>                              
                      </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_gender">Gender</label>
                        <input type="text" class="form-control" id="user_gender" name="user_gender"
                               value="{{ $users->gender }}">
                        @if ($errors->has('gender'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('gender') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_age">Age</label>
                        <input type="text" class="form-control" id="user_age" name="user_age" value="{{ $users->age}}">
                        @if ($errors->has('age'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('age') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_address">Address</label>
                        <input type="text" class="form-control" id="user_address" name="user_address"
                               value="{{ $users->address }}">
                        @if ($errors->has('addres'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('address') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_city">City</label>
                        <input type="text" class="form-control" id="user_city" name="user_city"
                               value="{{ $users->city }}">
                        @if ($errors->has('city'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('city') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="assigned_to">Select Role</label>
                        <select class="form-control" id="user_role" name="user_role">
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

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Update User</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop
