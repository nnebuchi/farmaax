@extends('layouts.store_master')
@section('title', 'Store')
@section('content')
@php
    $delivery = 0;
@endphp

	  <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('store_assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Header Section End -->
    


<style type="text/css">
    @media(max-width: 450px){
        .cart-price-holder{
            position: absolute;
            margin-top: -70px;
            margin-right: 0px!important;
        }
        .cart-qty{
            position: absolute;
            margin-left: -70px;
            margin-top: -30px;
        }
        .cart-total-holder{
            position: absolute;
            margin-top: 20px;
            margin-left: -135px;
        }

        thead tr th{
            font-size: 15px!important;
        }
    }

    @media(max-width: 360px){
        .cart-price-holder{
            position: absolute;
            margin-top: -70px;
            margin-right: 0px!important;
        }
        .cart-qty{
            position: absolute;
            margin-left: -70px;
            margin-top: -30px;
        }
        .cart-total-holder{
            position: absolute;
            margin-top: 20px;
            margin-left: -120px;
        }
    }
</style>
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table class="table-dark table-hover text-white pl-2">
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($cartProducts as $product)
                                    <tr >
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('storage/storeProductCoverPhotos/'.$product->photo) }}" height="60" alt="product Photo">
                                            <h5>{{ $product->title }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <span class="cart-price-holder">&#8358;<span class="unit-price"><span></span>{{ $product->price }}</span></span>
                                            
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty cart-qty">
                                                    <input type="text" value="{{ $product->cartQty }}" qty="{{ $product->quantity }}" cart-id="{{ $product->id }} " product-title="{{ $product->title }}">

                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            <span class="cart-total-holder">&#8358;<span class="total-price">{{ $product->total }}</span></span>
                                            
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <form method="post" action="{{ route('remove-from-cart') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="mr-5 mr-sm-3 btn"><i class="fa fa-trash text-danger"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>

                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal &#8358;<span class="cart-total">{{ sumCartPrice($_COOKIE['guest']) }}</span></li>
                            <li>Total &#8358;<span class="grand-total">{{ number_format(sumCartPrice($_COOKIE['guest']) + $delivery) }}</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection