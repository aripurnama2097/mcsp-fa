{{-- TEMPLATE HORIZONTAL --}}
{{--  --}}
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>MCSP</title>
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
                       
                        {{-- @auth
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Welcome {{auth()->user()->name}}
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                         
                             <li><hr class="dropdown-divider"></li>
                             <li>
                               <form action="{{url('/logout')}}" method="post">
                                 @csrf
                                 <button type="submit" class="dropdown-item"> <i class="bi bi-box-arrow-left">
                                   </i>Logout</a></button>
                               </form>
                             </li>
                           </ul>
                         </li>
                       @else    
                     <li class="nav-item"> 
                            <a href="{{url('/login')}}" class="nav-link "> 
                                <i class="bi bi-arrow-left-square"></i>
                                Back To Home
                            </a>
                        </li>
                     
                     @endauth      --}}
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
    <!-- End Header Top Area -->


    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu mean-bar">
                        <nav class="navbar navbar-dark bg-dark">
                            {{-- <div class="container-fluid"> --}}
                              <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                              </button>
                            {{-- </div> --}}
                          </nav>
                        <div class="collapse" id="navbarNav">
                            <div class="bg-dark p-4 text-white">
                            <ul class="mobile-menu-nav">
                                <li><a class="nav-link"   class="text-white" href="{{url('/register_part')}}">HOME</a>
                                </li>
                                <br>
                                <li><a  class="nav-link"  class="text-white" href="{{url('/register_part')}}">REGISTER PART</a>
                                </li>
                                <br>
                                <li><a  class="nav-link"  href="{{url('./picking')}}" class="text-white" >PICKING </a>
                                </li>
                                <br>                          
                                <li><a class="nav-link" href="{{url('./sorting')}}" class="text-white">SORTING</a>                                 
                                </li>
                                <br>
                                <li><a   class="nav-link" href="{{url('./record')}}" class="text-white">RECORD DATA</a>
                                </li>
                                <br>
                                <li><a   class="nav-link" src="{{asset('')}}storage/sound/OK.mp3"class="text-white">MANUAL INSTRUCTION</a>
                                </li>
                            </ul>
                            </div>
                          </div>          
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
                        <a href="{{url('')}}" style="font-weight:bold" > <i class="bi bi-house"></i> HOME</a>
                      </li>        
                      <li>
                        <a   href="{{url('./login')}}" style="font-weight:bold"><i class="bi bi-pencil-square"></i>REGISTER PART</a>
                      </li>
                      <li>
                        <a  href="{{url('./picking')}}" style="font-weight:bold"><i class="bi bi-box2"></i>PICKING PART</a>
                      </li>

                      <li>
                        <a href="{{url('./sorting')}}"style="font-weight:bold"><i class="bi bi-boxes"></i>SORTING PART</a>
                      </li>
                     
                      <li>
                        <a  href="{{url('./record')}}" style="font-weight:bold"><i class="notika-icon notika-form"></i>RECORD DATA</a>
                      </li>       
                      <li>
                        <a href="{{asset('')}}storage/WI/WI_MCSP.pdf" style="font-weight:bold"><i class="bi bi-stickies-fill"></i>MANUAL INSTRUCTION</a>
                      </li>  

                    </ul>

                 
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
    
   

   
    @include('layouts.script')

    <script>
        $(document).ready(function(){
          $('.nav-link').click(function(){
            $('.collapse').collapse('hide');
          });
        });
     </script>
</body>
@include('layouts.footer')
</html>
