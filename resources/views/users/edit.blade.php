@extends('adminlte::page')
@section('title', 'AdminLTE')

@section('content')

    @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
 
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
                    @can('isAdmin')
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
                    @endcan

                    <div class="form-group">
                        <label for="cnic">CNIC</label>
                        <input type="text" class="form-control" id="cnic" name="cnic"
                               value="{{ $users->cnic }}">
                        @if ($errors->has('cnic'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('cnic') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact</label>
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

                    @can('isAdmin')
                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select class="form-control" id="role" name="role" value="{{ $current_role }}">
                                @foreach($roles as $role)
                                <option>
                                {{ $role->name }}
                                 </option>
                                @endforeach
                        </select>
                    </div>
                    @endcan
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
                </div>
            </form>
        </div>
    </div>
</div>
@stop
