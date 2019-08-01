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
                                       {{--  @can('isAdmin')

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

                                    @endcan --}}
                                    <!-- Tasks Menu -->
                                        @php
                                        

                                        $request_status = DB::table('material_request_statuses')->where('name','=','Pending')->pluck('id')->first();
                                        $requests = DB::table('material_requests')
                                        ->leftjoin('projects','projects.id','=','material_requests.project_id')
                                        ->leftjoin('users','users.id','=','material_requests.requested_by')
                                        ->leftjoin('items','items.id','=','material_requests.item_id')
                                        ->where('request_status_id','=',$request_status)
                                        ->where('seen','=',0)
                                        ->select('projects.title','projects.id as proj_id','material_requests.instructions','users.name','items.name as item_name')
                                        ->take(5)->get(); 
                                        $totalrequests = DB::table('material_requests')->where('request_status_id','=',$request_status)
                                        ->where('seen','=',0)
                                        ->count();
                                        $seen = DB::table('material_requests')->pluck('seen')->last();
                                       // dd($seen);
                                        @endphp
                                        <li class="dropdown tasks-menu">
                                            <!-- Menu Toggle Button -->
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-flag-o"></i>
                                                <span class="label label-danger">
                                                @if($seen == 0)
                                                    {{ $totalrequests }}
                                                @endif
                                                </span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="header">
                                                 @if($seen == 0)
                                                
                                                   {{ $totalrequests }} Pending Material requests
                                             
                                                @endif 
                                                 @if($seen == 1)
                                                
                                                   {{ $totalrequests }} Material Requests 
                                                
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
                                                                <h3><strong>
                                                                    PR{{ $request->title }}</strong></h3>
                                                                    <span>{{ $request->name }}</span>
                                                                   <span class="pull-right" style="margin-right: 5px;">{{ $request->item_name }}</span> 
                                                                
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
                                                    <div class="pull-right btn btn-default btn-flat">

                                                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                            <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                                <i class=""></i> {{ trans('adminlte::adminlte.log_out') }}
                                                            </a>
                                                        @else
                                                            <a href="#"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                            >
                                                                <i class=""></i> {{ trans('adminlte::adminlte.log_out') }}
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
                               
                                    {{-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
                               
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

{{-- <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 712px;"> --}}
    <section class="sidebar">
      <!-- Sidebar user panel -->
    {{--   <div class="user-panel">
        <div class="pull-left image">
          <img src="/storage/{{ Auth::user()->profile_image }}" class="img-fluid" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> --}}
      <!-- search form -->
      {{--   <form method="get" action="{{ route('search.result') }}" class="form-inline mr-auto">
              <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control col-sm-8"  placeholder="Search events or blog posts..." aria-label="Search">
              <button class="btn aqua-gradient btn-rounded btn-sm my-0 waves-effect waves-light" type="submit">Search</button>
            </form>
 --}}

      <form method="get" action="{{ route('search.result') }}" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
          </div>
      </form>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
     {{--  <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li class="treeview active menu-open">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li class="active"><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="../tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="../examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section> --}}
  {{--   <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 198px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 514.142px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
</div> --}}
                <!-- sidebar: style can be found in sidebar.less -->
           {{--      <section class="sidebar"> --}}
                    
                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>

                    <!-- /.sidebar-menu -->
                </section>
                {{-- <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 127px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 585.386px;"></div>
                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
 --}}
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
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b></b> 
    </div>
    <strong><a href="#"> Construction Site Tracking & Management </a>.</strong> All rights reserved.
</footer>
    </div>

    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
