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
                    @auth
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             Welcome {{auth()->user()->name}}
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                             {{-- <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-card-list"></i>Dashboard</a></li> --}}
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
                       {{-- <li class="nav-item"> 
                          <a href="{{url('/login')}}" class="nav-link "> 
                           <i class="bi bi-box-arrow-in-right"></i>
                             Login
                         </a>
                     </li> --}}
                     @endauth   
                      </ul>

                     
                  </div>
              </div>
             
          </div>
      </div>
  </div>
    <!-- End Header Top Area -->



    <!-- MAIN MENU AREA START-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro ">

                     
                      
                      <li class="active bg-green">
                        <a  href="{{url('/home')}}" style="font-weight:bold" > <i class="notika-icon notika-house background-color:white text-bold"></i> HOME</a>
                      </li>        
                      <li>
                        <a   href="{{url('/register_part')}}" style="font-weight:bold"><i class="notika-icon notika-edit"></i></i>REGISTER PART</a>
                      </li>            
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
