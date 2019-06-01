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
              <h2 class="text-center">Update Labor</h2>
            </div>
<div class="box-body">
  <form method="POST" action="{{ route('labors.update', ['id' => $labors->id]) }}" enctype="multipart/form-data">
  @method('PATCH')
  @csrf
  {{-- {{ method_field('PUT') }} --}}
	
  {{-- <input type="hidden" name="_method" value="PUT">  --}}
  <div class="col-lg-8 col-lg-offset-2">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                
                  <label for="name">Labor Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Name" value="{{ $labors->name }}" name="name">
                  @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>                              
                      </span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="cnic">Labor CNIC</label>
                  <input type="text" class="form-control" id="cnic" placeholder="Labor CNIC" value="{{ $labors->cnic }}" name="cnic">
                   @if ($errors->has('cnic'))
                      <span class="help-block">
                        <strong>{{ $errors->first('cnic') }}</strong>                              
                      </span>
                    @endif
                </div>

               <div class="form-group">
                	<label for="phone">Labor Contact</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Contact Number" value="{{ $labors->phone }}" data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" data-mask="" id="phone" name="phone">
                   @if ($errors->has('phone'))
                      <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>                              
                      </span>
                  @endif
                </div>

                </div>
                <div class="form-group">
                 <label for="address">Labor Address</label>
                <input type="text" class="form-control" id="address" placeholder="Home Address" value="{{ $labors->address }}" name="address">
                 @if ($errors->has('address'))
                      <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>                              
                      </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="city">Labor City</label>
                  <input type="text" class="form-control" id="city" placeholder="Home City" value="{{ $labors->city }}" name="city">
                   @if ($errors->has('city'))
                      <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>                              
                      </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="rate">Labor Rate</label>
                  <input type="text" class="form-control" id="rate" placeholder="Labor Rate(per Day)" value="{{ $labors->rate }}"name="rate">
                   @if ($errors->has('rate'))
                      <span class="help-block">
                        <strong>{{ $errors->first('rate') }}</strong>                              
                      </span>
                    @endif
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
</div>
@stop