@extends('layouts.auth')
@section('content')
@section('title', 'Welcome to Farmaax')
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
                            <h1 class="text-cent">Partnership Farming </h1>
                            <p class="mb-4 third-text">Invest in farm projects, make returns and empower smallholder
                                farmers.
                            <p> Invest a small amount of money in farm projects and share the returns. </p>
                            <p> Receive regular project updates to monitor your investment comfortably from anywhere in the
                                world on your mobile device.
                            </p>
                            <p> Join us in empowering smallholder farmers, contributing to food availability, providing
                                decent work and economic growth in Nigeria. </p>
                            .</p>
                            <p><a href="{{ url('farms') }}" class="btn btn-primary mr-md-4 py-2 px-4">Invest</a></p>
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
                    <h1>Sponsor A Farm</h1>
                    <p class="mb-4 third-text">Register and verify your account for free. Select the Farm projects
                        that interest you and enter the number of units you wish to sponsor.</p>
                    <p><a href="{{ url('farms') }}" class="btn btn-primary mr-md-4 py-2 px-4">Get Started</a></p>

                </div>
                <div class="col-md-7 offset-md-0 col-sm-8 offset-sm-2 col-12  services-wrap px-4 pt-md-5"
                    style="background-color: ">
                    <img src="{{ asset('images/farmtype.png') }}">

                </div>

                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/payment.png') }}" height="300">

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Make <span>Payment</span></a></h2>
                    <hr>
                    <p class="about-content">
                        Choose payment method (card or bank transfer) and proceed to make payment on our secured platform.
                    </p>

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Access your<span>Dashboard</span></a></h2>
                    <hr>
                    <p class="about-content">
                        Receive project updates, reports and information on your dashboard via Farmaax website. You can also
                        schedule a visit to the farm.
                    </p>

                </div>
                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/track.png') }}" height="300">

                </div>

                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/cashout.png') }}" height="300">

                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Get your Returns</a></h2>
                    <hr>
                    <p class="about-content">
                        At project completion, receive your funds via your farmaax wallet and transfer your funds from your
                        wallet to your bank account.
                    </p>

                </div>
            </div>
        </div>
    </section>

    @include('layouts.includes.available_farms')

@endsection
