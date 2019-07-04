@extends('adminlte::master')
@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'red') . '.min.css')}} ">

    @stack('css')
    @yield('css')
@stop


@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>


                        <!-- /.navbar-collapse -->
                    @else
                        <!-- Logo -->
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                                <!-- mini logo for sidebar mini 50x50 pixels -->
                                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                                <!-- logo for regular state and mobile devices -->
                                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                            </a>

                            <!-- Header Navbar -->
                            <nav class="navbar navbar-static-top" role="navigation">
                                <!-- Sidebar toggle button-->
                                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                </a>
                            @endif
  
                            <!-- Navbar Right Menu -->
                                <div class="navbar-custom-menu">


                                    <ul class="nav navbar-nav">
                                        <!-- Messages: style can be found in dropdown.less-->
                                    {{--  <li class="dropdown messages-menu">
                                       <!-- Menu toggle button -->
                                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                         <i class="fa fa-envelope-o"></i>
                                         <span class="label label-success">4</span>
                                       </a>
                                       <ul class="dropdown-menu">
                                         <li class="header">You have 4 messages</li>
                                         <li>
                                           <!-- inner menu: contains the messages -->
                                           <ul class="menu">
                                             <li>
                                               <!-- start message -->
                                               <a href="#">
                                                 <div class="pull-left">
                                                   <!-- User Image -->
                                                   <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                 </div>
                                                 <!-- Message title and timestamp -->
                                                 <h4>
                                                     Support Team
                                                     <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                   </h4>
                                                 <!-- The message -->
                                                 <p>Why not buy a new awesome theme?</p>
                                               </a>
                                             </li>
                                             <!-- end message -->
                                           </ul>
                                           <!-- /.menu -->
                                         </li>
                                         <li class="footer"><a href="#">See All Messages</a></li>
                                       </ul>
                                     </li>
                                     <!-- /.messages-menu --> --}}

                                    <!-- Notifications Menu -->
                                        @can('isAdmin')

                                            <li class="dropdown notifications-menu">
                                                <!-- Menu toggle button -->
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-bell-o"></i>
                                                    <span class="label label-warning">10</span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="header">You have 10 notifications</li>
                                                    <li>
                                                        <!-- Inner Menu: contains the notifications -->
                                                        <ul class="menu">
                                                            <li>
                                                                <!-- start notification -->
                                                                <a href="#">
                                                                    <i class="fa fa-users text-aqua"></i> 5 new members
                                                                    joined today
                                                                </a>
                                                            </li>
                                                            <!-- end notification -->
                                                        </ul>
                                                    </li>
                                                    <li class="footer"><a href="#">View all</a></li>
                                                </ul>
                                            </li>

                                    @endcan
                                    <!-- Tasks Menu -->
                                        @php
                                        

                                        $request_status = DB::table('material_request_statuses')->where('name','=','Pending')->pluck('id')->first();
                                        $requests = DB::table('material_requests')->where('request_status_id','=',$request_status)->take(5)->get(); 
                                        $totalrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)->count();
                                        $seen = DB::table('material_requests')->pluck('seen')->last();
                                       // dd($seen);
                                        @endphp
                                        <li class="dropdown tasks-menu">
                                            <!-- Menu Toggle Button -->
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-flag-o"></i>
                                                <span class="label label-danger">
                                                @if($seen == 0)
                                                {
                                                    {{ $totalrequests }}
                                                }
                                                @endif
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="header">
                                                 @if($seen == 0)
                                                
                                                   You Have {{ $totalrequests }} Total Pending Material requests
                                             
                                                @endif 
                                                 @if($seen == 1)
                                                
                                                   You have {{ $totalrequests }} Pending Material Requests 
                                                
                                                @endif
                                            </li>

                                                <li>
                                                    <!-- Inner menu: contains the tasks -->
                                                    <ul class="menu">
                                                        @foreach($requests as $request)
                                                        <li>
                                                            <!-- Task item -->
                                                            <a href="/materialrequest">
                                                                <!-- Task title and progress text -->
                                                                <h3>
                                                                    PR{{ $request->project_id }}
                                                                    <p class="pull-right">CT{{ $request->requested_by }}</p>
                                                                    <br><p>{{ $request->item_id }}</p>
                                                                </h3>
                                                                <!-- The progress bar -->
{{--                                                                <div class="progress xs">--}}
{{--                                                                  --}}
{{--                                                                    <div class="progress-bar progress-bar-aqua"--}}
{{--                                                                         style="width: 20%" role="progressbar"--}}
{{--                                                                         aria-valuenow="20" aria-valuemin="0"--}}
{{--                                                                         aria-valuemax="100">--}}
{{--                                                                        <span class="sr-only">20% Complete</span>--}}
{{--                                                                    </div>--}}
{{--                                                                    --}}
{{--                                                                </div>--}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                        <!-- end task item -->
                                                    </ul>
                                                </li>
                                                <li class="footer">
                                                    <a href="/materialrequest">View all Material Requests</a>
                                                </li>
                                            </ul>

                                        </li>
                                        <!-- User Account Menu -->

                                        <li class="dropdown user user-menu">
                                            <!-- Menu Toggle Button -->
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <!-- The user image in the navbar-->
                                                <img src="/storage/{{ Auth::user()->profile_image }}" class="user-image"
                                                     alt="User Image">
                                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- The user image in the menu -->
                                                <li class="user-header">
                                                     <img src="/storage/{{ Auth::user()->profile_image }}" class="user-image"
                                                     alt="User Image">


                                                    <p>
                                                        {{ Auth::user()->name }}
                                                        <small> {{ Auth::user()->email }}</small>
                                                    </p>
                                                </li>
                                                <!-- Menu Body -->
                                            {{--  <li class="user-body">
                                               <div class="row">
                                                 <div class="col-xs-4 text-center">
                                                   <a href="#">Followers</a>
                                                 </div>
                                                 <div class="col-xs-4 text-center">
                                                   <a href="#">Sales</a>
                                                 </div>
                                                 <div class="col-xs-4 text-center">
                                                   <a href="#">Friends</a>
                                                 </div>
                                               </div>
                                               <!-- /.row -->
                                             </li> --}}
                                            <!-- Menu Footer-->
                                                <li class="user-footer">
                                                    <div class="pull-left">
                                                        <a href="{{ route('profile')}}"
                                                           class="btn btn-default btn-flat">Profile</a>
                                                    </div>
                                                    <div class="pull-right" style="margin-top: 5px;">

                                                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                            <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                            </a>
                                                        @else
                                                            <a href="#"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                            >
                                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                            </a>
                                                            <form id="logout-form"
                                                                  action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}"
                                                                  method="POST" style="display: none;">
                                                                @if(config('adminlte.logout_method'))
                                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                                @endif
                                                                {{ csrf_field() }}
                                                            </form>
                                                        @endif

                                                        {{-- <a href="#" class="btn btn-default btn-flat">Sign out</a> --}}
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                       @can('isAdmin') 
                                        <li>
                               
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                               
                                  </li> @endcan
                                                            </ul>
                                </div>
                            </nav>

                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>

    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                @endif

                <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        @yield('content')

                    </section>
                    <!-- /.content -->
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
   

   <!-- Top Navigation Setting box for Admin -->

@can('isAdmin')


<aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="">
    <!-- Create the tabs -->
  {{--   <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class=""><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-wrench"></i></a></li><li class=""><a href="#control-sidebar-home-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-home"></i></a></li>
      <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-gears"></i></a></li>
    </ul> --}}
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane active" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Project Settings</h3>
        <ul>
        <label class="control-sidebar-subheading">
              Project Phases
          </label>
        <li><a href=" {{ route('phases.index') }}"><i class=""></i> <span>Project Phases</span></a></li>
        <li><a href="{{ route('phases.create') }}"><i class=""></i> <span>Add New Phases</span></a></li>
         <label class="control-sidebar-subheading">
              Project Status
          </label>
        <li><a href="{{ route('projectstatus.index') }}"><i class=""></i> <span>Project Status</span></a></li>
        <li><a href="{{ route('projectstatus.create') }}"><i class=""></i> <span>Add new Status</span></a></li>
        </ul>

          {{-- <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked="">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group --> --}}
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
 
@endcan 

    </div>

    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
