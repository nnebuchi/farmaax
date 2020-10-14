<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="{{ asset('user-dashboard/js/jquery.js') }}"></script>
    <script src="{{ asset('user-dashboard/bootstrap/dist/js/bootstrap.bundle.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user-dashboard/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user-dashboard/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('user-dashboard/css/styles.css') }}">
</head>

<body>


    <div class="sidebar-panel">


        <div class="row">

            <div class="col-sm-6">
                <button class="closeing">
                    <i class="closeFontIcon fa fa-times menu-icon fa-2x" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-center navbar-brand pl-2"><img
                src="{{ asset('user-dashboard/images/logo-t.png') }}" width="90" class="img-fluid" alt=""></div>

        <div class="col-sm-12">
            <div class="sidelistwrp">
                <ul>
                    <li class="pl-2 noLgScr">Dashboard</li>
                    <li class="pl-2 noLgScr">MyFarm</li>
                    <li class="pl-2 noLgScr">MyFarm land</li>
                    <li class="pl-2">My Account</li>
                    <li class="pl-2">LiveChat</li>
                    <li class="pl-2">Blog</li>
                    <li class="pl-2">Logout</li>
                </ul>
            </div>
        </div>
    </div>




    <nav class="navbar navbar-expand navbar-light bg-transparent">
        <button class="opennav">
            <i class="text-dark myFontBars fa fa-bars menu-icon fa-2x" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand pl-2"><img src="{{ asset('user-dashboard/images/logo-t.png') }}" width="90"
                class="img-fluid" alt=""></div>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link myNavlink" href="#">Dashboard <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link myNavlink" href="#">My Farm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link myNavlink" href="{{ route('myLands') }}">My Lands</a>
            </li>


        </ul>



        <div class="ml-auto">
            <i class="myFontIcon fas fa-envelope"></i>
            <a href="{{ route('farmcart') }}"> <i class="myFontIcon fas fa-shopping-cart text-dark"> <span
                        class=" badge badge-warning"
                        style="position: absolute; top: 20;  font-size: 10px;">{{ Auth::user()->investment_cart->count() }}</span></i>
            </a>
            <a href="{{ route('logout') }}"> <i class="myFontIcon text-dark fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="black-overlay"></div>
        <div class="container-fluid">
            @include('layouts.alert')
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="card myCardStyle shadow-sm card-body">
                        <div class="d-flex justify-content-center">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->firstName . '+' . Auth::user()->lastName }}"
                                width="60px" class="rounded-circle" alt="" srcset="">

                        </div>
                        <div class="mypadding-bottom">
                            <div class="text-center card-title myCardTitle font-weight-bold">
                                {{ Auth::user()->firstName . ' ' . Auth::user()->lastName }}
                            </div>
                            <div class="text-center font-weight-bold userID p-0">
                                {{ Auth::user()->wallet_id }}
                            </div>

                            <div class="">
                                <a href="{{ route('farms.index') }}" class="text-dark text-decoration-none">Start
                                    farm</a>
                            </div>
                            <div class="">
                                <a href="{{ route('lands.index') }}" class="text-dark text-decoration-none">Buy a
                                    Land</a>
                            </div>
                            <div class="">
                                <a href="{{ route('upgrade') }}" class="text-dark text-decoration-none">Upgrade
                                    Account</a>
                            </div>
                            {{-- <div class="">
                                <a href="" class="text-dark text-decoration-none">Dashboard</a>
                            </div> --}}

                            <div class="">
                                <a href="{{ route('lands.create') }}" class="text-dark text-decoration-none">Upload a
                                    Land</a>
                            </div>


                            <div class="">
                                <a href="{{ route('farmsInvestedIn') }}" class="text-dark text-decoration-none">Farms
                                    Invested In</a>
                            </div>
                            <div class="">
                                <a href="{{ route('myLands') }}" class="text-dark text-decoration-none">Purchased
                                    Lands</a>
                            </div>
                            <div class="">
                                <a href="{{ route('myLandsForSale') }}" class="text-dark text-decoration-none">My Lands
                                    For Sale</a>
                            </div>

                            {{-- <div class="">
                                <a href="" class="text-dark text-decoration-none">Farm land</a>
                            </div> --}}

                            <div class="">
                                <a href="{{ route('fundWallet') }}" class="text-dark text-decoration-none">Fund
                                    Wallet</a>
                            </div>

                            <div class="">
                                <a href="" class="text-dark text-decoration-none">Transactions</a>
                            </div>
                        </div>

                    </div>
                </div>



                {{-- <div class=" col-md-6">

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card mySmCard card-body">
                                <div class="totalCost text-lg-left">
                                    ₦0.0
                                </div>
                                <div class="farmCost text-lg-left">
                                    Total Farm Cost
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="card mySmCard card-body">
                                <div class="totalCost text-lg-left">
                                    0
                                </div>
                                <div class="farmCost text-lg-left">
                                    Total
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="card mySmCard card-body">
                                <div class="totalCost text-lg-left">
                                    &#8358;{{ number_format(Auth::user()->wallet_balance) }}
                                </div>
                                <div class="farmCost text-lg-left">
                                    Available Balance
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}
                <div class=" col-md-6">

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card mySmCard card-body">
                                <div class="totalCost text-lg-left">
                                    ₦0.0
                                </div>
                                <div class="farmCost text-lg-left">
                                    Total Farm Cost
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="card mySmCard card-body">
                                <div class="totalCost text-lg-left">
                                    0
                                </div>
                                <div class="farmCost text-lg-left">
                                    Total
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="card mySmCard card-body">
                                <div class="totalCost text-lg-left">
                                    &#8358;{{ number_format(Auth::user()->wallet_balance) }}
                                </div>
                                <div class="farmCost text-lg-left">
                                    Available Balance
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left pt-4 pb-3 h2">Choose From any of these options</div>

                    <div class="row">


                        <div class="col-sm-12 col-md-4">
                            <div class="card  card-body bg-transparent border-0 pt-3 pt-lg-2">
                                <div class="totalCost text-lg-center">
                                    <img src="{{ asset('user-dashboard/images/icon/agriculture.png') }}" width="70px"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="farmCost h4 text-lg-center pt-3">
                                    Farm Setup
                                </div>
                                <p class="font-weight-light pt-3">Own your farm, minimum cost ₦250,000.00</p>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('farmSetup') }}"
                                        class="btn btn-sm btn-success rounded-0">Proceed</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="card  card-body bg-transparent border-0 pt-3 pt-lg-2">
                                <div class="totalCost text-lg-center">
                                    <img src="{{ asset('user-dashboard/images/icon/sunflowers.png') }}" width="70px"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="farmCost h4 text-lg-center pt-3">
                                    Partnership/Investment Farming
                                </div>
                                <p class="font-weight-light pt-3">Partner or Invest in a Farm</p>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('farms.index') }}"
                                        class="btn btn-sm btn-success rounded-0">Proceed</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="card  card-body bg-transparent border-0 pt-3 pt-lg-2">
                                <div class="totalCost text-lg-center">
                                    <img src="{{ asset('user-dashboard/images/icon/grass.png') }}" width="70px" alt=""
                                        class="img-fluid">
                                </div>
                                <div class="farmCost h4 text-lg-center pt-3">
                                    Farm land
                                </div>
                                <p class="font-weight-light pt-3">Own your farm, minimum cost ₦250,000.00</p>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('lands.index') }}"
                                        class="btn btn-sm btn-success rounded-0">Proceed</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



                <div class="col-sm-12 col-md-3 mb-4">
                    <div class="card myCardStyleGreen shadow-sm card-body">

                        <div class="">
                            <div class="myCountContainer pt-4">
                                <canvas id="myCanvas" class="" width=150px" height="150px"
                                    style="border:5px solid #fff; border-radius:100%;">

                                </canvas>
                                <div class="myCount">
                                    0
                                </div>
                                <div class="total">
                                    Total Farm
                                </div>
                            </div>











                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>


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
