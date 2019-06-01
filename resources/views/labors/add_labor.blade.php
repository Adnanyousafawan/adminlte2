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

    <div class="box box-primary" style="padding-bottom: 85px;">
        <div class="box-header">
            <h2 class="text-center">Add Labor</h2>
        </div>
        <div class="box-body">
            <form method="post" action="{{ route('labors.store') }}">
                <div class="col-lg-8 col-lg-offset-2">
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
                            <input type="text" class="form-control" placeholder="Contact Number"
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
                        <label for="picture">Upload Picture</label>
                        <input type="file" id="picture" name="picture">
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Labor</button>
                </div>
            </form>
        </div>
    </div>
@stop