@extends('layouts.front')
@section('content')
@section('title', 'About Farm setup')
    <!-- END nav -->
  @include('layouts.includes.herobg')

    <section class="ftco-section ftco-no-pt bg-white" style="background-color: #f8f4e7!important;">
        <div class="containe">
            <div class="row py-4 px-5 align-items-center align-contents-center">


                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    
                    <img src="{{ asset('images/farmtype.png') }}" style="width:300px;" class="text-center d-block mx-auto">
                    <h5 class="logo about-headings mt-3 text-center text-dark">Select a farm project or crop </h5>
                    <p class="about-content text-left">
                        Get started by selecting your preferred farm project or crop such as Tomatoes farm, Cashew farm,
                        Palm farm, pineapple farm, Pepper farm, cashew farm, fish farm, poultry farm, ginger, etc
                    </p>

                </div>

                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/payment.png') }}" style="height:150px;" class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Farmland information </h5>
                    <p class="about-content text-left">
                       If you have farmland, provide your farmland information. Or If you don't have farmland, select and
                            purchase farmland in your preferred location (receive documentation within a month).
                    </p>

                </div>

                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/farmer.png') }}" style="height:150px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Select a farm project or crop </h5>
                    <p class="about-content text-left">
                         View all farm managers and compare cost, experience and reviews. Then, select your farm manager for
                        your farm project
                    </p>

                </div>
                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/payment.jpg') }}" style="height:150px; border-radius: 10px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Payment Method</h5>
                    <p class="about-content text-left">
                          Confirm project cost in your cart and proceed to payment. Select payment method (card or Bank transfer).
                    </p>

                </div>
                

                 <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/track.png') }}" style="height:150px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Access your farm project dashboard</h5>
                    <p class="about-content text-left">
                          Subscribe for farm management, access insurance cover and receive project commencement date. You can
                        chat with your farm manager and monitor every activity (from land preparation to harvest) via
                        videos, pictures and messages. Or visit your farm
                    </p>

                </div>

                <div class="col-md-4 col-sm-6 services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/growth.jpg') }}" style="height:150px; border-radius: 10px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Connect to market </h5>
                    <p class="about-content text-left">
                          Check market prices on your dashboard and select your preferred market or offtaker for your produce.
                    </p>

                </div>
                

               
            </div>
        </div>
    </section>

    
    @include('layouts.includes.farmtypes')

@endsection
