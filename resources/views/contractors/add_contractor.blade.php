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
            <h2 class="text-center">Add Contractor </h2>
        </div>
        <div class="box-body">
            <form method="post" action="{{ route('contractors.store') }}">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="form-group">
                        @csrf
                        <label for="cont_name">Contractor Name</label>
                        <input type="text" class="form-control" id="cont_name" placeholder="Contractor Name"
                               name="cont_name">
                    </div>
                    <div class="form-group">
                        <label for="cont_cnic">Contractor CNIC</label>
                        <input type="text" class="form-control" id="cont_cnic" placeholder="Contractor CNIC"
                               name="cont_cnic">
                    </div>
                    <div class="form-group">
                        <label for="cont_contact">Contractor Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="cont_contact" name="cont_contact">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cont_address">Home Address</label>
                        <input type="text" class="form-control" id="cont_address" name="cont_address"
                               placeholder="Home Address">
                    </div>
                    <div class="form-group">
                        <label for="cont_city">City</label>
                        <input type="text" class="form-control" id="cont_city" name="cont_city" placeholder="Home City">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder="Zip Code" id="zipcode"
                                       name="zipcode">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cont_picture">Upload Picture</label>
                        <input type="file" id="cont_picture">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Contractor</button>
                </div>
            </form>
        </div>
    </div>
@stop