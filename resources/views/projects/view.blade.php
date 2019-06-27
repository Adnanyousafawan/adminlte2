@extends('adminlte::page')
@section('title', 'AdminLTE')

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    {{-- <link rel="stylesheet" href="/images"> --}}
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/jquery.dataTables.js"></script>
   



@section('content')


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

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
  @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="box-body" style="margin-top: 0px; padding: 0px;">
        <div class="box box-primary" style=" background-color: #f4f4f487; ">
            <div class="row" style="padding: 12px;">
               <div class="row" style="padding: 16px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1  " style="padding: 0px;">               
                    <div class="col-xs-12 col-md-3 col-sm-4 col-lg-4 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Spent</h2>
                                <span class="info-box-number label label-warning pull-right"
                                      style="margin-top: 0px;">{{ $expense }}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xs-12 col-md-4 col-sm-4 col-lg-4 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Balance</h2>
                                <span class="info-box-number label label-danger pull-right"
                                      style="margin-top: 0px;">{{ $balance }}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                {{-- {{     dd($data) }}  --}}
                    <!-- /.col -->
                    <div class="col-xs-12 col-md-3 col-sm-4 col-lg-4 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Budget</h2>
                                <span class="info-box-number label label-success pull-right" style="margin-top: 0px;"> {{ $projects->estimated_budget }}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                   
                </div>
       
            </div>    
<div class="row">
    


                <div class="col-md-4 col-md-offset-1 col-sm-6 col-lg-4 col-lg-offset-1">
                   
                    <div class="box box-primary">
                        <div class="box-body {{-- box-profile --}}">
                            {{--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="Project Image">
                --}}
                <?php
                //dd($projects);
                ?>
                            <h3 class="profile-username text-center"> {{$projects->title }}  </h3>
                             <p class="text-muted text-center"> {{ $projects->area }}  </p>
                            <b><p class="text-muted text-center"> {{ $projects->city }}  </p></b>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Customer Name</strong>
                            <p class="text-muted float-right">
                                {{ $customers->name }}
                            </p>
                            <strong><i class="fa fa-book margin-r-5"></i>Customer Contact</strong>
                            <b><p class="text-muted float-right">
                                {{ $customers->phone }}
                            </p>
                            
                            <strong><i class="fa fa-book"></i>Project Details</strong>
                            <div class="box-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Size</b> <a class="pull-right"> <span
                                                class="label label-danger"> {{ $projects->plot_size }}   </span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Number of Floors</b> <a class="pull-right">  {{ $projects->floor}}   </a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Completion Time</b> <a class="pull-right"> {{ $projects->estimated_completion_time }}   </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Assigned To</b> <a class="pull-right">  {{ $contractors->name }}  </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Contact</b> <a class="pull-right"> {{ $contractors->phone }}  </a>
                                    </li>
                                </ul>
                                <!-- /.box-body -->
                                <strong><i class="fa fa-file-text-o "></i> {{ $projects->description }}</strong>

                                <p>   </p>
                            </div>

                            <a href="{{ route('projects.edit', ['id' => $projects->id]) }}" class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
 



<div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="box box-primary" style="">
                        <div class="box-header with-border">
                            <h3 class="box-title">About Project</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Number of Workers</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Current Phase</b> <a class="pull-right">5</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Project Status</b> <a class="pull-right">In Progress</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Floor Number</b> <a class="pull-right">2</a>
                                </li>

                            </ul>
                        </div> <!-- /.box-body -->
                    </div><!-- /.box -->
                </div>


<div class="col-md-6 col-sm-12 col-lg-6">
        <div class="nav-tabs-custom" style="cursor: move;">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right ui-sortable-handle">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="300" version="1.1" width="611" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="49.21875" y="261.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M61.71875,261.5H586" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.21875" y="202.375" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">7,500</tspan></text><path fill="none" stroke="#aaaaaa" d="M61.71875,202.375H586" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.21875" y="143.25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">15,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M61.71875,143.25H586" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.21875" y="84.12500000000003" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.250000000000028">22,500</tspan></text><path fill="none" stroke="#aaaaaa" d="M61.71875,84.12500000000003H586" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="49.21875" y="25.00000000000003" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.250000000000028">30,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M61.71875,25.00000000000003H586" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="489.8074498784933" y="274" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2013</tspan></text><text x="256.65199726609967" y="274" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,6.75)"><tspan style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" dy="4.25">2012</tspan></text><path fill="#74a5c2" stroke="none" d="M61.71875,219.46606666666668C76.37059538274605,219.97848333333334,105.67428614823815,223.04214375,120.3261315309842,221.51573333333334C134.97797691373026,219.98932291666668,164.28166767922235,209.52570027322403,178.9335130619684,207.25478333333334C193.42609925577156,205.00855027322405,222.4112716433779,205.26325625,236.90385783718105,203.44713333333334C251.3964440309842,201.63101041666667,280.3816164185905,195.27290284608378,294.8742026123937,192.7258C309.5260479951397,190.15070701275044,338.8297387606318,182.85093958333334,353.48158414337786,182.95835C368.1334295261239,183.06576041666668,397.43712029161605,204.56019107468126,412.0889656743621,193.58508333333333C426.58155186816526,182.7292702413479,455.56672425577153,102.10697044198895,470.0593104495747,95.63466666666667C484.392637454435,89.23348710865562,513.0592914641555,135.37136634615388,527.3926184690158,142.09115000000003C542.0444638517619,148.9602621794872,571.348154617254,148.015475,586,149.99025L586,261.5L61.71875,261.5Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#3c8dbc" d="M61.71875,219.46606666666668C76.37059538274605,219.97848333333334,105.67428614823815,223.04214375,120.3261315309842,221.51573333333334C134.97797691373026,219.98932291666668,164.28166767922235,209.52570027322403,178.9335130619684,207.25478333333334C193.42609925577156,205.00855027322405,222.4112716433779,205.26325625,236.90385783718105,203.44713333333334C251.3964440309842,201.63101041666667,280.3816164185905,195.27290284608378,294.8742026123937,192.7258C309.5260479951397,190.15070701275044,338.8297387606318,182.85093958333334,353.48158414337786,182.95835C368.1334295261239,183.06576041666668,397.43712029161605,204.56019107468126,412.0889656743621,193.58508333333333C426.58155186816526,182.7292702413479,455.56672425577153,102.10697044198895,470.0593104495747,95.63466666666667C484.392637454435,89.23348710865562,513.0592914641555,135.37136634615388,527.3926184690158,142.09115000000003C542.0444638517619,148.9602621794872,571.348154617254,148.015475,586,149.99025" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="61.71875" cy="219.46606666666668" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="120.3261315309842" cy="221.51573333333334" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="178.9335130619684" cy="207.25478333333334" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="236.90385783718105" cy="203.44713333333334" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="294.8742026123937" cy="192.7258" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="353.48158414337786" cy="182.95835" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="412.0889656743621" cy="193.58508333333333" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="470.0593104495747" cy="95.63466666666667" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="527.3926184690158" cy="142.09115000000003" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="586" cy="149.99025" r="4" fill="#3c8dbc" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#eaf3f6" stroke="none" d="M61.71875,240.48303333333334C76.37059538274605,240.2623,105.67428614823815,241.81334583333333,120.3261315309842,239.6001C134.97797691373026,237.38685416666667,164.28166767922235,223.7569693078324,178.9335130619684,222.77706666666666C193.42609925577156,221.80781514116575,222.4112716433779,233.67380416666666,236.90385783718105,231.80348333333333C251.3964440309842,229.9331625,280.3816164185905,209.67950066029144,294.8742026123937,207.8145C309.5260479951397,205.9290048269581,338.8297387606318,214.84052083333333,353.48158414337786,216.8015C368.1334295261239,218.76247916666668,397.43712029161605,232.818839435337,412.0889656743621,223.50233333333335C426.58155186816526,214.28709360200367,455.56672425577153,148.48789790515656,470.0593104495747,142.67451666666668C484.392637454435,136.92501873848988,513.0592914641555,170.77857834249085,527.3926184690158,177.25081666666668C542.0444638517619,183.8668825091575,571.348154617254,190.58350416666667,586,195.02773333333334L586,261.5L61.71875,261.5Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#a0d0e0" d="M61.71875,240.48303333333334C76.37059538274605,240.2623,105.67428614823815,241.81334583333333,120.3261315309842,239.6001C134.97797691373026,237.38685416666667,164.28166767922235,223.7569693078324,178.9335130619684,222.77706666666666C193.42609925577156,221.80781514116575,222.4112716433779,233.67380416666666,236.90385783718105,231.80348333333333C251.3964440309842,229.9331625,280.3816164185905,209.67950066029144,294.8742026123937,207.8145C309.5260479951397,205.9290048269581,338.8297387606318,214.84052083333333,353.48158414337786,216.8015C368.1334295261239,218.76247916666668,397.43712029161605,232.818839435337,412.0889656743621,223.50233333333335C426.58155186816526,214.28709360200367,455.56672425577153,148.48789790515656,470.0593104495747,142.67451666666668C484.392637454435,136.92501873848988,513.0592914641555,170.77857834249085,527.3926184690158,177.25081666666668C542.0444638517619,183.8668825091575,571.348154617254,190.58350416666667,586,195.02773333333334" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="61.71875" cy="240.48303333333334" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="120.3261315309842" cy="239.6001" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="178.9335130619684" cy="222.77706666666666" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="236.90385783718105" cy="231.80348333333333" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="294.8742026123937" cy="207.8145" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="353.48158414337786" cy="216.8015" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="412.0889656743621" cy="223.50233333333335" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="470.0593104495747" cy="142.67451666666668" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="527.3926184690158" cy="177.25081666666668" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="586" cy="195.02773333333334" r="4" fill="#a0d0e0" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="display: none;"></div></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"><svg height="342" version="1.1" width="512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#3c8dbc" d="M320.5,243.33333333333331A93.33333333333333,93.33333333333333,0,0,0,408.7277551949771,180.44625304313007" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#3c8dbc" stroke="#ffffff" d="M320.5,246.33333333333331A96.33333333333333,96.33333333333333,0,0,0,411.56364732624417,181.4248826052307L448.1151459070204,194.03833029452744A135,135,0,0,1,320.5,285Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#f56954" d="M408.7277551949771,180.44625304313007A93.33333333333333,93.33333333333333,0,0,0,236.78484627831412,108.73398312817662" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#f56954" stroke="#ffffff" d="M411.56364732624417,181.4248826052307A96.33333333333333,96.33333333333333,0,0,0,234.09400205154566,107.40757544301087L194.92726941747117,88.10097469226493A140,140,0,0,1,452.8416327924656,195.6693795646951Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#00a65a" d="M236.78484627831412,108.73398312817662A93.33333333333333,93.33333333333333,0,0,0,320.47067846904883,243.333328727518" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#00a65a" stroke="#ffffff" d="M234.09400205154566,107.40757544301087A96.33333333333333,96.33333333333333,0,0,0,320.46973599126824,246.3333285794739L320.4575884998742,284.9999933380171A135,135,0,0,1,199.4120097954186,90.31165416754118Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="320.5" y="140" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(1,0,0,1,0,0)"><tspan dy="140" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">In-Store Sales</tspan></text><text x="320.5" y="160" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1,0,0,1,0,0)"><tspan dy="160" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30</tspan></text></svg></div>
            </div>
          </div>
      </div>
              
 
</div>

<div class="row">
                <div class="col-md-5 col-md-offset-1 col-sm-12 col-lg-6 col-lg-offset-1">
                    <div class="box box-primary" style="margin-bottom: 10px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Orders Details</h3>

                            <div class="box-tools pull-right">
                                {{--  <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-left">Place New Order</a> --}}


                                {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                             class="fa fa-minus"></i>
                                 </button> --}}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order) 
                                    <tr>
                                        <td><a href="#">OR{{ $order->id }}</a></td>
                                        
                                        <td>{{ $order->item_id }}</td>
                                        <td>{{ $order->quantity}}</td>
                                        <td>{{ $order->status }}</td>
                                        <td><span class="label label-success col-md-10">{{ $order->status }}</span></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> 
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                            <a href="{{ route('orders.projectorders',['id' => $projects->id ]) }}" class="btn btn-sm btn-default btn-flat pull-right">View All
                                Orders</a>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        Showing 1
                                to {{count($orders)}} of {{ $total_orders }} entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        {{--  {{ $projects->links() }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>





                <div class="col-md-4 col-md-offset-0 col-sm-12 col-sm-offset-0 col-lg-4 col-lg-offset-0">
                    <div class="box box-primary" style="margin-bottom: 10px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Material Requests</h3>

                            <div class="box-tools pull-right">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-left">Place Order</a>


                                {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                             class="fa fa-minus"></i>
                                 </button> --}}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>Bricks</td>

                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">111</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                        <td>Cement</td>

                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">2222</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>Rod</td>

                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">333</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>Sand</td>

                                        <td>
                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">222</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>Cement</td>

                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">555</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All
                                Requests</a>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        Showing 1
                                        to 2 of 2 entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        {{--  {{ $projects->links() }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>


</div>


            <div class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
              {{--   style="padding: 5px;" --}}>
                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Labor Record</span></h4>
                        <div class="box-tools pull-right">
                            <a type="links" {{-- href="{{ route('labors.create') }}" --}}  data-toggle="modal"
                               data-target="#applicantADDModal" class="btn btn-primary pul-right">Add Labor</a>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped labor">
                            <thead>
                                <tr>

                                <th>Labor ID</th>
                                <th>Name</th>
                                <th>Project Id</th>
                                <th>Present</th>
                                <th>Labor Rate</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($labors as $labor)
                                <tr>
                                    <td>lb0000{{ $labor->id }}</td>
                                    <td>{{ $labor->name }}</td>
                                    <td>PR0000{{ $labor->project_id}}</td>
                                    <td>23</td>
                                    <td>{{ $labor->rate }}</td>
                                    <td>25000</td>

                                    <td>
                     
                    <div class="btn-group">
                    {{-- <button class="btn btn-success btn-flat" type="button">Action</button> --}}
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <ul role="menu" class="dropdown-menu">
                     
                       
                        <li><a href="{{ route('labors.edit', ['id' => $labor->id]) }}"><i class="fa fa-edit"></i>Edit</a></li>
                                             
                        <li><a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $labor->id }}"><i class="fa fa-remove"></i>Delete</a></li>
                                          </ul>

                  </div>

                                       </td>
                                </tr>

                                <div id="applicantDeleteModal-{{ $labor->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center; text-align: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                {{-- <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}"
                                                      method="POST" class="remove-record-model"> --}}
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                        <h4 class="modal-title text-center"
                                                            id="custom-width-modalLabel">Delete Applicant Record</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong><b><h3>Are You Sure? <br>You Want Delete This Record?
                                                                </h3></b></strong>
                                                        <input type="hidden" , name="applicant_id" id="app_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-danger waves-effect remove-data-from-delete-form">
                                                            Delete
                                                        </button>
                                                    </div>

                                              
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>


                {{--____________________________   This is ADD MODAL CODE  ______________________________ --}}


                <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="min-width:70%; align-content: center;">
                        <div class="modal-content">

                            {{--   <form class="row" method="POST"
                                            action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}" method="POST" class="remove-record-model">
                                         {{ method_field('delete') }}
                                         {{ csrf_field() }}

--}}
                            <form method="post" action="{{ route('labors.store') }}" enctype="">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close pull-right" data-dismiss="modal"
                                            aria-hidden="true">x
                                     </button>
                                    <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                            Labor</h3></strong>
                                </div>
                                <div class="modal-body">

                                    <div style=" width: 100%;">

                                        <div class="row" style="margin-top: 5px; margin-left: 1%;">
                                        
                                                    <div class="box-body">

                                                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-12 col-xl-10 col-xl-offset-2 ">
                                                            <div class="form-group">


                                                                <label for="name">Labor Name</label>
                                                                <input type="text" class="form-control" id="name"
                                                                       placeholder="Labor Name" name="name">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cnic">Labor CNIC</label>
                                                                <input type="text" class="form-control" id="cnic"
                                                                       placeholder="Labor CNIC" name="cnic">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Labor Contact</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-phone"></i>
                                                                    </div>
                                                                    <input type="text" maxlength="14"
                                                                           class="form-control"
                                                                           
                                                                           data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                                                           data-mask="" id="phone" name="phone">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address">Labor Address</label>
                                                                <input type="text" class="form-control" id="address"
                                                                       placeholder="Home Address"
                                                                       name="address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="city">Labor City</label>
                                                                <input type="text" class="form-control" id="city"
                                                                       placeholder="Home City" name="city">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="rate">Labor Price</label>
                                                                <input type="text" class="form-control" id="rate"
                                                                       placeholder="Labor Rate(per Day)"
                                                                       name="rate">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="project_id">Project ID</label>
                                                                <select class="form-control" id="project_id" name="project_id">
                                                                    <option> {{ $projects->title }} </option>
                                                                </select>
                                                            </div>

                                                            <button type="submit"
                                                                    class="btn btn-block btn-primary btn-xs form-control"
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
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

 <script type="text/javascript">


        $('.labor').DataTable({
            select: true,
            "order": [[0, "asc"]],
            //"scrollY"  : "380px",
            "scrollCollapse": true,
            "paging": true,
            "bProcessing": true,
            // fixedHeader: {
            //     header: false,
            //     // headerOffset: 100,
            //     },
            //scrollX: true,
            // scrollY: true
        });

    </script>

@stop
   