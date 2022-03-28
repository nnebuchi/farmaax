@extends('layouts.front')
@section('content')
@section('title', 'Welcome to Farmaax')



    <!-- section 1 -->
<section class="hero-section">
    <div class="container pt-5">
        <div class="row hero-row">
            <div class="col-md-6 hero-img-div">
                <div class="d-flex justify-content-center">
                    <img src="images/farm-images/farmaax-image-file2.png" alt="" class="hero-img">
                </div>
            </div>
            <div class="col-md-6 px-5 px-md-0">
                <div class="h2 myAmaranth"><span class="text-warning ">A TECH <br>PLATFORM FOR</span><br><span class="text-white">FARMLANDS & AGRIC BUSINESS</span></div>
                <p class="text-white text-justify pt-3 hero-desc" style="width: 100%;"><span class="d-md-none  d-lg-block">Farmaax is an Agricultural real estate, farming and farm investment company. We are giving you the opportunity to purchase farmland, invest in a farm or start your personal farm projects using your mobile device. Farmaax helps you execute and accomplish your agricultural goals. Receive regular farm updates, project progress updates to monitor your farm projects comfortably from anywhere in the world on your mobile device.</span>  </p>
          
            <a href="{{ url('dashboard') }}" class="myBtn btn btn-success hero-btn">Get Started</a>  
            
            </div>
            {{-- <div class="col-12 d-md-block d-lg-none d-sm-none">
                <p class="text-white text-justify pt-3">Farmaax is an Agricultural real estate, farming and farm investment company. We are giving you the opportunity to purchase farmland, invest in a farm or start your personal farm projects using your mobile device. Farmaax helps you execute and accomplish your agricultural goals. Receive regular farm updates, project progress updates to monitor your farm projects comfortably from anywhere in the world on your mobile device. </p>
            </div> --}}
        </div>
    </div>
</section>


    <!-- section 4  -->

    @include('layouts.includes.farmtypes')

    <!-- section 4 end -->

    <!-- section 2 end -->




     <section>
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-4 col-sm-6 no-padding">
                    <div class="mySection2 mySectionBox"  style="background-image: url({{ asset('assets/img/leave2.jpg') }}); background-repeat: no-repeat;">
                        <div class="myimg" >
                            <img src="assets/img/agriculture.svg" width="110px" alt="">
                        </div>
                        <div class="card bg-transparent">
                            <div class="card-body">
                                 <div class="h6 myPadding-h2 myAmaranth text-center px-lg-5 text-white text-uppercase">Farm <br> Setup</div>
                                 <p class="px-md-5 px-2 text-left text-white">Start a farm from your mobile device and become a farm owner. Start your personal farm projects from your mobile device... </p>
                                 <div class="d-flex justify-content-center px-5"><a href="{{ url('about/farmsetup') }}" class="btn btn-success myLearn">Learn more</a>
                                 </div>
                            </div>
     
                        </div>
                    </div>
              </div>
              <div class="col-md-4 col-sm-6 no-padding">
               
                    <div class="mySection1 mySectionBox" style="background-image: url({{ asset('assets/img/leave1.jpg') }}); background-repeat: no-repeat;">
                        <div class="myimg">
                            <img src="assets/img/agronomy.svg" width="110px" alt="">
                        </div>
                       <div class="card bg-transparent">
                           <div class="card-body">
                                <div class="h6 myPadding-h2 myAmaranth text-center px-lg-5 text-white text-uppercase">Partnership farming</div>
                                <h3 class="text-white">(Farm Investment)</h3>
                                <p class="px-md-5 px-2 text-left text-white">Invest in farm projects, make returns and empower smallholder farmers... </p>
                                <div class="d-flex justify-content-center px-5">
                                    <a href="{{ url('about/partnership-farming') }}" class="btn btn-success myLearn">Learn more</a>
                                </div>   
                            </div>

                       </div>
                    </div>
              </div>
              <div class="col-md-4 col-sm-6 offset-sm-3 offset-md-0 no-padding">

                <div class="mySection3 mySectionBox"  style="background-image: url({{ asset('assets/img/okleave.jpg')}}); background-repeat: no-repeat;">
                   <div class="myimg">
                    <img src="assets/img/grain.svg" width="110px" alt="">
                   </div>
                   <div class="card bg-transparent">
                        <div class="card-body">
                         <div class="h6 myPadding-h2 myAmaranth text-center px-lg-5 text-white text-uppercase">Lands</div>
                         <h3 class="text-white">(Sales & Purchase)</h3>
                         <p class="px-md-5 px-2 text-left text-white">Purchase or lease affordable farmlands in your preferred location across Nigeria.</p>

                        <div class="d-flex justify-content-center px-5">
                            <a href="{{ url('about/farmland') }}" class="btn btn-success myLearn">Learn more</a>
                        </div>
                        </div>

                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>

    <!-- section 3 end -->


   

    <!-- section 5 -->
    <section>
        <div class="container-fluid  myTest myBackg" style="min-height: 300px;">
            <div class="h2 myFontsize2 text-white mytestpadding text-center myAmaranth text-uppercase">
                What Client say about us
            </div>

            <div class="container">
             
                    
                    <div class="row mx-auto my-auto pt-4">
                        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">
                                <div class="carousel-item active">
                                    <div class="col-md-4">
                                        <div class="card card-body myshadow bg-transparent " style="min-height: 410px!important;">
                                            <div class="myCircleImg d-flex justify-content-center">
                                                <img class="img-fluid" src="{{ asset('images/avatar.png') }}">
                                            </div>
                                            <div class="h3 text-center smalltext myAmaranth pt-3 text-warning">IB</div>
                                            <h4 class="text-center text-white">Turkey</h4>
                                            <p class="text-justify mytestsmall">Because of Farmaax, I am a proud owner of a farm. Just a click got everything started and done. They sent my land document to me in Turkey and updated me when my farm started and I receive updates on my farm regularly Via my Portal. Truly, they are making farm ownership a reality and seamless.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-md-4">
                                        <div class="card card-body myshadow bg-transparent" style="min-height: 410px!important;">
                                            <div class="myCircleImg d-flex justify-content-center">
                                                <img class="img-fluid" src="{{ asset('images/avatar.png') }}">
                                            </div>
                                            <div class="h3 text-center smalltext myAmaranth pt-3 text-warning">John </div>
                                            <h4 class="text-center text-white">Dubai, UAE</h4>
                                            <p class="text-justify mytestsmall">I am super excited, I now own a farm. after hustling here I decided to invest some of my money in farming, Farmaax made this easy. Thanks you Farmaax. </p>

                                            
                                        </div>
                                    </div>
                                </div>


                                <div class="carousel-item">
                                    <div class="col-md-4">
                                        <div class="card card-body myshadow bg-transparent" style="min-height: 410px!important;">
                                            <div class="myCircleImg d-flex justify-content-center">
                                                <img class="img-fluid" src="{{ asset('images/avatar.png') }}">
                                            </div>
                                            <div class="h3 text-center smalltext myAmaranth pt-3 text-warning">ADEOLA </div>
                                            <h4 class="text-center text-white">Lagos, Nigeria</h4>
                                            <p class="text-justify mytestsmall">It was difficult to lease farmland according to my specifications, discovering FARMAAX platform made it easy and seamless.</p>

                                            
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="carousel-item">
                                    <div class="col-md-4">
                                        <div class="card card-body myshadow bg-transparent" style="min-height: 410px!important;">
                                            <div class="myCircleImg d-flex justify-content-center">
                                                <img class="img-fluid" src="{{ asset('images/avatar.png') }}">
                                            </div>
                                            <div class="h3 text-center smalltext myAmaranth pt-3 text-warning">Daniel best</div>
                                            <p class="text-justify mytestsmall">Because of Farmaax, I am proud to call myself a farm  </p>

                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="carousel-item">
                                    <div class="col-md-4">
                                        <div class="card card-body myshadow bg-transparent" style="min-height: 410px!important;">
                                            <div class="myCircleImg d-flex justify-content-center">
                                                <img class="img-fluid" src="assets/img/testimonial-img/18.jpg">
                                            </div>
                                            <div class="h3 text-center smalltext myAmaranth pt-3 text-warning">Buchi william</div>
                                            <p class="text-justify mytestsmall">Because of Farmaax, I am proud to call myself a farm owner without having to step my foot on the farm. With their f </p>
                                        </div>
                                    </div>
                                </div> --}}
                                
                            </div>
                            <!-- <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark border border-dark p-3 rounded-circle" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a> -->
                            <!-- <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon bg-dark border border-dark p-3 rounded-circle" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a> -->
                       
                        </div>
                
                    </div>
            </div>
        </div>
    </section>
    <!-- section 5 end -->


    @if (is_null($userIsSubscribed))
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header " style="background-color: #63d471; background-image: linear-gradient(315deg, #4e9525 0%, #233329 74%);color:white; border-bottom: 1px solid #c99e1f !important;">
                                <h5 class="modal-title text-center"> Latest offer/promo from Farmaax </h5>
                                    <button type="button" class="close rounded-ci" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body bg-dark" style="background-color: #63d471; background-image: linear-gradient(315deg, #4e9525 0%, #233329 74%);color:white">
                        <div class="container-fluid">
                                @if ($popup)
                                    <div class="about-offers text-center">
                                        <h5 class="modal-title text-warning">{{ $popup->title }}</h5>
                                        <h5 class="modal-title text-left">{{ $popup->message }}</h5>
                                    </div>
                                    <hr class="bg-white">
                                @endif


                                <div class=" text-capitalize">Subscribe and get latest updates from us.</div>
                                <form action="{{ route('registerToMailists') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3 pt-4">
                                            <input type="email" class="form-control " placeholder="Email address" name="email" aria-label="" aria-describedby="basic-addon2" required>
                                            <div class="input-group-append">
                                              <button class="input-group-text btn" style="background-color: black!important; color: white!important;">Subcribe</button>
                                            </div>
                                          </div>

                                    </div>
                                </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endif

    <script>


        $(window).on('load', function() {
            if (!sessionStorage.getItem('shown-modal')){
            $('#modelId').modal('show');
            sessionStorage.setItem('shown-modal', 'true');
          }
        // sessionStorage.clear();


        });


    </script>


</body>
</html>

@endsection