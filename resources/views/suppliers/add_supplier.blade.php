@extends('adminlte::page')
@section('title', 'Add Supplier')
@section('content')



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

{{-- <div class="row"> --}}
<div class="col-md-12 col-md-offset-0 col-xs-12 col-xs-offset-0  col-lg-12 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xl-12 col-xl-offset-0">

<div class="box" style="background-colors: #f4f4f487;">
    <div class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0  col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xl-8 col-xl-offset-2" style="margin-top: 40px;">


    <div class="box box-primary" style="padding-bottom: 20px;">
        <div class="box-header">
            <h2 class="text-center">Add Supplier</h2>
        </div>
        <div class="box-body">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 ">
                <form method="post" action="{{ route('suppliers.store') }}">
                    <div class="form-group">
                        @csrf
                        <label for="name">Supplier Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Supplier Name" name="name">
                    </div>
                   
                    <div class="form-group">
                        <label for="phone_number">Supplier Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Home Address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Home City" name="city">
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Supplier</button>
            </form>
            </div>
    
        </div>
    </div>
</div>
</div>

</div>



@stop
