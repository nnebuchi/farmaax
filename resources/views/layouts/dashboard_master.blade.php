@php
    use App\FarmSetUp;
    use App\LandCart;

    $myFarmCartCount  = FarmSetUp::where(['owner_id'=> Auth::user()->id, 'status'=>'pending'])->count();
    $landCartCount = LandCart::where('user_id', Auth::user()->id)->count();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="{{ asset('user-dashboard/js/jquery.js') }}"></script>
    <script src="{{ asset('user-dashboard/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user-dashboard/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user-dashboard/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('user-dashboard/css/styles.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('store_assets/img/logo.png') }}"/>
    <script>
        var url = "{{ url('/') }}";
        var universal_token = '<?php echo csrf_token();?>';
    </script>
     {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
     {{--  <script type="text/javascript">
        var url = "{{ url('/') }}";
        
    </script>  --}}  
    
</head>

<body>


    <div class="sidebar-panel">
        <div class="row">
            <div class="col-sm-6">
                <button class="closeing mt-5">
                    <i class="closeFontIcon fa fa-times menu-icon fa-2x" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-center navbar-brand pl-2"><a href="{{ url('/') }}"><img src="{{ asset('images/logo/logo.png') }}" width="150" class="img-fluid" alt=""></a></div>

        <div class="col-sm-12">
            <div class="sidelistwrp">
                <ul>
                    <li class="pl-2"><a href="{{ url('dashboard') }}" class="text-white">Dashboard</a></li>
                    <li class="pl-2"><a href="{{ url('myfarms') }}" class="text-white">My Farm</a></li>
                    <li class="pl-2"><a href="{{ url('my-lands') }}" class="text-white">Purchased Lands</a></li>
                    {{-- <li class="pl-2">My Account</li>
                    <li class="pl-2">LiveChat</li>
                    <li class="pl-2">Blog</li> --}}
                    <li class="pl-2 bg-white"><a href="{{ url('logout') }}" class="text-danger">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>




    <nav class="navbar navbar-expand navbar-light bg-transparent sticky-top">
        <button class="opennav">
            <i class="text-dark myFontBars fa fa-bars menu-icon fa-2x" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand pl-2"><a href="{{ url('/') }}"><img src="{{ asset('images/logo/logo.png') }}" width="150"
                class="img-fluid" alt=""></a></div>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link myNavlink" href="{{ url('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link myNavlink" href="{{ route('myfarmsetups') }}">My Farm</a>
            </li>
            <li class="nav-item">
               <a href="{{ route('myLands') }}" class="nav-link myNavlink">Purchased Lands</a>
            </li>


        </ul>



        <div class="ml-auto">
            {{-- <i class="myFontIcon fas fa-envelope"></i> --}}
            {{-- <a href="{{ route('viewcart') }}" class="mr-3 mr-md-0"> <i class="myFontIcon fas fa-shopping-cart text-dark"> <span
                        class=" badge badge-warning nav-icon"
                        style="position: absolute; top: 20;  font-size: 10px;">{{ cartCount($_COOKIE['guest']) }}</span></i>
            </a> --}}

            <a href="{{ route('myfarmcart') }}" class="mr-3 mr-md-0"> <i class="myFontIcon fas fa-tree text-dark"> <span
                        class=" badge badge-warning nav-icon"
                        style="position: absolute; top: 20;  font-size: 10px;">{{  $myFarmCartCount }}</span></i>
            </a>

            <a href="{{ route('landcart') }}" class="mr-3 mr-md-0"> <i class="myFontIcon fas fa-briefcase text-dark"> <span
                        class=" badge badge-warning nav-icon" style="position: absolute; top: 20;  font-size: 10px;">{{  $landCartCount}}</span></i>
            </a>

            <a href="{{ route('farmcart') }}" class="mr-3 mr-md-0"> <i class="myFontIcon fas fa-handshake text-dark"> <span
                        class=" badge badge-warning nav-icon"
                        style="position: absolute; top: 20;  font-size: 10px;">{{ Auth::user()->investment_cart->count() }}</span></i>
            </a>
            <a href="{{ route('logout') }}"> <i class="myFontIcon text-dark fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="black-overlay"></div>
        <div class="container-fluid">
            @include('layouts.messages')
            @yield('content')
            

        </div>
        <section class="bg-dark py-5 mt-3">
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

                  .mySocial a i{
                        font-size:25px;
                        color:#fff!important;
                        margin-top:10px;
                        margin-right: 10px;
                        
                    }

                    @media (min-width: 768px) {
                    .blog-entry {
                        margin-bottom: 30px;
                    }
                }
                @media (max-width: 767.98px) {
                    .blog-entry {
                        margin-bottom: 30px;
                    }
                }
                .blog-entry .text {
                    position: relative;
                    background: #fff;
                    width: 100%;
                    margin: 0 auto;
                }
                .blog-entry .text .topper {
                    margin-top: -61px;
                    position: absolute;
                    top: 0;
                    left: 20px;
                    background: #4e9525;
                }
                .blog-entry .text .topper:after {
                    position: absolute;
                    bottom: -10px;
                    left: 40px;
                    content: "";
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 10px 10px 0 10px;
                    border-color: #4e9525 transparent transparent transparent;
                }
                .blog-entry .text .heading {
                    font-size: 18px;
                    margin-bottom: 16px;
                    font-weight: 500;
                }
                .blog-entry .text .heading a {
                    color: #000000;
                }
                .blog-entry .text .heading a:hover,
                .blog-entry .text .heading a:focus,
                .blog-entry .text .heading a:active {
                    color: #4e9525;
                }
                .blog-entry .meta > div {
                    display: inline-block;
                    margin-right: 5px;
                    margin-bottom: 0;
                    font-size: 14px;
                }
                .blog-entry .meta > div a {
                    color: gray;
                    font-size: 15px;
                }
                .blog-entry .meta > div a:hover {
                    color: #666666;
                }
                .blog-entry .one {
                    width: 70px;
                }
                .blog-entry .two {
                    width: calc(100% - 70px);
                }
                .blog-entry span.day {
                    font-size: 44px;
                    font-weight: 300;
                    color: #fff;
                    line-height: 1;
                }
                .blog-entry span.yr,
                .blog-entry span.mos {
                    font-size: 13px;
                    line-height: 1.6;
                    display: block;
                    color: rgba(255, 255, 255, 0.7);
                }

                .block-23 ul {
                    padding: 0;
                }
                .block-23 ul li,
                .block-23 ul li > a {
                    display: table;
                    line-height: 1.5;
                    margin-bottom: 15px;
                }
                .block-23 ul li span {
                    color: rgba(255, 255, 255, 0.7);
                }
                .block-23 ul li .icon,
                .block-23 ul li .text {
                    display: table-cell;
                    vertical-align: top;
                }
                .block-23 ul li .icon {
                    width: 40px;
                    font-size: 18px;
                    padding-top: 2px;
                    color: white;
                }

                .block-27 ul {
                    padding: 0;
                    margin: 0;
                }
                .block-27 ul li {
                    display: inline-block;
                    margin-bottom: 4px;
                    font-weight: 400;
                }
                .block-27 ul li a,
                .block-27 ul li span {
                    color: gray;
                    text-align: center;
                    display: inline-block;
                    width: 40px;
                    height: 40px;
                    line-height: 40px;
                    border-radius: 50%;
                    border: 1px solid #e6e6e6;
                }
                .block-27 ul li.active a,
                .block-27 ul li.active span {
                    background: #4e9525;
                    color: #fff;
                    border: 1px solid transparent;
                }

                /*footer{
                    color: red!important;
                }*/
            </style>
        </section>
    {{-- </div> --}}


    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script> --}}







    <script>
        $(document).ready(function() {
            $('.opennav').click(function() {
                $('.sidebar-panel').addClass('activate');
                $('.sidebar-panel').removeClass('unactivate');
                $('.black-overlay').addClass('dark');
            });

            $('.closeing').click(function() {
                $('.sidebar-panel').addClass('unactivate');
                $('.sidebar-panel').removeClass('activate');
                $('.black-overlay').removeClass('dark');
            });

            $('.black-overlay').click(function() {
                $('.black-overlay').removeClass('dark');
                $('.sidebar-panel').addClass('unactivate');
            });
        });

    </script>



    <script type="text/javascript">

      function clickToCopy() {

              /* Get the text field */

              var copyText = document.getElementById("click-to-copy");



              /* Select the text field */

              copyText.select();

              copyText.setSelectionRange(0, 99999); /*For mobile devices*/



              /* Copy the text inside the text field */

              document.execCommand("copy");



              /* Alert the copied text */

              alert("referral link copied");

            }

    </script>
</body>

</html>