  {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  
    <div class="container">
      <a class="navbar-brand" href="#"> <i class="bi bi-arrows-move"></i>  MC PART SORTING</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <br> <br> <br>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ ($title ==="Home") ? 'active' : '' }}" href="/">Picking Part</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title ==="Compare") ? 'active' : '' }}"href="/compare">Compare Part</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title ==="record") ? 'active' : '' }}"href="/record">Sorting Record</a> 
        </li>
      </ul>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
        <form class="d-flex">
          <ion-icon name="log-out-outline"></ion-icon>
        </form>

        <ul class="navbar-nav ms-auto"> 
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome {{auth()->user()->name}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-card-list"></i>Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item"> <i class="bi bi-box-arrow-left">
                    </i>Logout</a></button>
                </form>
              </li>
            </ul>
          </li>
        @else    
        <li class="nav-item"> 
            <a href="/login" class="nav-link {{ ($title ==="login") ? 'active' : '' }}"> 
              <i class="bi bi-box-arrow-in-right"></i>
                Login
            </a>
        </li>
        @endauth
      </ul>

      </div>
    </div>

  </nav> --}}



 <!-- Logout Modal-->
    {{-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action ="/logout" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
      </form>
    </div> --}}



{{-- TEMPLATE HORIZONTAL --}}

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard | MC Sorting Part</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/owl.carousel.css">
    <link rel="stylesheet" href="{{asset ('') }}css/owl.theme.css">
    <link rel="stylesheet" href="{{asset ('') }}css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/notika-custom-icon.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}ss/wave/waves.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset ('') }}css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
   
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a style ="color:white" href="#"><i class="bi bi-box-seam-fill"></i>MC SORTING PART</a> 
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" />
                                    </div>
                                </div>
                            </li>
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->


    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Home</a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="index.html">Dashboard One</a></li>      
                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" data-target="#democrou" href="#">Register Part</a>
                                    <ul id="democrou" class="collapse dropdown-header-top">
                                    <li><a href="animations.html">Input Data</a>
                                     </li>
                                    <li><a href="google-map.html">Record Data</a>
                                    </li>
                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" data-target="#demoevent" href="#">Picking Part</a>
                                    <ul id="demoevent" class="collapse dropdown-header-top">
                                    <li><a href="form-elements.html">Form Elements</a>
                                    </li>  
                                    </ul>
                                </li>
                             
                                <li><a data-toggle="collapse" data-target="#demolibra" href="#">Sorting Part</a>
                                    <ul id="demolibra" class="collapse dropdown-header-top">
                                    <li><a href="alert.html">Alerts</a>
                                   </li>
                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" data-target="#demodepart" href="#">Record Data</a>
                                    <ul id="demodepart" class="collapse dropdown-header-top">
                                        <!-- <li><a href="flot-charts.html">Flot Charts</a>
                                </li> -->
                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" data-target="#demo" href="#">Manual Instruction</a>
                                    <ul id="demo" class="collapse dropdown-header-top">
                                        <li><a href="form-elements.html">Form Elements</a></li>
                                        <li><a href="form-components.html">Form Components</a></li>
                                        <li><a href="form-examples.html">Form Examples</a></li>
                                    </ul>
                                </li>
                            
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MOBILE MENU END -->


    <!-- MAIN MENU AREA START-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="active"><a data-toggle="tab" href="#Home"><i class="notika-icon notika-house"></i> Home</a>
                        </li>

                        <li><a data-toggle="tab" href="#Register_part"><i class="notika-icon notika-edit"></i> Register Part</a>
                        </li>

                        <li><a data-toggle="tab" href="#Forms"><i class="notika-icon notika-form"></i> Picking Part</a>
                        </li>
                        <li><a data-toggle="tab" href="#SortingPart"><i class="notika-icon notika-app"></i>Sorting Part</a>
                        </li>
                        <li><a data-toggle="tab" href="#RecordData"><i class="notika-icon notika-windows"></i> Record Data</a>
                        </li>
                        <li><a data-toggle="tab" href="#Forms"><i class="notika-icon notika-form"></i>Manual Instruction</a>
                        </li>
                      
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                               
                                <li><a href="index-2.html">Dashboard Two</a>
                                </li>
                              
                            </ul>
                        </div>

                        <div id="Register_part" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="animations.html">Input Data</a>
                                </li>
                                <li><a href="google-map.html">Record Data</a>
                                </li>
                               
                            </ul>
                        </div>

                        <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="form-elements.html">Form Elements</a>
                                </li>                              
                            </ul>
                        </div>

                        
                        <div id="RecordData" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <!-- <li><a href="flot-charts.html">Flot Charts</a>
                                </li> -->
                            </ul>
                        </div>

                       

                        <div id="Tables" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="normal-table.html">Normal Table</a>
                                </li>
                                <li><a href="data-table.html">Data Table</a>
                                </li>
                            </ul>
                        </div>
                       
                        <!-- Sorting part -->
                        <div id="SortingPart" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">     
                                <li><a href="alert.html">Alerts</a>
                                </li>
                            </ul>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MAIN MENU AREA END-->
    
   
    <!-- Start Footer area-->
   
    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
    <script src="{{asset ('') }}js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset ('') }}js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset ('') }}js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{asset ('') }}js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{asset ('') }}js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset ('') }}js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{asset ('') }}js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{asset ('') }}js/counterup/jquery.counterup.min.js"></script>
    <script src="{{asset ('') }}js/counterup/waypoints.min.js"></script>
    <script src="{{asset ('') }}js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{asset ('') }}js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- jvectormap JS
		============================================ -->
    <script src="{{asset ('') }}js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{asset ('') }}js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{asset ('') }}js/jvectormap/jvectormap-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{asset ('') }}js/sparkline/jquery.sparkline.min.js"></script>
    <script src="{{asset ('') }}js/sparkline/sparkline-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{asset ('') }}js/flot/jquery.flot.js"></script>
    <script src="{{asset ('') }}js/flot/jquery.flot.resize.js"></script>
    <script src="{{asset ('') }}js/flot/curvedLines.js"></script>
    <script src="{{asset ('') }}js/flot/flot-active.js"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{asset ('') }}js/knob/jquery.knob.js"></script>
    <script src="{{asset ('') }}js/knob/jquery.appear.js"></script>
    <script src="{{asset ('') }}js/knob/knob-active.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{asset ('') }}js/wave/waves.min.js"></script>
    <script src="{{asset ('') }}js/wave/wave-active.js"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{asset ('') }}js/todo/jquery.todo.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{asset ('') }}js/plugins.js"></script>
	<!--  Chat JS
		============================================ -->
    <script src="{{asset ('') }}js/chat/moment.min.js"></script>
    <script src="{{asset ('') }}js/chat/jquery.chat.js"></script>
    <!-- main JS
		============================================ -->
    <script src="{{asset ('') }}js/main.js"></script>
	<!-- tawk chat JS
		============================================ -->
    <script src="{{asset ('') }}js/tawk-chat.js"></script>
</body>

</html>