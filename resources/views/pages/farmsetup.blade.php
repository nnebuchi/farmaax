@extends('layouts.auth')
@section('content')
@section('title', 'Farmaax Farm set-up')
    <!-- END nav -->
    <!-- <div class="hero-wrap js-fullheight" style="background-image: url('images/lane.jpg'); background-position: bottom; height: 500px!important;" data-stellar-background-ratio="0.5"> -->


    <style>
        .about .overlay {
            /*position: absolute;*/
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: "";
            opacity: 0.85;
            background: #676501;
            /*border-bottom-left-radius:50%;*/
            border-bottom-right-radius: 0px !important;
            border-top-right-radius: 0px !important;

        }

        .services-wrap {
            margin-bottom: 40px;
        }

    </style>
    <section class="hero-wrap js-fullheight ftco-section ftco-no-pt"
        style="background-color: #262401; height: 200px!important;" data-stellar-background-ratio="0.5">
        <div class="row">
            <div class="col-md-12 about"
                style=" background-image: url({{ asset('images/wheat.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: bottom;">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                        data-scrollax-parent="true">
                        <div class="col-md-10 offset-md-1 ftco-animate text-seg">
                            <h2 class="subheadin text-white"><span style="font-weight: bold;">Your Agro Reality</span></h2>
                            <h1>Farm Setup </h1>
                            <p class="mb-4 third-text">Start a farm from your mobile device and become a farm owner.</p>
                            <p>Start your personal farm projects from your mobile device, purchase verified lands and
                                connect to experienced and professional farm managers to help execute and accomplish your
                                agricultural goals at the lowest possible cost, with flexible payment methods. </p>
                            <p><a href="{{ url('farms') }}" class="btn btn-primary mr-md-4 py-2 px-4">Own a Farm </a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
        <div class="container">
            <div class="row py-4">


                <div class="col-md-5 offset-md-0 col-sm-8 0ffset-sm-2 col-12 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Select a farm project or crop </a></h2>
                    <hr>
                    <p class="about-content">
                        Get started by selecting your preferred farm project or crop such as Tomatoes farm, Cashew farm,
                        Palm farm, pineapple farm, Pepper farm, cashew farm, fish farm, poultry farm, ginger, etc
                    </p>

                </div>
                <div class="col-md-7 offset-md-0 col-sm-8 offset-sm-2 col-12  services-wrap px-4 pt-md-5"
                    style="background-color: ">
                    <img src="{{ asset('images/farmtype.png') }}">

                </div>

                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/payment.png') }}" height="300">

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Farmland information </a></h2>
                    <hr>
                    <p class="about-content">
                        If you have farmland, provide your farmland information. Or If you don't have farmland, select and
                        purchase farmland in your preferred location (receive documentation within a month).
                    </p>

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#"> Select a farm Manager </span></a></h2>
                    <hr>
                    <p class="about-content">
                        View all farm managers and compare cost, experience and reviews. Then, select your farm manager for
                        your farm project
                    </p>

                </div>
                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/track.png') }}" height="300">

                </div>

                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/cashout.png') }}" height="300">

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Payment Method </a></h2>
                    <hr>
                    <p class="about-content">
                        Confirm project cost in your cart and proceed to payment. Select payment plan (installment or full)
                        and payment method (card or Bank transfer).
                    </p>

                </div>
                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Access your farm project dashboard </a></h2>
                    <hr>
                    <p class="about-content">
                        Subscribe for farm management, access insurance cover and receive project commencement date. You can
                        chat with your farm manager and monitor every activity (from land preparation to harvest) via
                        videos, pictures and messages. Or visit your farm
                    </p>

                </div>
                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/cashout.png') }}" height="300">

                </div>
                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/cashout.png') }}" height="300">

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Connect to market </a></h2>
                    <hr>
                    <p class="about-content">
                        Check market prices on your dashboard and select your preferred market or offtaker for your produce.
                    </p>

                </div>
            </div>
        </div>
    </section>

    @include('layouts.includes.available_farms')

@endsection
