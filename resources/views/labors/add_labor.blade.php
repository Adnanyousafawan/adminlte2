@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <script src="/js/jquery-3.4.1.js"></script>
</head>
</html>



<ol class="breadcrumb">
    <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i>  &nbsp;Dashboard</a></li>
    <?php $segments = ''; ?>
    @foreach(Request::segments() as $segment)
        <?php $segments .= '/'.$segment; ?>
        <li>
            <a href="{{ $segments }}">{{$segment}}</a>
        </li>
    @endforeach
</ol>


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

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

     @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif



<div class="box" style="background-color: #f4f4f487;">

    <div class="row" style="margin-top: 30px;">
        <form method="post" action="{{ route('labors.store') }}" enctype="">
            @csrf
        
            <div class="box box-primary col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 col-lg-offset-1 col-lg-10 col-sm-10 col-sm-offset-1 col-xl-10 col-xl-offset-1"
                 style="padding-bottom: 30px; ">
                <div class="box-header">
                    <h2 class="text-center">Add Labor</h2>
                </div>
                <div class="box-body">

                    <div class="col-lg-9 col-lg-offset-2">
                        <div class="form-group">
                            @csrf

                            <label for="name">Labor Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Labor Name" name="name">

                        </div>
                        <div class="form-group">
                            <label for="cnic">Labor CNIC</label>
                            <input type="text" class="form-control" id="cnic" placeholder="Labor CNIC" name="cnic">
                        </div>
                        <div class="form-group">
                            <label for="phone">Labor Contact</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" maxlength="14" class="form-control" placeholder="Contact Number"
                                       data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                       data-mask="" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Labor Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Home Address"
                                   name="address">
                        </div>
                        <div class="form-group">
                            <label for="city">Labor City</label>
                            <input type="text" class="form-control" id="city" placeholder="Home City" name="city">
                        </div>
                        <div class="form-group">
                            <label for="rate">Labor Price</label>
                            <input type="text" class="form-control" id="rate" placeholder="Labor Rate(per Day)"
                                   name="rate">
                        </div>
                        <div class="form-group">
                            <label for="project_id">Project ID</label>
                            <input type="number" class="form-control" id="project_id" placeholder="Proect ID"
                                   name="project_id" required>
                        </div>


                        <button type="submit" class="btn btn-block btn-primary btn-xs form-control"
                                style="margin-top: 20px;">Add Labor
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@stop
