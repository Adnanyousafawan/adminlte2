@extends('adminlte::page')

@section('content')
    <div class="container">

        <div class="panel panel-primary">

         <div class="panel-heading">Charts In Laravel 5 Using Charts Package</div>

          <div class="panel-body">    
            <div class="row">
            <div class="col-md-6"> 
               {!! $chart->html() !!}
            </div>

            <br/><br/>
            
            <div class="col-md-6">  
               {!! $pie_chart->html() !!}
            </div>

            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $line_chart->html() !!}
            </div>

            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $areaspline_chart->html() !!}
            </div>

            <br/><br/>
            

            <div class="col-md-6"> 
               {!! $geo_chart->html() !!}
            </div>

            <br/><br/>
            

            <div class="col-md-6"> 
               {!! $area_chart->html() !!}
            </div>

            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $donut_chart->html() !!}
            </div>


            <br/><br/>
            
            <div class="col-md-6"> 
               {!! $percentage_chart->html() !!}
            </div>


         </div>

        </div>

    </div>

    {!! Charts::scripts() !!}
    {!! $chart->script() !!}

    {!! $pie_chart->script() !!}

    {!! $line_chart->script() !!}

    {!! $areaspline_chart->script() !!}

    {!! $percentage_chart->script() !!}

    {!! $geo_chart->script() !!}

    {!! $area_chart->script() !!}

    {!! $donut_chart->script() !!}
@endsection
