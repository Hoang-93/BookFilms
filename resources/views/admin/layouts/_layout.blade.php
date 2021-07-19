<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('Admin/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('Admin/css/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{asset('Admin/css/timeline.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!--notify-->
    <script src="{{asset('Admin/js/PNotify.js')}}"></script>
    <script src="{{asset('Admin/js/PNotifyBootstrap3.js')}}"></script>
    <script src="{{asset('Admin/js/PNotifyConfirm.js')}}"></script>
    <link href="{{asset('Admin/css/BrightTheme.css')}}" rel="stylesheet" />
    <link href="{{asset('Admin/css/PNotify.css')}}" rel="stylesheet" />
    <link href="{{asset('Admin/css/PNotifyBootstrap3.css')}}" rel="stylesheet" />
    <link href="{{asset('Admin/css/PNotifyConfirm.css')}}" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{asset('Admin/css/startmin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('Admin/css/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('Admin/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
    @if(Session::get('admin') == null)
        <script>window.location = "/dang-nhap.html";</script>
    @endif

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <ul class="nav navbar-nav navbar-left navbar-top-links">
                <li><a href="/Admin/Home"><i class="fa fa-home fa-fw"></i>X-Star Cineplex</a></li>
            </ul>

            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> Administrator <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>

                            <a href="/"><i class="fa fa-user fa-fw"></i>Home Page</a>
                        </li>
                         <li>
                            <a href="/Admin/ChangePass"><i class="fa fa-edit fa-fw"></i>Change password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/logout"><i class="fa fa-sign-out fa-fw"></i>Log out</a>

                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            {{-- <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div> --}}
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/Admin/Home"><i class="fa fa-dashboard fa-fw"></i>Revenue statistics</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Film Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/Admin/Film/MoviePlay">Film Now Showing</a>
                                </li>
                                <li>
                                    <a href="/Admin/Film/ComingMovie">Film Coming Soon</a>
                                </li>
                                <li>
                                    <a href="/Admin/Film/Add">Add Film</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="/Admin/User"><i class="fa fa-user fa-fw"></i>Manager User's account</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-address-book-o fa-fw"></i> Ticket Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/Admin/Ticket">List of pre-booked tickets</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-inbox fa-fw"></i>General Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/Admin/Feedback">Feedback management</a>
                                </li>
                                <li>
                                    <a href="/Admin/FoodDrink">Food & Drinks</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="/Admin/Room"><i class="fa fa-film fa-fw"></i>Room management</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{asset('Admin/js/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('Admin/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('Admin/js/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{asset('Admin/js/raphael.min.js')}}"></script>
    <script src="{{asset('Admin/js/jquery.validate.js')}}"></script>
    <script src="{{asset('Admin/ckeditor/ckeditor.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('Admin/js/startmin.js')}}"></script>
    <!--Swipe js-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('jsAdmin')
</body>
</html>
