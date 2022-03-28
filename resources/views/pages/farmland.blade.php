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
                    <h5 class="logo about-headings mt-3 text-center text-dark">Farm Land Information </h5>
                    <p class="about-content text-left">
                        Register and verify your account for free. Choose the location, purchase options (lease or outright purchase) and the number of acres you wish to purchase. 
                    </p>

                </div>

                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/land.png') }}" style="height:150px;" class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Land Inspection </h5>
                    <p class="about-content text-left">
                      You are expected to visit the farmland for physical inspection and further inspection necessary.
                    </p>

                </div>

                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/payment.jpg') }}" style="height:150px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Make Payment </h5>
                    <p class="about-content text-left">
                        Choose payment plan (full or installment), payment method (bank transfer or card) And make payment for your farmland. 
                    </p>

                </div>
                <div class="col-md-4 col-sm-6  services-wrap px-4 pt-3" style="">
                    <img src="{{ asset('images/documents.png') }}" style="height:150px; border-radius: 10px;"  class="text-center d-block mx-auto">

                    <h5 class="logo about-headings mt-3 text-center text-dark">Get Documentation </h5>
                    <p class="about-content text-left">
                           Receive the appropriate land documents: Receipt, Deed of assignment, survey plan and certificate of occupancy. 
                    </p>

                </div>
               
            </div>
        </div>
    </section>

    
    @include('layouts.includes.farmtypes')

@endsection
