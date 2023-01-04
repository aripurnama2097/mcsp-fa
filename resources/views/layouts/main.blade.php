{{-- TEMPLATE HORIZONTAL --}}
{{--  --}}
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dashboard | MC Sorting Part</title>
  <meta name="description" content="">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  


  @include('layouts.css')
</head>

<body>
    <script src="{{asset ('') }}js/vendor/jquery-1.12.4.min.js"></script>
  
    <!-- Start Header Top Area -->
    <div class="header-top-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <div class="logo-area">
                      <a style="font-size:30px ;  color:white; text-align:center" class="justify-content-center" href="#" style="font-weight:bold"><i class="notika-icon notika-windows"></i> MCSP</a> 
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
                                <li><a data-toggle="collapse" data-target="{{url('layouts.main')}}" href="#">Home</a>
                                </li>

                                <li><a data-toggle="collapse" data-target="#democrou" href="#">Register Part</a>
                                    <ul id="democrou" class="collapse dropdown-header-top">
                                    <li><a href="{{url('/register_part')}}">REGISTER PART</a>
                                     </li>
                                    </ul>
                                </li>

                                <li><a  class="text-bold" href="{{url('./picking')}}">PICKING </a>
         
                                </li>
                             
                                <li><a data-target="#demolibra" href="{{url('./sorting')}}">Sorting Part</a>
                                    {{-- <ul id="demolibra" class="collapse dropdown-header-top">
                                    <li><a href="alert.html">Alerts</a>
                                   </li>
                                    </ul> --}}
                                </li>

                                <li><a  data-target="#demodepart" href="{{url('./record')}}">Record Data</a>
                                    <ul id="demodepart" class="collapse dropdown-header-top">
                                        <!-- <li><a href="flot-charts.html">Flot Charts</a>
                                </li> -->
                                    </ul>
                                </li>

                                <li><a data-toggle="collapse" data-target="#demo" href="#">Manual Instruction</a>
                                    <ul id="demo" class="collapse dropdown-header-top">

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
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro ">

                      <li class="active bg-green">
                        <a data-toggle="tab" href="#Home" style="font-weight:bold" > <i class="notika-icon notika-house background-color:white text-bold"></i> HOME</a>
                      </li>        
                      <li>
                        <a   href="{{url('/register_part')}}" style="font-weight:bold"><i class="notika-icon notika-edit"></i></i>REGISTER PART</a>
                     
                      </li>
                      <li>
                        <a  href="{{url('./picking')}}" style="font-weight:bold"><i class="notika-icon notika-windows"></i>PICKING PART</a>
                      </li>

                      <li>
                        <a href="{{url('./sorting')}}"style="font-weight:bold"><i class="notika-icon notika-app"></i>SORTING PART</a>
                      </li>
                      <li>
                        <a  href="{{url('./record')}}" style="font-weight:bold"><i class="notika-icon notika-windows"></i>RECORD DATA</a>
                      </li>
                      <li>
                        <a data-toggle="tab" href="#Forms" style="font-weight:bold"><i class="notika-icon notika-form"></i>MANUAL INSTRUCTION</a>
                      </li>       
                    </ul>

                    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                          <a class="navbar-brand" href="#">Navbar</a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-link active" aria-current="page" href="#">Home</a>
                              <a class="nav-link" href="#">Features</a>
                              <a class="nav-link" href="{{url('/register_part')}}">Pricing</a>
                              <a class="nav-link disabled">Disabled</a>
                            </div>
                          </div>
                        </div>
                    </nav> --}}
                    <div class="tab-content custom-menu-content">
                        <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown  ">                             
                                <li><a href="{{url('/home')}}"></a>
                                </li>
                              
                            </ul>
                        </div>

                        <div id="Register_part" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown  ">
                                <li class="text-primary"><a href="">REGISTER PART</a>
                                </li>
                            </ul>
                        </div>

                        <div id="Picking" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown  ">
                                <li><a href="">PARTLIST</a>
                                </li>                              
                            </ul>
                        </div>
                     
                        <div id="RecordData" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown  ">
                                <!-- <li><a href="flot-charts.html">Flot Charts</a>
                                </li> -->
                            </ul>
                        </div>

                      
                        <div id="Tables" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown ">
                                <li><a href="normal-table.html">Normal Table</a>
                                </li>
                                <li><a href="data-table.html">Data Table</a>
                                </li>
                            </ul>
                        </div>
                       
                        <!-- Sorting part -->
                        <div id="SortingPart" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown ">     
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
     
    @yield('section')
   
    <!-- Start Footer area-->
   
  
    <!-- End Footer area-->
    
   

    @include('layouts.footer')
    @include('layouts.script')
</body>
</html>
