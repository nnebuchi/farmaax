
    {{-- @php

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $root = (isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'];

        $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    @endphp

    @if ($actual_link = $root.'store/viewcart')
        @php dd( $actual_link) @endphp
    @else
         @php dd( $root) @endphp
    @endif --}}
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>@yield('title', 'Store')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('store_assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('store_assets/css/style.css') }}" type="text/css">
    <link rel="shortcut icon" type="image/png" href="{{ asset('store_assets/img/logo.png') }}"/>
</head>

<body style="background-color: #f8f4e7;">

    <script>
        var url = "{{ url('/') }}";
        var universal_token = '<?php echo csrf_token();?>';
    </script>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <!-- <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div> -->
        <nav class="humberger__menu__nav mobile-menu">
            <span class="float float-right border px-2 close-humberger"><i class="fa fa-close text-dark"></i></span>
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('store') }}">Shop</a></li>
                {{-- <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li> --}}
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                {{-- <li><a href="./contact.html">Contact</a></li> --}}
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <!-- <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div> -->
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header" style="background-color: #f8f4e7;">
       
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-4 col-5">
                    <div class="header__logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('store_assets/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-8 col-7">
                    <nav class="header__menu">
                        <!-- <a class="navbar-brand" href="#"><img src="img/logo.png" width="150" alt=""></a> -->
                         <ul>
                            <li class="active"><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('store') }}">Shop</a></li>
                            {{-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> --}}
                            @guest
                                <li><a href="{{ url('login') }}">Login</a></li>
                            @else
                                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>

                            @endguest
                            
                            {{-- <li><a href="./contact.html">Contact</a></li> --}}
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            
                            <li><a href="{{ route('viewcart') }}" class="cart-link"><i class="fa fa-shopping-cart cart-link"></i> <span id="cart-count">{{ cartCount($_COOKIE['guest']) }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">Cart Worth: &#8358; <span id="cart-worth">{{ sumCartPrice($_COOKIE['guest']) }}</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
       
    </header>
     <div class="flash sticky-top" style="z-index: 10000;">
        
    </div>
    
    {{-- <script type="text/javascript">
        
    </script> --}}

    <style type="text/css">
        .cart-msg{
            margin-left: 600px;
        }


        @media(max-width: 1200px){
            .cart-msg{
                margin-left: 500px;
            }
        }

         @media(max-width: 992px){
            .cart-msg{
                margin-left: 400px;
            }
        }

        @media(max-width: 768px){
            .cart-msg{
                margin-left: 250px;
            }
        }

         @media(max-width: 576px){
            .cart-msg{
                margin-left: 150px;
            }
        }

        @media(max-width: 470px){
            .cart-msg{
                margin-left: 100px;
            }
        }

        @media(max-width: 350px){
            .cart-msg{
                margin-left: 5px;
            }
        }

        
    </style>

	@include('layouts.messages')

    @yield('content')


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('store_assets/img/logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="{{ asset('store_assets/img/payment-item.png') }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('store_assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('store_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('store_assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('store_assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('store_assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('store_assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('store_assets/js/owl.carousel.min.js') }}"></script>





    @php

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $root = (isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'];

        $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    @endphp

    @if ($actual_link == $root.'store/viewcart')
        <script src="{{ asset('store_assets/js/cart.js') }}"></script>
    @else
        <script src="{{ asset('store_assets/js/main.js') }}"></script>
    @endif
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js" integrity="sha512-s/XK4vYVXTGeUSv4bRPOuxSDmDlTedEpMEcAQk0t/FMd9V6ft8iXdwSBxV0eD60c6w/tjotSlKu9J2AAW1ckTA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.3/purify.min.js" integrity="sha512-DLr4lLuQqgQ2ZKl61MgTzqEpI1sxQAZRoXdvMOiz9liVW3aa1tZatrgW//WeYX68+0qauTDx1aAZ4XPLibtk6w==" crossorigin="anonymous"></script>
    <script src="{{ asset('store_assets/js/pdf.js') }}"></script> --}}
        
            
</body>

</html>