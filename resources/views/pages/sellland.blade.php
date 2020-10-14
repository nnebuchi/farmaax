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
        border-bottom-right-radius: 0px!important;
        border-top-right-radius: 0px!important;

    }

    .services-wrap{
        margin-bottom: 40px;
    }
</style>
    <section class="hero-wrap js-fullheight ftco-section ftco-no-pt" style="background-color: #262401; height: 200px!important;"
        data-stellar-background-ratio="0.5">
        <div class="row">
            <div class="col-md-12 about" style=" background-image: url({{ asset('images/wheat.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: bottom;">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                        data-scrollax-parent="true">
                        <div class="col-md-10 offset-md-1 ftco-animate text-seg">
                            <h2 class="subheadin text-white"><span style="font-weight: bold;">Your Agro Reality</span></h2>
                            <h1 class="text-cent">Own a farmland </h1>
                            <p class="mb-4 third-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p><a href="{{ url('farms') }}" class="btn btn-primary mr-md-4 py-2 px-4">Own a farmland</a></p>
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
                    <h2 class="logo about-headings"><a href="#">Farm <span>Setup</span></a></h2>
                    <hr>
                    <p class="about-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                    
                </div>
                <div class="col-md-7 offset-md-0 col-sm-8 offset-sm-2 col-12  services-wrap px-4 pt-md-5" style="background-color: ">
                    <img src="{{ asset('images/farmtype.png') }}" >
                    
                </div>

                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/payment.png') }}" height="300">
                    
                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Make  <span>Payment</span></a></h2>
                    <hr>
                    <p class="about-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                    
                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Track Farm <span>Progress</span></a></h2>
                    <hr>
                    <p class="about-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                    
                </div>
                <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/track.png') }}" height="300">
                    
                </div>

                 <div class="col-md-5 services-wrap px-4 pt-5" style="background-color: ">
                    <img src="{{ asset('images/cashout.png') }}" height="300">
                    
                </div>

                <div class="col-md-7 services-wrap px-4 pt-5 py-5" style="">
                    <h2 class="logo about-headings"><a href="#">Cashout on Due Date</a></h2>
                    <hr>
                    <p class="about-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                    
                </div>
            </div>
        </div>
    </section>

   @include('layouts.includes.available_farms')
    
@endsection