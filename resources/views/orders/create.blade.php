@extends('adminlte::page')
@section('title', 'Order Material')
@section('content')
    <html> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{csrf_token()}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        {{--    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
           <script src="/js/jquery-3.4.1.js"></script>
           --}}
    </head>
    <body>
     @if (session('message'))

        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <ol class="breadcrumb">
        <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a></li>
        <?php $segments = ''; ?>
        @foreach(Request::segments() as $segment)
            <?php $segments .= '/' . $segment; ?>
            <li>
                <a href="{{ $segments }}">{{$segment}}</a>
            </li>
        @endforeach
    </ol>


    <div class="box box-primary">
        <br/>
        <h3 align="center">Order Material</h3>
        <br/>
        <div class="table-responsive">
            <form id="dynamic_form">
                @csrf
                @method('POST')
                <div class="col-md-10 col-xl-10 col-lg-10 col-sm-12 col-xs-12 col-md-offset-1 col-xl-offset-1 col-lg-offset-1 col-sm-offset-0 col-xs-offset-0 "
                     style="margin-bottom: 70px;">


                    <div class="row">
                        <div class="col-md-6 col-md-offset-0">
                            <div class="form-group">
                                <label for="project_id">Select Project</label>
                                <select class="form-control" id="project_id" name="project_id" required>
                                    <option>Select Project</option>
                                    @foreach($projects as $project)
                                        <option>{{ $project->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                                </div>
                            <div class="col-md-6 col-md-offset-0">
                            <div class="form-group">
                                <label for="project_id">Select Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control" required><option value="">Select Supplier</option>
                                    @foreach($suppliers['data'] as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach 
                            </select>
                            </div>
                        </div>
                    
                    </div>
                    <span id="result"></span>
                    <table class="table table-bordered table-striped" id="user_table">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quatity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2" align="right">&nbsp;</td>
                            <td>
                                {{-- @csrf --}}
                                <button type="submit" name="save" id="save" class="btn btn-primary" value="Save">Save
                                </button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </form>

        </div>
    </div>
    </body>
    </html>
{{-- @foreach($items as $item)<option>{{$item->name}}</option>@endforeach  --}}

    <script>

     $(document).ready(function () {
 
            var count = 1;
            var temp = 1;


            dynamic_field(count);

            function dynamic_field(number) {
                html = '<tr>'; 
          console.log(temp);
                html += '<td><select id="item_id'+temp+'" name="item_id[]" class="form-control"><option value="0">Select Item</option></select></td>';
                
                html += '<td><input type="text" class="form-control" placeholder="Quantity" value="" onkeypress="return isNumber(event)" onpaste="return false;" maxlength="11" pattern="[0-9].{0,10}" title="Enter quantity minimum 1" name="quantity[]"/></td>';
                //html += '<td><input type="text" name="status[]" class="form-control"/></td>';

                if (number > 1) {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                } else {
                    html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                    $('tbody').html(html);
                }
            }

            $(document).on('click', '#add', function () {
                count++;
                temp++;
                dynamic_field(count);

            });

            $(document).on('click', '.remove', function () {
                count--;
               temp--;
                
                $(this).closest("tr").remove();
                 
            });

            // $('#dynamic_form').on('submit', function(event){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#save').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'orderdetails/insert',
                    data: $('#dynamic_form').serialize(),
                    datatype: 'json',
                    success: function (data) {
                        //console.log(data);
                        if (data.error) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {

                                error_html += '<p>' + data.error[count] + '</p>';
                                //console.log('ERRORRRR');
                            }
                            $('#result').html('<div class="alert alert-danger"; >' + error_html + '</div>');
                        } else {
                            dynamic_field(1);
                            // console.log(data);

                            $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
                        }
                        $('#save').attr('disabled', false);
                    }
                });
            });
//         });
// $(document).ready(function(){

      
      $('#supplier_id').click(function()
      {
        var t = "#item_id"+temp;

         var id = $(this).val();
         $(t).find('option').not(':first').remove();
  //dd('ajax');
         // AJAX request 
         $.ajax({

           url: 'getItems/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){


             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }
           
                if(len > 0){
                var dropdown = '<select id="'+t+'" name="'+t+'">';

                $(t).append(dropdown);
                var option1 = "<option value='"+t+"'>"+t+"</option>"; 
                 //window.alert("id " +option);
                
                // $(t).append(option1); 
               for(var i=0; i<len; i++){
                 // console.log(temp);
               // for (var j = 0; j <=temp; i++) 
                //{
                  
                var id = response['data'][i]['id'];
                 var name = response['data'][i]['name'];


                 var option = "<option value='"+id+"'>"+name+"</option>"; 
                 //window.alert("id " +option);
                
                $(t).append(option); 
                }
                 var dropdownclose = '</select>';
                 $(t).append(dropdownclose);
                 temp++;
                 
               }
                  // }
             

           }
        });
      });

    });
        // });
 
{{-- </script> <script type='text/javascript'> --}}

    </script>
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
{{--<input type="text" name="item_id[]" class="form-control"/> <select name="item_id[]" class="form-control">@foreach($items as $item)<option>{{$item->name}}</option>@endforeach </select>  --}}

   {{--   html += '<td><select name="supplier_id[]" id="supplier_id" class="form-control" required><option value="0">Select Supplier</option>@foreach($suppliers['data'] as $supplier)<option value="{{$supplier->id}}">{{ $supplier->name }}</option>@endforeach </select></td>'; --}}