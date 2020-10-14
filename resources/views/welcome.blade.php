@extends('layouts.auth')
@section('content')
@section('title', 'Welcome to Farmaax')

    <!-- END nav -->
    <!-- <div class="hero-wrap js-fullheight" style="background-image: url('images/lane.jpg'); background-position: bottom; height: 500px!important;" data-stellar-background-ratio="0.5"> -->
    <section class="hero-wrap js-fullheight ftco-section ftco-no-pt"
        style="background-color: #262401; height: 300px!important;" data-stellar-background-ratio="0.5">
        <div class="row">
            <div class="col-md-6 first-seg">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                        data-scrollax-parent="true">
                        <div class="col-md-10 offset-md-1 ftco-animate text-seg">
                            <h4 class="text-white">A Tech Enabled Platform For Farmland & Agribusiness</h4>
                            <p class="d-none d-lg-block">Farmaax is an Agricultural real estate, farming and farm investment
                                company. We are giving
                                you the
                                opportunity to purchase farmland, invest in a farm or start your personal farm projects
                                using your
                                mobile device. Farmaax helps you execute and accomplish your agricultural goals. Receive
                                regular
                                farm updates, project progress updates to monitor your farm projects comfortably from
                                anywhere in
                                the world on your mobile device.
                            </p>
                            <p><a href="{{ route('register') }}" class="btn btn-primary ">Get Started </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 second-seg" style="position: relative!important;">

                <img src="images/happygirl.png" class="hero-img text-right">
            </div>
        </div>



    </section>

    <section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 py-5 order-md-last">
                    <div class="heading-section ftco-animate py-3">
                        <!-- <span class="subheading">Services</span> -->
                        <h2 class="mb-4 text-tertiary mt-3">Agro Store</h2>
                        <p class="text-dark">A small river named Duden flows by their place and supplies it with the
                            necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                            into your.</p>
                        <p><a href="#" class="btn btn-primary py-3 px-4">Get a Quote</a></p>
                    </div>
                </div>
                <div class="col-lg-9 services-wrap px-4 pt-5">
                    <div class="row pt-md-3">
                        <div class="col-md-4 d-flex align-items-stretch" style="background-color: #676501;">
                            <div class="services text-center">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-fence"></span>
                                </div>
                                <div class="text">
                                    <h3>Farm Management</h3>
                                    <p class="text-tertiary">Seeking justice in the world is a sed significant emotional
                                        and investment when we follow this call.</p>
                                </div>
                                <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span
                                        class="ion-ios-arrow-round-forward"></span></a>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-stretch" style="background-color: #262401;">
                            <div class="services text-center">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-lawn-mower"></span>
                                </div>
                                <div class="text">
                                    <h3>Agro Consultancy and Marketing</h3>
                                    <p class="text-tertiary">Seeking justice in the world is a sed significant emotional
                                        and investment when we follow this call.</p>
                                </div>
                                <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span
                                        class="ion-ios-arrow-round-forward"></span></a>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-stretch" style="background-color: #4e9525;">
                            <div class="services text-center">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-natural-resources"></span>
                                </div>
                                <div class="text">
                                    <h3>Land Sales</h3>
                                    <p class="text-tertiary">Seeking justice in the world is a sed significant emotional
                                        and investment when we follow this call.</p>
                                </div>
                                <a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span
                                        class="ion-ios-arrow-round-forward"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb bg-light mt-3 py-5">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-end"
                        style="background-image:url(images/about.jpg);">
                        <a href="https://vimeo.com/45830194"
                            class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
                            <span class="icon-play"></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 pl-md-5">
                    <div class="row justify-content-start py-5">
                        <div class="col-md-12 heading-section ftco-animate">
                            <h2 class="mb-4">Where do you fit in?</h2>
                            <p>Here you can choose the kind of Agro business you want
                            </p>
                            <div class="services-wrap">
                                <a href="{{ url('about/farmsetup') }}" class="services-list">Own A Farm
                                    <div class="btn-custom d-flex align-items-center justify-content-center"><span
                                            class="ion-ios-arrow-round-forward"></span></div>
                                </a>
                                <a href="{{ url('about/partnershipfarming') }}" class="services-list">Partnership/Investment
                                    Farming

                                    <div class="btn-custom d-flex align-items-center justify-content-center"><span
                                            class="ion-ios-arrow-round-forward"></span></div>
                                </a>
                                <a href="{{ url('about/ownafarm') }}" class="services-list">Own a Farmland
                                    <div class="btn-custom d-flex align-items-center justify-content-center"><span
                                            class="ion-ios-arrow-round-forward"></span></div>
                                </a>
                                <a href="{{ url('about/sellland') }}" class="services-list">Sell Land On Farmaax
                                    <div class="btn-custom d-flex align-items-center justify-content-center"><span
                                            class="ion-ios-arrow-round-forward"></span></div>
                                </a>
                                <a href="{{ url('about/become_a_realtor') }}" class="services-list">Become a
                                    realtor/Consultant
                                    <div class="btn-custom d-flex align-items-center justify-content-center"><span
                                            class="ion-ios-arrow-round-forward"></span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.includes.available_farms')

    <section class="ftco-section testimony-section" style="background-color: #676501;">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">

                    <h2 class="mb-4 text-white">Testimonials</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">

                        <div class="item">
                            <div class="testimony-wrap py-4" id="testimony">
                                <div class="text">
                                    <p class="mb-4 testimonial-text mt-5">Farmaax is a trusted organization. <br>

                                        As a young farmer, my first farmland was a lease from her, affordable and no
                                        insecurity threats.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="pl-3">
                                            <p class="name">Adeola Daniel, <br> <span class="text-white">Rivers
                                                    State.</span>
                                            </p>
                                            <!--  <span class="position">Marketing Manager</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4" id="testimony">
                                <div class="text">
                                    <p class="mb-4 testimonial-text ">Because of Farmaax, I am a proud owner of a farm.
                                        Just
                                        a call got everything started and done. They sent my land document to me in Turkey
                                        and updated me when my farm started and I received updates on my farm regularly Via
                                        my Portal. Truly, they are making farm ownership a reality..</p>
                                    <div class="d-flex align-items-center">
                                        <div class="pl-3">
                                            <p class="name">IB, <br>
                                                <span class="text-white"> Lagos State.</span> </p>
                                            <!--  <span class="position">Marketing Manager</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4" id="testimony">
                                <div class="text">
                                    <p class="mb-4 testimonial-text mt-5">I am super excited, I now own a farm. after
                                        hustling
                                        here I decided to invest some of my money in farming, Farmaax made this easy. Thanks
                                        you Farmaax. .</p>
                                    <div class="d-flex align-items-center">
                                        <div class="pl-3">
                                            <p class="name">John, <br> <span class="text-white">Port harcourt.</span></p>
                                            <!--  <span class="position">Marketing Manager</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section ftco-no-pt ftco-no-pb bg-primary">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 py-4">
                    <div class="row">
                        <div class="col-md-6 ftco-animate d-flex align-items-center">
                            <h2 class="mb-0" style="color:white; font-size: 24px;">Subcribe to our Newsletter</h2>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <form action="#" class="subscribe-form form-inline">
                                <div class="form-group d-fle row">
                                    <div class="col-7">
                                        <input type="text" class="form-control" placeholder="Enter email address">
                                    </div>
                                    <div class="col-5">
                                        <input type="submit" value="Subscribe" class="submit form-control">
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
