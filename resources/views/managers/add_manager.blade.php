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
            <h2 class="text-center">Add Manager</h2>
        </div>
        <div class="box-body">
            <form method="post" action="{{ route('managers.store') }}">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="form-group">
                        @csrf
                        <label for="man_name">Manager Name</label>
                        <input type="text" class="form-control" id="man_name" name="man_name"
                               placeholder="Manager Name">
                    </div>
                    <div class="form-group">
                        <label for="man_cnic">Manager CNIC</label>
                        <input type="text" class="form-control" id="man_cnic" name="man_cnic"
                               placeholder="Manager CNIC">
                    </div>
                    <div class="form-group">
                        <label for="man_contact">Manager Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="man_contact" name="man_contact">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="man_address">Address</label>
                        <input type="text" class="form-control" id="man_address" name="man_address"
                               placeholder="Home Address">
                    </div>
                    <div class="form-group">
                        <label for="man_city">City</label>
                        <input type="text" class="form-control" id="man_city" name="man_city" placeholder="Home City">
                    </div>


                    <div class="form-group">
                        <label for="man_picture">Upload Picture</label>
                        <input type="file" id="man_picture">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Manager</button>
                </div>
            </form>
        </div>
    </div>


@stop
