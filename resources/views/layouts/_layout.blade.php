<!doctype html>
<html>
<head>
	<!-- Basic Page Needs -->
        <meta charset="utf-8">

        <title>@yield('title') | X-Star Cineplex</title>

        <title>@yield('title') | XstarCinePlex</title>

        <meta name="description" content="A Template by Gozha.net">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="author" content="Gozha.net">

    <!-- Mobile Specific Metas-->
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="telephone=no" name="format-detection">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/css/img/icon.png')}}">
    <!-- Fonts -->
        <!-- Font awesome - icon font -->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!-- Roboto -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,700' rel='stylesheet' type='text/css'>
        <!-- Open Sans -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:800italic' rel='stylesheet' type='text/css'>

    <!-- Stylesheets -->
        {{-- <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" /> --}}
        <link href="{{asset('Admin/css/bootstrap.min.css')}}" rel="stylesheet">
        {{-- <link href="{{asset('assets/css/jquery-ui.css')}}" rel="stylesheet" /> --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <!-- Mobile menu -->
        <link href="{{asset('assets/css/gozha-nav.css')}}" rel="stylesheet" />
        <!-- Select -->
        <link href="{{asset('assets/css/external/jquery.selectbox.css')}}" rel="stylesheet" />

        <!-- REVOLUTION BANNER CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/rs-plugin/css/settings.css')}}" media="screen" />

        <!-- Custom -->
        <link href="{{asset('assets/css/style.css?v=1')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/PNotifyBrightTheme.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/datepicker/datepicker3.css')}}" rel="stylesheet" />


        <!-- Modernizr -->
        <script src="{{asset('assets/js/external/modernizr.custom.js')}}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    	<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
    <![endif]-->
</head>

<body>
    <div class="wrapper">
        <!-- Banner -->
        {{-- <div class="banner-top">

            <img alt='top banner' src="http://placehold.it/1600x90">
        </div> --}}

        <!-- Header section -->
        <header class="header-wrapper header-wrapper--home">
            <div class="container">
                <!-- Logo link-->

              <a href='/' class="logo">
                   <img alt='logo' src="{{asset('assets/images/logo.png')}}">

                <a href='/' class="logo">
                    <img  style="height: 50px;margin-top:-13px" alt='logo' src="{{asset('assets/images/logonew.jpg')}}">

                </a>

                <!-- Main website navigation-->   
                <nav id="navigation-box">
                    <!-- Toggle for mobile menu mode -->
                    <a href="#" id="navigation-toggle">
                        <span class="menu-icon">
                            <span class="icon-toggle" role="button" aria-label="Toggle Navigation">
                              <span class="lines"></span>
                            </span>
                        </span>
                    </a>

                    <!-- Link navigation -->
                    <ul id="navigation">
                        <li>
                            <span class="sub-nav-toggle plus"></span>
                            <a href="/">Home Page</a>
                        </li>
                        <li>
                            <span class="sub-nav-toggle plus"></span>

                             <a href="#">Category</a>

                            {{-- <a href="#">Genre</a>  --}}

                            <ul>
                                @foreach($category as $item)
                                    <div style="display: none;">{{ $url = '/the-loai/' . $item->Link . "/" . $item->ID }}</div>
                                    <li class="menu__nav-item"><a href="{{ $url }}">{{ $item->Name }}</a></li>
                                @endforeach

                            </ul>
                        </li>
                        <li>
                            <a href="/phim-dang-chieu.html">Now Showing</a>
                        </li>
                        <li>

                            <a href="/phim-sap-chieu.html">Comming Soon</a>

                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>

                    </ul>
                </nav>

                <!-- Additional header buttons / Auth and direct link to booking-->

                <div class="control-panel">
                    @if(Session::get('user') != null)
                    <div class="auth auth--home">
                      <a href="#" class="btn btn--sign btn--singin">
                          {{ Session::get('user')->Fullname }}
                      </a>
                      <ul class="auth__function">
                        <li><a href="/lich-su-dat-ve.html" class="auth__function-item">My deal and points</a></li>
                         <li><a href="/cap-nhat-thong-tin.html" class="auth__function-item">Change user's profile</a></li>
                        <li><a href="/doi-mat-khau.html" class="auth__function-item">Change password</a></li>
                        <li><a href="/logout" class="auth__function-item">Log out</a></li>
                    </ul>
                </div>
                    @else
                        <a href="/dang-nhap.html" class="btn btn-md btn--warning btn--book btn-control--home">Login</a>
                        <a href="/dang-ky.html" class="btn btn-md btn--primary btn--book btn-control--home">Register</a>
                    @endif

                </div>

            </div>
        </header>

        @yield('content')


        <div class="clearfix"></div>

        <footer class="footer-wrapper">
            <section class="container">
              {{--   <div class="col-xs-4 col-md-2 footer-nav">
                    <ul class="nav-link">
                        <li><a href="#" class="nav-link__item">Cities</a></li>
                        <li><a href="movie-list-left.html" class="nav-link__item">Movies</a></li>
                        <li><a href="trailer.html" class="nav-link__item">Trailers</a></li>
                        <li><a href="rates-left.html" class="nav-link__item">Rates</a></li>
                    </ul>
                </div>
                <div class="col-xs-4 col-md-2 footer-nav">
                    <ul class="nav-link">
                        <li><a href="coming-soon.html" class="nav-link__item">Coming soon</a></li>
                        <li><a href="cinema-list.html" class="nav-link__item">Cinemas</a></li>
                        <li><a href="offers.html" class="nav-link__item">Best offers</a></li>
                        <li><a href="news-left.html" class="nav-link__item">News</a></li>
                    </ul>
                </div>
                <div class="col-xs-4 col-md-2 footer-nav">
                    <ul class="nav-link">
                        <li><a href="#" class="nav-link__item">Terms of use</a></li>
                        <li><a href="gallery-four.html" class="nav-link__item">Gallery</a></li>
                        <li><a href="contact.html" class="nav-link__item">Contacts</a></li>
                        <li><a href="page-elements.html" class="nav-link__item">Shortcodes</a></li>
                    </ul>
                </div> --}}
                <div class="col-xs-12 col-md-12">
                    <div class="footer-info">

                        <p class="heading-special--small mr-5">X-Star Cineplex <br><span class="title-edition">&nbsp; in the social media</span></p>

                            <div class="social">
                            <a href='#' class="social__variant fa fa-facebook"></a>
                            <a href='#' class="social__variant fa fa-twitter"></a>
                            <a href='#' class="social__variant fa fa-vk"></a>
                            <a href='#' class="social__variant fa fa-instagram"></a>
                            <a href='#' class="social__variant fa fa-tumblr"></a>
                            <a href='#' class="social__variant fa fa-pinterest"></a>
                        </div>

                        <div class="clearfix"></div>

                        <p class="copy text-center">&copy; X-Star Cinexplex, 2021. All rights reserved. Done by Team 1</p>

                                           </div>
                </div>
            </section>
        </footer>
    </div>


    <!-- JavaScript-->
        <!-- jQuery 1.9.1-->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        {{-- <script>window.jQuery || document.write('<script src="js/external/jquery-1.10.1.min.js"><\/script>')</script> --}}
        <!-- Migrate -->
        <script src="{{asset('assets/js/external/jquery-migrate-1.2.1.min.js')}}"></script>
        <!-- Bootstrap 3-->
        {{-- <script src="{{asset('assets/js/bootstrap.min.js')}}"></script> --}}
        <script src="{{asset('Admin/js/bootstrap.min.js')}}"></script>
        {{-- <script src="{{asset('assets/js/jquery-ui.js')}}"></script> --}}
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!-- jQuery REVOLUTION Slider -->
        <script type="text/javascript" src="{{asset('assets/rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

        <!-- Mobile menu -->
        <script src="{{asset('assets/js/jquery.mobile.menu.js')}}"></script>
         <!-- Select -->
        <script src="{{asset('assets/js/external/jquery.selectbox-0.2.min.js')}}"></script>
        <!-- Stars rate -->
        <script src="{{asset('assets/js/external/jquery.raty.js')}}"></script>

        <script src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}"></script>


        <!-- Form element -->
        <script src="{{asset('assets/js/external/form-element.js')}}"></script>
        <!-- Form validation -->
        <script src="{{asset('assets/js/form.js')}}"></script>

        <!-- Twitter feed -->
        <script src="{{asset('assets/js/external/twitterfeed.js')}}"></script>

        <!-- Custom -->
        <script src="{{asset('assets/notify/notify.js')}}"></script>
        <script src="{{asset('assets/notify/PNotify.js')}}"></script>
        <script src="{{asset('assets/js/custom.js')}}"></script>
        <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

        <script type="text/javascript">
              $(document).ready(function() {
                init_Home();
              });

         </script>
        @yield('jsSection')
</body>
</html>
