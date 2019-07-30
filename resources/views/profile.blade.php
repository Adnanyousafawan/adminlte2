@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Profile</h1>
@stop

@if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-success" role="alert">
        {{ session('error') }}
    </div>
@endif



@section('content') 

    @if (auth()->user()->profile)
        <img src="{{ asset('/storage'.auth()->user()->profile) }}"
             style="width: 80px; height: 80px; border-radius: 50%;" alt="{{ Auth::user()->name  }}'s profile picture"/>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row">
    


    <div class="col-md-8 col-sm-12 col-lg-8 col-xl-8 col-md-offset-2 col-lg-offset-2 col-xl-offset-2">

        <div class="box box-primary">
            <div class="box-body">
                <img class="profile-user-img img-responsive" src="/storage/{{ Auth::user()->profile_image }}"  alt="Project Image" style="min-width: 300px; min-height: 250px; max-width: 350px; max-height: 200px; margin-bottom: 50px; image-rendering: center; margin-top: 40px;">
                <hr>
               
                <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">

                       @if(Auth::user()->role_id == 1)
                        <div class="form-group">
                            <lable for="name">Name:</lable>
                            <input type="text" class="form-control disabled" name="name" id="name" value="{{ Auth::user()->name }}" disabled="">
                        </div>
                        @endcan
                         @if(Auth::user()->role_id == 2)
                    <form method="post" action="{{ route('user.name',['id' => Auth::user()->id]) }}" role="form" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <lable for="name">Name:</lable>
                            <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Name</button> 
                        </div>
                    </form>
                    @endcan

                    <form method="post" action="{{ route('profile.image') }}" role="form" enctype="multipart/form-data" >
                        @csrf
                     

                        <div class="form-group">
                            <lable for="email">Email:</lable>
                            <input type="email" class="form-control disabled" name="email" id="email" value="{{ Auth::user()->email }}"
                            disabled>
                        </div>

                        <div class="custom-file form-group">
                            <label class="profile_image " for="profileImage">Choose File</label>
                            <input type="file" class="form-control custom-file-input" id="profile_image" name="profile_image">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Upload Image">
                        </div>
                    </form>
                    <hr>
                    <form method="post" action="{{ route('user.changepassword',['id' => Auth::user()->id])}}" role="form" enctype="multipart/form-data" >
                        @csrf
                     <div class="form-group">
                            <lable for="old_password">Old Password:</lable>
                            <input type="Password" class="form-control disabled" name="old_password" id="old_password" value="">
                        </div>
                        <div class="form-group">
                            <lable for="new_password">New Password:</lable>
                            <input type="Password" class="form-control disabled" name="new_password" id="new_password" value="">
                        </div>
                         <div class="form-group">
                            <lable for="confirm_password">Confirm Password</lable>
                            <input type="Password" class="form-control disabled" name="confirm_password" id="confirm_password" value="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Change Password</button> 
                        </div>
</form>
                </div>


            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>


</div>



{{-- 

    <form method="post" action="{{ route('profile.image') }}" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <lable for="name">Name:</lable>
            <input type="text" class="form-control disabled" name="name" id="name" value="{{ Auth::user()->name }}">
        </div>
        <div class="form-group">
            <lable for="email">Name:</lable>
            <input type="email" class="form-control disabled" name="email" id="email" value="{{ Auth::user()->email }}"
                   disabled>
        </div>

        <div class="custom-file form-group">
            <label class="profile_image " for="profileImage">Choose file</label>
            <input type="file" class="form-control custom-file-input" id="profile_image" name="profile_image">
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Upload Image">
        </div>

    </form> --}}


@stop