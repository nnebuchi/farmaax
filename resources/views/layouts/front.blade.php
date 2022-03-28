@php
use App\Investment_cart;
@endphp
@auth
    @php

    $farmcart=Investment_cart::where('user_id', Auth::user()->id)->get();
    $count_cart=count($farmcart);

    @endphp
@endauth
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Farmaax')</title>
    {{-- <script src="./js/jquery-3.2.1.min.js"></script> --}}
    <script src="{{ asset('user-dashboard/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.bundle.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css')}}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/buchi.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('store_assets/img/logo.png') }}"/>
    {{-- <link rel="stylesheet" href="./assets/css/nnesco.css"> --}}
</head>
<body>


    <script>
        var url = "{{ url('/') }}";
        var universal_token = '<?php echo csrf_token();?>';
    </script>
    <header class="myHeaderCustom">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/logo/logo.png') }}" width="150px" alt=""></a>
       <span class="d-block d-lg-none">
            @guest
                <a class=" btn-outline-success text-decoration-none  mySuccess my-2 my-sm-0" href="{{ route('register') }}">Signup</a>
                <a class=" btn-outline-success text-decoration-none mySuccess my-2 my-sm-0" href="{{ route('login') }}">Login</a>

            @else
                <a class=" btn-outline-success text-decoration-none mySuccess my-2 my-sm-0" href="{{ route('home') }}">Dashboard</a>

            @endguest
       </span>
        
        <button class="navbar-toggler outline-0 d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <i class="myBars fas fa-bars"></i>
        </button>

                 
        <div class="collapse navbar-collapse pt-lg-4" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 myNavbarNavLink">
                <li class="nav-item mb-2 mb-lg-0 active">
                    <a class="nav-link myLink" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mb-2 mb-lg-0">
                    <a class="nav-link myLink" href="{{ url('about-farmaax') }}">About</a>
                </li>
                {{-- <li class="nav-item mb-2 mb-lg-0 myDropdownLink dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="myAnchor dropdown-item" href="#">Action 1</a>
                        <a class="myAnchor dropdown-item" href="#">Action 2</a>
                    </div>
                </li> --}}
                <li class="nav-item mb-2 mb-lg-0"><a href="{{ url('store') }}" class="nav-link myLink">Store</a></li>
                
                {{-- <li class="nav-item mb-2 mb-lg-0"><a href="" class="nav-link myLink">Blog</a></li> --}}
            </ul>
            <div class="form-inline my-2 my-lg-0">

               <span class="myFontawesome d-none d-lg-block">
                    <a target="_blank" href="https://twitter.com/farmaax"><i class="fab fa-twitter"></i></a>
                    <a target="_blank" href="https://instagram.com/farmaax_"><i class="fab fa-instagram"></i></a>
                    <a target="_blank" href="https://www.linkedin.com/company/farmaax"><i class="fab fa-linkedin"></i></a>
                    <a target="_blank" href="https://www.facebook.com/farmaax"><i class="fab fa-facebook"></i></a>
               </span>
               <span class="d-none d-lg-block">
                  @guest
                <a class=" btn-outline-success text-decoration-none  mySuccess my-2 my-sm-0" href="{{ route('register') }}">Signup</a>
                <a class=" btn-outline-success text-decoration-none mySuccess my-2 my-sm-0" href="{{ route('login') }}">Login</a>

                @else
                    <a class=" btn-outline-success text-decoration-none mySuccess my-2 my-sm-0" href="{{ route('home') }}">Dashboard</a>

                @endguest 
               </span>
                



        </div>
        </div>
    </nav>
    </header>
    
         @include('layouts.messages')
        @yield('content')




        
    <section>
        <footer>
            <div class="containe">
                <div class="row myRowPadding px-md-5 pl-sm-5 px-3">
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3 text-justify">
                        <div class="">
                            <a href="{{ url('/') }}"><img src="{{ asset('images/logo/logo.png') }}" width="90px" alt=""></a>
                        </div>
                        {{-- <div class="h6 myquicksize text-white myAmaranth">About Farmaax</div> --}}

                        <p class="text-justify text-white myAboutSpace">Farmaax is a digital platform that helps you access agricultural resources to help you own and run a farm. Build your farm project working with your farm manager while you select your preferred crops to cultivate. </p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-3 mt-lg-0 text-center text-lg-left text-md-left text-sm-left">
                        <div class="row">
                           <div class="col-12 col-sm-6 col-lg-12">
                                <div class="h6 myquicksize text-white myAmaranth mb-4 mt-4 mt-sm-0 mt-lg-4 mb-lg-4 mb-sm-0"><h3>Quick links</h3></div>
                               <div class="myPaddingA mt-md-3"><a href="{{ url('start-farm') }}" class="text-decoration-none text-white">Farm setup</a></div>
                               <div class="myPaddingA"><a href="{{ url('farms') }}" class="text-decoration-none text-white">Partnership/Investment Farm </a></div>
                              <div class="myPaddingA"> <a href="{{ url('lands') }}" class="text-decoration-none text-white">Farmland</a></div>
                               <div class="myPaddingA"><a href="{{ url('upgrade-account') }}" class="text-decoration-none text-white">Become Farm Manager </a></div>
                               <div class="myPaddingA"><a href="{{ url('lands/create') }}" class="text-decoration-none text-white">Sell Land On Farmaax</a></div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="h6 myquicksize text-white myAmaranth mb-4 mt-4 mt-sm-0 mt-lg-4 mb-lg-4 mb-sm-0"><h3>Company</h3></div>

                               <div class="myPaddingA mt-md-3"> <a href="#" class="text-decoration-none text-white">About</a></div>
                                <div class="myPaddingA"><a href="#" class="text-decoration-none text-white">Contact</a></div>
                                <div class="myPaddingA"><a href="#" class="text-decoration-none text-white">Privacy and policy</a></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-lg-4 mb-3 mt-5 mt-lg-0 text-lg-left text-sm-left text-md-center text-center">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-12">
                            
                                <div class="myAmaranth myNewsletter text-uppercas text-white"><h3>Subcribe to our newsletter</h3></div>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <div class="input-group mb-3 pt-4">
                                            <input type="text" class="form-control myFormcontrol" placeholder="Email address" aria-label="" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                              <button class="input-group-text btn btn-success" id="basic-subBtn">Subcribe</button>
                                            </div>
                                          </div>
                                          
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-12">
                                <div class="h6 text-capitalize pt-3 myquicksize myAmaranth text-white"><h3>contact us today</h3></div>
                                  <div class="text-white py-1">+2349079935884</div>
                                  <div class="text-white py-1">info@farmaax.com</div>
                                  <span class="mySocial">
                                {{-- <a href="#"><i class="fab fa-facebook-square"></i></a> --}}
                                    <a target="_blank" href="https://twitter.com/farmaax"><i class="fab fa-twitter-square"></i></a>
                                    <a target="_blank" href="https://instagram.com/farmaax_"><i class="fab fa-instagram"></i></a>
                                    <a target="_blank" href="https://www.linkedin.com/company/farmaax"><i class="fab fa-linkedin"></i></a>
                                </span>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </footer>


        <style type="text/css">
            .primary-btn{
        background-color: #4e9525;
        color: white!important;
        border: 2px solid #eed240;

      }
      .primary-btn:hover{
        background-color: white!important;
        color: #4e9525!important;
        border: 2px solid #eed240;

      }
        </style>
    </section>
    <!-- footer section end -->

    <script>
        $('#recipeCarousel').carousel({
      interval: 10000
    })
    
    $('.carousel .carousel-item').each(function(){
        var minPerSlide = 3;
        var next = $(this).next();
        if (!next.length) {
        next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        
        for (var i=0;i<minPerSlide;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
              }
            
            next.children(':first-child').clone().appendTo($(this));
          }
    });
    </script>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '195104185651203');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=195104185651203&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
</body>

</html>
