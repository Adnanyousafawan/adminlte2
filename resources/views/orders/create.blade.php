@extends('adminlte::page')
@section('title', 'Order Material')
@section('content')
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <meta  name="csrf-token" content="{{csrf_token()}}">

 {{--    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <script src="/js/jquery-3.4.1.js"></script>
    --}}
  </head>
  <body>

   @if (session('status'))
   <div class="alert alert-success" role="alert">
    {{ session('status') }}
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

  

<div class="box box-primary">
   <br />
   <h3 align="center">Order Material</h3>
   <br />
   <div class="table-responsive">
    <form id="dynamic_form">
      @csrf
      @method('POST')
        <div class="col-md-10 col-xl-10 col-lg-10 col-sm-12 col-xs-12 col-md-offset-1 col-xl-offset-1 col-lg-offset-1 col-sm-offset-0 col-xs-offset-0 " style="margin-bottom: 70px;">
         

          <div class="row">
          <div class="col-md-6 col-md-offset-3">
                  <div class="form-group">
                            <label for="assigned_to">Select Project</label>
                            <select class="form-control" id="project_id" name="project_id" required>
                              <option disabled selected value > -- select an option -- </option>
                                @foreach($projects as $project)
                                    <option>{{ $project->title}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

               {{--      @csrf
                @method('POST') --}}
                <span id="result"></span>
                <table class="table table-bordered table-striped" id="user_table">
                 <thead>
                  <tr>
                    {{-- <th width="21%">Project ID</th> --}}
                    <th>Item</th>
                    <th>Quatity</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" align="right">&nbsp;</td>
                    <td>
                     {{-- @csrf --}}
                     <button type="submit" name="save" id="save" class="btn btn-primary" value="Save" >Save</button>
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


     <script>
      $(document).ready(function(){

       var count = 1;

       dynamic_field(count);
       function dynamic_field(number)
       {
        html = '<tr>';
        // html += '<td><select name="project_id[]" class="form-control">@foreach($projects as $project)<option>{{$project->title}}</option>@endforeach </select></td>';
        html += '<td><select name="item_id[]" class="form-control">@foreach($items as $item)<option>{{$item->name}}</option>@endforeach </select></td>';
        html += '<td><input type="number" name="quantity[]" class="form-control"/></td>';
        html += '<td><input type="text" name="status[]" class="form-control"/></td>';
        
        if(number > 1)
        {
          html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
          $('tbody').append(html);
        }
        else
        {   
          html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
          $('tbody').html(html);
        }
      }

      $(document).on('click', '#add', function(){
        count++;
        dynamic_field(count);
      });

      $(document).on('click', '.remove', function(){
        count--;
        $(this).closest("tr").remove();
      });

 // $('#dynamic_form').on('submit', function(event){
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#save').click(function(e){
    e.preventDefault();
          //var name = "Hamza";
          $.ajax({
            type:'POST',
            url:'orderdetails/insert',
            data:$('#dynamic_form').serialize(),
            datatype: 'json',

          //   success:function(data){
          //     console.log(data);
          //   //alert(data);
          // },error:function(){ 
          //   alert("error!!!!");
          // }
            // beforeSend:function(){
            //     $('#save').attr('disabled','disabled');
            // },
        
          success:function(data)
            {
              //console.log(data);
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {

                        error_html += '<p>'+data.error[count]+'</p>';
                        //console.log('ERRORRRR');
                    }
                    $('#result').html('<div class="alert alert-danger"; >'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                   // console.log(data);

                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
           }
         });

        });

            // url:, success: function(event){
            //     alert('its called');
            // }
            
            
          });

// });
</script>

@stop
{{--<input type="text" name="item_id[]" class="form-control"/> <select name="item_id[]" class="form-control">@foreach($items as $item)<option>{{$item->name}}</option>@endforeach </select>  --}}