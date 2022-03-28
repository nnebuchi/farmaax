@extends('layouts.front')
@section('title', 'About Farmaax')
@section('content')

<style type="text/css">
      .hero-text p{
        font-size: 20px;
      }
      .hero-bg{
        background-image: url({{ asset('images/wheat.jpg') }}); background-size: cover; height: 400px; background-position: bottom; z-index: 10;
      }

      .hero-overlay{
        position: absolute;top: 0; left: 0; right: 0; bottom: 0; background-color: black; opacity: 0.8; z-index: 100;
      }

      .hero-text{
        position: absolute; z-index: 1000; margin-top: 30px;
      }

      .hero-title{
        font-weight: bold;
      }

      .hero-img{
        width: 480px;
      }


      @media(max-width: 992px){
        .hero-img{
            width: 350px;
          }
      }

      @media(max-width: 768px){
        h1{
            font-size: 30px!important;
        }

        .hero-bg{
             height: 200px; 
          }
        
      }
  </style>


    <section class="ftco-section ftco-no-pt">
        <div class="row">
            <div class="col-12 hero-bg">

                <div class="hero-overlay">
                    
                </div>
                <div class="text-white row hero-text">
                    <div class="col-md-6 offset-md-1 pl-5 pt-5">
                        {{-- <h1 class="display-4"><strong class="hero-title">{{ $page->title }}</strong> </h1> --}}
                        <h1 class="display-4"><strong class="hero-title">All you need to know about Farmaax</strong> </h1>
                       
                        {{-- <a href="{{ url($page->link) }}" class="btn btn-success myLearn">Get started</a> --}}
                    </div>
                    <div class="col-md-5 pr-5 pt-5 d-none d-md-block">
                        
                            <img src="{{ asset('images/tractor_green.png') }}" class="hero-img">
                            
                        
                    </div>
                </div>
                
                
            </div>

        </div>
    </section>
    <section class="ftco-section bg-light">
        <div class="container">
            {{-- <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center ftco-animate">
                    <h1>About Us</h1>
                    <span class="subheading">Everything you need to know about farmaax</span>
                    <hr>
                </div>
            </div> --}}

            <div class="text-justify py-5 px-3 px-md-0" style="font-weight: bold; color: #006634;">
                <p>Farmaax is an Agritech company that provides intending and existing farmers with easy access to fertile and affordable farmland, while also providing them with legal services, and advanced Agriculture extension services. </p>

                <p>Through our platform, corporate workers and professionals can own and manage a farm at the comfort on your mobile device.</p>

                <h3 class="text-success text-center text-md-left">WHY WE EXIST</h3>

                <p>Nigeria has 90 million hectares of arable land, out of which only 34 million hectares  are cultivated. This is less of the total amount required to produce food to feed the growing population. There are 7.7 Million smallholder farmers in Nigeria (FAO 2018) who lack access to legitimate, secured and affordable arable farmland for their Agricultural activities. This poses a huge market potential in Nigeria.</p>

            </div>


        </div>
        <div class="container" style="color: #006634; font-weight: bold;">
            <div class="row justify-content-center py-5">
                <div class="col-md-4 px-4">
                    <h1 class="text-success text-center text-md-left">Vision</h1>
                    <p>To boost food security across Africa by making farm ownership seamless.</p>
                </div>
                <div class="col-md-4 col-lg-4 px-4">
                    <h1 class="text-success text-center text-md-left">Mission</h1>
                    <p>To create a platform where everyone can own a farm as well as increase food security through mobile
                        devices with adequate resources provided.</p>
                </div>
                <div class="col-md-4 col-lg-4 px-4">
                    <h1 class="text-success text-center text-md-left">Core Values: HITC</h1>
                    <p>
                    <ul>
                        <li>
                            H - HONESTY
                        </li>
                        <li>I - INTEGRITY </li>
                        <li> T - TRANSPARENCY </li>
                        <li> C - CUSTOMERS SATISFACTION</li>


                    </ul>
                    </p>
                </div>
            </div>


        </div>

    </section>

@endsection
