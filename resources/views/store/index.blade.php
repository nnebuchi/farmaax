@extends('layouts.store_master')
@section('title', 'Store')
@section('content')

 <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <!-- <i class="fa fa-bars"></i> -->
                            <span>Top Categories</span>
                        </div>
                        <ul>
                            @php  $catCount = 0; @endphp

                            @foreach($product_categories as $category)
                                @php $catCount ++; @endphp
                                @if($catCount<=11)
                                    <li><a href="#">{{ $category->title }}</a></li>
                                @endif
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search row">
                        <div class="hero__search__form col-md-7">
                            <form action="#">
                                
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone col-md-5 d-md-block d-none">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__tex">
                                <h5>+2349079935884</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ asset('store_assets/img/hero/banner.jpg') }}">
                        <div class="hero__text">
                            <span>Farmaax store</span>
                            <h2>100% Organic</h2>
                            <p>Natural Products in purest form</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul class="text-left">

                            <li class="active" data-filter="*">All</li>
                            @foreach($product_categories as $category)
                            
                                <li cl data-filter=".{{ $category->title }}">{{ $category->title }}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-6 mix {{ $product->catTitle }}">
                    
                        <div class="featured__item">
                            <a href="{{ route('product-detail', $product->slug) }}">
                                <div class="featured__item__pic set-b" data-setbg="img/featured/feature-1.jpg" style="background-color: white;">
                                    <img src="{{ asset('storage/storeProductCoverPhotos/'.$product->photo) }}" class="mx-auto d-block my-auto featured-img">
                                    {{-- <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul> --}}
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">{{ $product->title }}</a></h6>
                                    <h5>&#8358; {{ $product->price }}</h5>
                                </div>
                           </a> 
                       </div>
                    
                </div>

                @endforeach
                
                
                {{-- <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-2.png" style="background-color: white;">
                            <img src="{{ asset('store_assets/img/featured/feature_4.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-3.jpg" style="background-color: white;">
                            <img src="{{ asset('store_assets/img/featured/feature_2.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-4.jpg" style="background-color: white;">
                            <img src="{{ asset('store_assets/img/featured/feature_4.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-5.jpg" style="background-color: white;">
                            <img src="{{ asset('store_assets/img/featured/feature_6.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-6.jpg" style="background-color: white;">
                            <img src="{{ asset('store_assets/img/featured/feature_5.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-7.jpg" style="background-color:white;">
                            <img src="{{ asset('store_assets/img/featured/feature_6.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mix vegetables fastfood">
                    <div class="featured__item">
                        <div class="featured__item__pic set-b" data-setbg="img/featured/feature-8.jpg" style="background-color: white;">
                            <img src="{{ asset('store_assets/img/featured/feature_7.png') }}" class="mx-auto d-block my-auto featured-img">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </section>
    <!-- Featured Section End -->
@endsection