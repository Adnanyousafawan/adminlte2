@extends('adminlte::page')
@section('title', 'AdminLTE')
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




<div class="row">
<div class="col-md-12 col-md-offset-0 col-xs-12 col-xs-offset-0  col-lg-12 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xl-12 col-xl-offset-0">

<div class="box" style="background-colors: #f4f4f487;">

    <div class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0  col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xl-8 col-xl-offset-2" style="margin-top: 40px;">


    <div class="box box-primary" style="padding-bottom: 40px;">
        <div class="box-header">
            <h2 class="text-center">Update Supplier</h2>
        </div>
        <div class="box-body">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 ">
                <form method="post" action="{{ route('suppliers.update',['id' => $suppliers->id]) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Supplier Name" name="name" pattern="[A-Za-z0-9\w].{2,50}" title="Minimum 2 letters required for Name" value="{{ $suppliers->name }}" required>
                         @if ($errors->has('name'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('name') }}</strong>                              
                      </span>
                        @endif
                    </div>
                   
                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone">Contact <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number" maxlength="11" 
                                    pattern="[0-9].{10}" title="Enter 11 Digit Number. Example:(03330234334)" 
                                  id="phone" name="phone"  value="{{ $suppliers->phone }}" required>
                                   @if ($errors->has('phone'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('phone') }}</strong>                              
                      </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address">Address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="address" placeholder="Home Address" name="address" pattern="[A-Za-z0-9\w].{4,100}" 
                        title=" Minimum 4 letters required"  value="{{ $suppliers->address }}" required>
                         @if ($errors->has('address'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('address') }}</strong>                              
                      </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city">City <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="city" placeholder="Home City" name="city" value="{{ $suppliers->city }}" pattern="[A-Za-z0-9\w].{4,100}" 
                        title=" Minimum 4 letters required" required>
                         @if ($errors->has('city'))
                            <span class="help-block alert-danger">
                        <strong>{{ $errors->first('ciity') }}</strong>                              
                      </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Update Supplier</button>
            </form>
            </div>
    
        </div>
    </div>
</div>
</div>

</div>
</div>
@stop
