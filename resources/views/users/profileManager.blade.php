@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
</html>

 <div class="box-body col-md-10 col-lg-offset-1 " style="margin-top: 0px; padding: 0px; ">

  <div class="box box-primary" style=" background-color: white; ">
   <div class="row">
       <div class="col-md-3 col-lg-offset-2 " style="margin-top: 20px;">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <head><h4>Profile Picture</h4></head>
                <hr>
             <img class="profile-user-img img-responsive img-circle" style="min-width: 150px; min-height: 150px;">
              <hr>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;">
  Change Image
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>
    <div class="col-md-4" style="margin-top: 20px;">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h4 class="profile-username text-center">Manager Name</h4>
              <hr>



<!-- Button trigger modal -->
<a href="#" type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="links" style="float: right;">
                        Change Password
                        </a>
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Change Password
</button>
 --}}
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group">
                  <label for="user_pass">Current Password</label>
                  <input type="text" class="form-control" id="user_pass" name="user_pass" placeholder="Current Password" 
                  >
                </div>  
                 <div class="form-group">
                  <label for="user_pass">New Password</label>
                  <input type="text" class="form-control" id="user_pass" name="user_pass" placeholder="New Password" 
                  >
                </div>  
                 <div class="form-group">
                  <label for="user_pass">Confirm Password</label>
                  <input type="text" class="form-control" id="user_pass" name="user_pass" placeholder="Confirm Password" 
                  >
                </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

            <strong><i class="fa fa-book margin-r-5"></i>Manager Email</strong>
              <p class="text-muted float-right">
                ad@ad.com

              </p>
              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Manager Contact</strong>
              <p class="text-muted float-right">
                0433323232323
              </p>
              <hr>
              <strong><i class="fa fa-book margin-r-5"></i>Manager Address</strong>
              <p class="text-muted float-right">
                bunglowewhbjdngfcbhej rubidhdbhde
              </p>
              <hr>
  <strong><i class="fa fa-book"></i>Manager Details</strong>
               <div class="box-body">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>ID</b> <a class="pull-right">MM0035</a>
                </li>
                <li class="list-group-item">
                  <b>Gender</b> <a class="pull-right"> <span class="label label-danger">Male</span></a>
                </li>
                 <li class="list-group-item">
                  <b>CNIC</b><a class="pull-right">32320924567567</a>
                </li>
                
               <li class="list-group-item">
                  <b>Salary</b> <a class="pull-right">50,000</a>
                </li>
                 <li class="list-group-item">
                  <b>Projects Managed</b> <a class="pull-right">12</a>
                </li>
              </ul>
             <!-- /.box-body -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>
      </div>

    </div>
   


</div>
</div>





@stop