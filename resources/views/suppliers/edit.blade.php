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
            <h2 class="text-center">Update Supplier</h2>
        </div>
        <div class="box-body">
            <div class="col-lg-8 col-lg-offset-2">
                <form method="POST" action="{{ route('suppliers.update',['id' => $suppliers->id]) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">

                        <label for="name">Supplier Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Supplier Name" name="name"
                               value="{{ $suppliers->name }}">
                    </div>
                    <div class="form-group">
                        <label for="inic">Supplier INIC</label>
                        <input type="text" class="form-control" id="inic" placeholder="Supplier INIC" name="inic"
                               value="{{ $suppliers->inic }}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Supplier Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="phone_number" name="phone_number"
                                   value="{{ $suppliers->phone_number }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Home Address" name="address"
                               value="{{ $suppliers->address }}">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Home City" name="city"
                               value="{{ $suppliers->city }}">
                    </div>

                    <div class="form-group">
                        <label>Select Material Type</label>
                        <select class="form-control" id="sup_material" name="material" name="material">
                            <option>Material 1</option>
                            <option>Material 2</option>
                            <option>Material 3</option>
                            <option>Material 4</option>
                            <option>Material 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Material Price</label>
                        <input type="text" class="form-control" id="price"
                               placeholder="Material Price(per single entity)" name="price"
                               value="{{ $suppliers->price }}">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Update Supplier</button>
            </div>
            </form>
        </div>
    </div>
@stop
