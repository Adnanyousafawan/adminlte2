@extends('adminlte::page')
@section('title', 'Add Labor')
@include('common')
@section('content')
    @yield('meta_tags')
    @yield('error_logs')
    @yield('breadcrumbs')

    <div class="box" style="background-color: #f4f4f487;">
        <div class="row" style="margin-top: 30px;">
            <form method="post" action="{{ route('labors.store') }}" enctype="">
                @csrf
                <div
                    class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xl-8 col-xl-offset-2">
                    <div class="box box-primary"
                         style="padding-bottom: 30px;">
                        <div class="box-header">
                            <h2 class="text-center">Add Labor</h2>
                        </div>
                        <div class="box-body">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               pattern="[A-Za-z0-9\w].{2,50}" title="Minimum 3 letters required for Name"
                                               placeholder="Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="cnic">CNIC <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" placeholder="CNIC" value="" id="cnic" name="cnic" onkeypress="return isNumber(event)" onpaste="return false;" maxlength="13" pattern="[0-9].{12,13}"  title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               pattern="[A-Za-z0-9\w].{4,100}"
                                               title=" Minimum 5 letters required"
                                               placeholder="Home Address" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Contact <span style="color: red;">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Contact Number" value="" id="phone" name="phone" onkeypress="return isNumber(event)" onpaste="return false;" maxlength="11" pattern="[0-9].{10}" title="Enter 11 Digit Number. Example:(03330234334)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="city" placeholder="Home City"
                                               name="city" pattern="[A-Za-z0-9\w].{3,100}"
                                               title=" Minimum 4 letters required" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="rate">Labor Rate <span style="color: red;">*</span></label>
                                        <input  type="text" class="form-control" value="" id="rate"
                                               placeholder="Labor Rate(per Day)" name="rate" onkeypress="return isNumber(event)" onpaste="return false;" maxlength="11" pattern="[0-9].{2,10}" title=" Minimum 3 digit number required" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="project_id">Project ID<span style="color: red;">*</span></label>
                                        <select class="form-control" id="project_id" name="project_id" required>
                                          <option default>Select Project</option>
                                            @foreach($projects as $project)
                                                <option>{{ $project->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control"
                                            style="margin-top: 20px;">Add Labor
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@yield('datatable_stylesheets')
<script type="text/javascript">     
  function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if ( (charCode > 31 && charCode < 48) || charCode > 57) {
    return false;
    }
    return true;
  }
</script>

@stop
