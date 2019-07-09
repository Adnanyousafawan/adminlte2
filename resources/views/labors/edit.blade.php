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


<div class="box" style="background-color: #f4f4f487;">

    <div class="row" style="margin-top: 30px;">
        
        <form method="POST" action="{{ route('labors.update', ['id' => $labors->id]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
        
            <div class="box box-primary col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1  col-lg-10 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xl-10 col-xl-offset-1"
                 style="padding-bottom: 40px;">
                <div class="box-header">
                    <h2 class="text-center">Update Labor</h2>
                </div>
                <div class="box-body">
                    <div class="col-lg-9 col-lg-offset-2">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name">Labor Name  <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Name"
                             pattern="[A-Za-z0-9\w]{2,50}" title="Minimum 2 letters required for Name"
                                   value="{{ $labors->name }}" name="name" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>                              
                      </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cnic') ? ' has-error' : '' }}">

                            <label for="cnic">Labor CNIC  <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="cnic" placeholder="Labor CNIC"
                                   value="{{ $labors->cnic }}" name="cnic" maxlength="13" pattern="[0-9]{13}"title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )" required>

                            @if ($errors->has('cnic'))
                                <span class="help-block">
                        <strong>{{ $errors->first('cnic') }}</strong>                              
                      </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone">Labor Contact  <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>

                                <input type="text" class="form-control" placeholder="Contact Number"
                                    value="{{ $labors->phone }}" maxlength="11" 
                                    pattern="[0-9]{11}"
                                    title="Enter 11 Digit Number. Example:(03330234334)" id="phone" name="phone">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>                              
                      </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">

                            <label for="address">Labor Address  <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="address" placeholder="Home Address"
                                   value="{{ $labors->address }}" name="address"  pattern="[A-Za-z0-9\w]{4,100}"
                                               title=" Minimum 4 letters required" required> 
                            @if ($errors->has('address'))
                                <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>                              
                      </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">

                            <label for="city">Labor City  <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="city" placeholder="Home City"
                                   value="{{ $labors->city }}" name="city" pattern="[A-Za-z0-9\w]{4,100}"
                                               title=" Minimum 4 letters required" required>
                            @if ($errors->has('city'))
                                 <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>                              
                      </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('rate') ? ' has-error' : '' }}">
                            <label for="rate">Labor Rate  <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="rate" placeholder="Labor Rate(per Day)"
                                   value="{{ $labors->rate }}" name="rate" pattern="[0-9]{3,100}"
                                               title=" Minimum 3 digit number required" required>
                            @if ($errors->has('rate'))
                                <span class="help-block">
                        <strong>{{ $errors->first('rate') }}</strong>                              
                      </span>
                            @endif
                        </div>


                        <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Labor</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


@stop
