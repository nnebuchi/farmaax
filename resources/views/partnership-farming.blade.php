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
                    <h5 class="logo about-headings mt-3 text-center text-dark">Sponsor A Farm</h5>
                    <p class="about-content text-left">
                        Register and verify your account for free. Select the Farm projects
                        that interest you and enter the number of units you wish to sponsor.
                    </p>

                </div>

                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/payment.png') }}" style="height:150px;" class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Make Payment </h5>
                    <p class="about-content text-left">
                      Choose payment method (card or bank transfer) and proceed to make payment on our secured platform.
                    </p>

                </div>

                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/track.png') }}" style="height:150px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Access your Dashboard</h5>
                    <p class="about-content text-left">
                         Receive project updates, reports and information on your dashboard via Farmaax website. You can also
                        schedule a visit to the farm.
                    </p>

                </div>
                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/cashout.png') }}" style="height:150px; border-radius: 10px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Get your Returns</h5>
                    <p class="about-content text-left">
                          At project completion, receive your funds via your farmaax wallet and transfer your funds from your
                        wallet to your bank account.
                    </p>

                </div>
                
                

               
            </div>
        </div>
    </section>

    @include('layouts.includes.farmtypes')

@endsection
