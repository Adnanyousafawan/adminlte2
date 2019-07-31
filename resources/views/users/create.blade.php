@extends('adminlte::page')
@can('isAdmin')
@section('title', 'Add User')
@endcan
@can('isManager')
@section('title', 'Add Contractor')
@endcan

@include('common')
@yield('meta_tags')

@section('content')
@yield('error_logs')
@yield('breadcrumbs')

    <div class="row">
        <div class="box-body col-md-8 col-md-offset-2">
            <div class="box box-primary" style="padding-bottom: 85px;">
                <div class="box-header">
                    @can('isAdmin')<h2 class="text-center">Add User</h2>@endcan
                    @can('isManager')<h2 class="text-center">Add Contractor</h2>@endcan

                </div>
 
                <form method="post" action="{{ route('users.store') }}" style="max-width: 80%; margin-left: 10%;">
                    @csrf
                   
                                                               <div class="form-group">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z0-9\w].{2,50}" title="Minimum 3 letters required for Name" placeholder="Name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Example : abc@mail.com" placeholder="Email" required="">
                    </div>

                    <div class="form-group">
                        <label for="cnic">CNIC <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" placeholder="CNIC" value="" id="cnic" name="cnic" onkeypress="return isNumber(event)" onpaste="return false;"
                        maxlength="13" pattern="[0-9].{12,13}"  title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number" value="" id="phone" name="phone" onkeypress="return isNumber(event)" onpaste="return false;" maxlength="11" pattern="[0-9].{10}" title="Enter 11 Digit Number. Example:(03330234334)" required>
                        </div> 
                    </div> 
  
                    <div class="form-group">
                        <label for="address">Address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" pattern="[A-Za-z0-9\w].{4,100}" 
                        title=" Minimum 4 letters required" 
                               placeholder="Home Address" required>
                    </div>

                    @can('isAdmin')
                    <div class="form-group">
                        <label for="role">Select Role <span style="color: red;">*</span></label>
                        <select class="form-control" id="role" name="role" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>        
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Add User</button>
                    @endcan
                     @can('isManager')
                      <div class="form-group">
                        <label for="role">Role<span style="color: red;">*</span></label>
                        <select class="form-control" id="role" name="role" required disabled="">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>  
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-bottom: 20px;">Add Contractor</button>
                    @endcan

                </form>
            </div>
        </div>
    </div>

@yield('datatable_stylesheets')
<script type="text/javascript">     
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ( (charCode > 31 && charCode < 48) || charCode > 57) {
        return false;
    }
        return true;
    }
</script>

@stop
