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

<div class="box-body col-md-8 col-lg-offset-1">
<div class="box box-primary" style="padding-bottom: 85px;">
            <div class="box-header">
              <h2 class="text-center">Add User</h2>
            </div>

  <form method="post" action="{{ route('users.store') }}" style="max-width: 80%; margin-left: 10%;">
	 @csrf
                <div class="form-group">
                  <label for="user_name">User Name</label>
                  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name">
                </div>

                <div class="form-group">
                  <label for="user_email">User Email</label>
                  <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email">
                </div>  

                <div class="form-group">
                  <label for="user_pass">User Password</label>
                  <input type="text" class="form-control" id="user_pass" name="user_pass" placeholder="Password" 
                  >
                </div>   
                
                <div class="form-group">
                  <label for="user_cnic">User CNIC</label>
                  <input type="text" class="form-control" id="user_cnic" name="user_cnic" placeholder="User CNIC">
                </div>

                <div class="form-group">
                	<label for="user_phone_number">User Contact</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                </div>
                  <input type="text" class="form-control" placeholder="Contact Number" data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" data-mask="" id="user_phone_number" name="user_phone_number">
                </div>
                </div>

                <div class="form-group">
                  <label for="user_gender">Gender</label>
                  <input type="text" class="form-control" id="user_gender" name="user_gender" placeholder="Gender">
                </div>

                <div class="form-group">
                  <label for="user_age">Age</label>
                  <input type="text" class="form-control" id="user_age" name="user_age" placeholder="Age">
                </div>
                
                <div class="form-group">
                  <label for="user_address">Address</label>
                  <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Home Address">
                </div>

                <div class="form-group">
                  <label for="user_city">City</label>
                  <input type="text" class="form-control" id="user_city" name="user_city" placeholder="Home City">
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
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add User</button>
                     
                   </form>
                 </div>  
         </div>   


@stop