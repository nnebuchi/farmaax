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
    <title>@yield('title', 'Welcome to Farmaax')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body>

    <script>
        var url = "{{ url('/') }}";
        var universal_token = '<?php echo csrf_token();?>';
    </script>
    <style>
        #testimony {
            height: 410px !important
        }

        .social-icon {
            background-color: #f6f6f6 !important;
        }

        .social-icon:hover {
            background-color: #4e9525 !important;
        }

        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        /* display 3 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }

        .myBorder {
            border: solid 10px #4e9525 !important;
            border-radius: 100px !important;
        }

    </style>
    @guest

            <div class="pt-1 bg-white d-none d-md-block">
                <div class="row justify-content-between px-5 py-3">
                    <div class="col-md-8 order-md-last">
                        <div class="row mobile-no-pad">

                            <div class="col-md-6 offset-md-6 d-md-flex justify-content-end mb-md-0 mb-3">
                                <form action="#" class="searchform order-lg-last mobile-hide">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control pl-3" placeholder="Search">
                                        <button type="submit" placeholder="" class="form-control search"><span
                                                class="fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex mobile-hide">
                        <div class="social-media">
                            <p class="mb-0 d-flex">
                                <a href="https://www.linkedin.com/company/farmaax"
                                    class="d-flex align-items-center justify-content-center social-icon"><span
                                        class="social-icon fa fa-linkedin"><i class="sr-only">Linkedin</i></span></a>
                                <a href="https://twitter.com/farmaax"
                                    class="d-flex align-items-center social-icon justify-content-center"><span
                                        class="social-icon fa fa-twitter social-icon"><i
                                            class="sr-only">Twitter</i></span></a>
                                <a href="https://instagram.com/farmaax_"
                                    class="d-flex align-items-center justify-content-center social-icon"><span
                                        class="social-icon fa fa-instagram social-icon"><i
                                            class="sr-only">Instagram</i></span></a>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container-fluid">
                <a class="navbar-brand logo ml-3" href="{{ url('/') }}"><img src="{{ url('images/logo.jpg') }}"
                        height="100" width="100" class="rounded-circle"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="{{ route('lands.index') }}" class="nav-link">Farmaax Lands</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About-Us</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Services</a></li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->firstName }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="#">Action</a>
                                    {{-- <a class="dropdown-item" href="#">Another action</a> --}}
                                                                                        {{-- <div class="dropdown-divider"></div>  --}}
                                                                                        <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                                </div>
                            </li>
                            {{--
                            <li class="nav-item ml-5"><a href="{{ url('farmcart') }}" class="nav-link"
                                    style="font-weight: bold; font-size: 25px;"><i class="fa fa-shopping-cart"></i><span
                                        class="badge badge-warning"
                                        style="position: absolute; top: 20;  font-size: 10px;">{{ $count_cart }}</span></a>
                            </li>
                            --}}
                            <li class="nav-item"><a href="{{ route('farmcart') }}" class="nav-link">
                                    <i class="fa fa-shopping-cart fa-2x" aria-hidden="true">
                                        <span class=" ml-1 badge badge-warning"
                                            style="position: absolute; top: 20;  font-size: 10px;">{{ $count_cart }}</span></i>
                                </a></li>
                        @endauth
                        @guest
                            <li class="nav-item"><a href="" class="nav-link">Contact</a></li>
                        @endguest

                    </ul>


                    @guest
                        <a href="{{ route('register') }}" class="primary-btn btn ">Register</a>
                        <a href="{{ route('login') }}" class="secondary-btn btn btn-start ml-3">Login</a>
                    @endguest
                    @auth
                        <a href="{{ route('home') }}" class="secondary-btn btn ">Dashboard</a>

                    @endauth
                </div>
            </div>
        </nav>
        <!-- END nav -->
        <div class="container-fluid">
               @include('layouts.messages')
        @yield('content')
        </div>




        <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-6 col-lg">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="logo"><a href="#">Far<span>Maax</span></a></h2>
                            <p>Farmaax is an Agricultural real estate, farming and farm investment company. We are
                                giving
                                you the opportunity to purchase farmland, invest in a farm or start your personal farm
                                projects using your mobile device.</p>
                            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                                <li class="ftco-animate"><a href="https://twitter.com/farmaax"><span
                                            class="icon-twitter"></span></a></li>
                                {{-- <li class="ftco-animate"><a href="#"><span
                                            class="icon-facebook"></span></a></li> --}}
                                <li class="ftco-animate"><a href="https://instagram.com/farmaax_"><span
                                            class="icon-instagram"></span></a></li>
                                <li class="ftco-animate"><a href="https://www.linkedin.com/company/farmaax"><span
                                            class="icon-linkedin"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ftco-footer-widget mb-4 ml-md-5">
                            <h2 class="ftco-heading-2">Services</h2>
                            <ul class="list-unstyled">
                                <li><a href="{{ url('about/farmsetup') }}" class="py-1 d-block"><span
                                            class="ion-ios-arrow-forward mr-3"></span>Farm
                                        Setup</a></li>
                                <li><a href="{{ url('about/partnershipfarming') }}" class="py-1 d-block"><span
                                            class="ion-ios-arrow-forward mr-3"></span>Partnership/Investment Farming</a>
                                </li>
                                <li><a href="{{ route('farms.index') }}" class="py-1 d-block"><span
                                            class="ion-ios-arrow-forward mr-3"></span>Own a
                                        farmland</a></li>
                                <li><a href="{{ route('lands.create') }}" class="py-1 d-block"><span
                                            class="ion-ios-arrow-forward mr-3"></span>Sell
                                        Land on Farmaax</a></li>
                                <li><a href="{{ route('upgrade') }}" class="py-1 d-block"><span
                                            class="ion-ios-arrow-forward mr-3"></span>Become
                                        a realtor/consultant</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Contact information</h2>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><span class="icon icon-map-marker"></span><span class="text">
                                            2C Road 23, Ikota Villa Off Lagos/ Epe Road Eti- Osa Local Government Area,
                                            Lagos State.</span></li>
                                    <li><a href="tel://+2349079935884"><span class="icon icon-phone"></span><span
                                                class="text">+2349079935884</span></a></li>
                                    <li><a href="#"><span class="icon icon-envelope"></span><span
                                                class="text">info@yourdomain.com</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Business Hours</h2>
                            <div class="opening-hours">
                                <h4>Opening Days:</h4>
                                <p class="pl-3">
                                    <span>Monday – Friday : 9am to 20 pm</span>
                                    <span>Saturday : 9am to 17 pm</span>
                                </p>
                                <h4>Vacations:</h4>
                                <p class="pl-3">
                                    <span>All Sunday Days</span>
                                    <span>All Official Holidays</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">

                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());

                            </script> All rights reserved | Powered By Lariox
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </footer>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div>



    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

    </script>

</body>

</html>
