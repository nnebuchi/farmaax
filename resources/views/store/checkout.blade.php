@extends('layouts.store_master')
@section('title', 'Checkout')
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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('store') }}">Store</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    


     <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            
            <div class="checkout__form">
                
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            {{-- <div class="bg-white py-4 px-3 rounded-right rounded-left">
                                <h4>Address Detail</h4>
                                <p style="font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                            </div> --}}

                            <div class="bg-white py-4 px-3 rounded-right rounded-left mt-2">
                                <h4>Delivery Method</h4>
                                <strong style="font-siz: 14px;">How do you want your items delivered?</strong>
                                <div class="form-group">
                                    <input type="radio" name="method" class="delivery-method" value="0" id="door-delivery"> Door Delivery
                                </div>
                                <div class="border pl-5 py-3 door-div">
                                    delivers between 2 days to places in Lagos and 4 days to places outside lagos 
                                    <br><br>
                                    <strong>choose your delivery address</strong>

                                    @foreach($addresses as $address)
                                    <div class="form-group">
                                        <input type="radio" name="address" value="{{ $address->id }}" class="delivery-address"> 
                                        <span style="font-size: 14px;">
                                            {{ $address->address }} - {{ $address->landmark }} 
                                        </span>
                                        <button class="btn btn-sm" data-toggle="modal" data-target="#addr-{{ $address->id }}" style="color:  #7fad39;"> Edit <i class="fa fa-edit"></i></button>

                                    </div>

                                    <div class="modal fade" id="addr-{{ $address->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form method="post" action="{{ route('add-address') }}">
                                            @csrf
                                            <input type="hidden" name="addressId" value="{{ $address->id }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-2">
                                                            <label>State</label>
                                                            <select name="state" class="form-control pick-state @error('state') is-invalid @enderror" required>
                                                                <option selected disabled>Select state</option>
                                                                {{-- @if(Auth::user()->state!=null) --}}
                                                                    @foreach( $states as $state)
                                                                    <option value="{{ $state->id }}"  @if($address->state==$state->id)selected @endif>{{ $state->name }}</option>
                                                                    @endforeach
                                                                {{-- @endif --}}
                                                            </select>

                                                            @error('state')
                                                            <li class="text-danger">{{ $message }}</li>
                                                            @enderror
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <label>LGA</label>
                                                            <select name="lga" class="form-control @error('lga') is-invalid @enderror" required>
                                                                <option selected disabled>Select LGA</option>
                                                                {{-- @if(!is_null($myStateLga)) --}}
                                                                    @foreach($lgas as $lga)
                                                                        @if($lga->state_id == $address->state)
                                                                            <option value="{{ $lga->id }}" @if($address->lga==$lga->id)selected @endif>{{ $lga->name }}</option>
                                                                        @endif;
                                                                    @endforeach
                                                                {{-- @endif --}}
                                                            </select>
                                                            @error('lga')
                                                            <li class="text-danger">{{ $message }}</li>
                                                            @enderror
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <label>Address</label>
                                                            <textarea class="form-control" name="address">{{ $address->address }}</textarea>
                                                        </div>

                                                         <div class="col-lg-6 mb-2">
                                                            <label>Landmark (optional)</label>
                                                            <input type="text" name="landmark" class="form-control"  value="{{ $address->landmark }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary">Save changes</button>
                                                </div>
                                          </form>
                                          
                                        </div>
                                      </div>
                                    </div>

                                    @endforeach
                                    
                                    <a class="btn site-btn mt-1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add Address <i class="fa fa-plus-circle"></i></a>

                                    <div class="collapse mt-2" id="collapseExample">
                                      <div class="card card-body">
                                       <form method="post" action="{{ route('add-address') }}">
                                            @csrf
                                            

                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <label>State</label>
                                                    <select name="state" id="state" class="form-control @error('state') is-invalid @enderror" required>
                                                        <option selected disabled>Select state</option>
                                                        {{-- @if(Auth::user()->state!=null) --}}
                                                            @foreach( $states as $state)
                                                            <option value="{{ $state->id }}"  @if(Auth::user()->state==$state->id)selected @endif>{{ $state->name }}</option>
                                                            @endforeach
                                                        {{-- @endif --}}
                                                    </select>

                                                    @error('state')
                                                    <li class="text-danger">{{ $message }}</li>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <label>LGA</label>
                                                    <select name="lga" id="lga" class="form-control @error('lga') is-invalid @enderror" required>
                                                        <option selected disabled>Select LGA</option>
                                                        @if(!is_null($myStateLga))
                                                            @foreach($myStateLga as $lga)
                                                                <option value="{{ $lga->id }}" @if(Auth::user()->lga==$lga->id)selected @endif>{{ $lga->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('lga')
                                                    <li class="text-danger">{{ $message }}</li>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-6 mb-2">
                                                    <label>Address</label>
                                                    <textarea class="form-control" id="address" name="address"></textarea>
                                                </div>

                                                 <div class="col-lg-6 mb-2">
                                                    <label>Landmark (optional)</label>
                                                    <input type="text" name="landmark" class="form-control" id="landmark">
                                                </div>
                                            </div>

                                            <button id="submit-address" class="btn site-btn">submit</button>

                                          
                                       </form>
                                      </div>
                                    </div>

                                    
                                </div>

                                <div class="form-group mt-3">
                                    <input type="radio" name="method" class="delivery-method" value="1"  id="pickup-delivery"> Pick up center
                                </div>

                                

                                <div class="border pl-5 py-3 pickup-div">
                                    Products will be available at designated pickup centers 
                                    <br><br>
                                    <strong>choose your pickup center</strong>

                                    <div class="form-group">
                                        <input type="radio" name="pickup_center" class="pickup-center" value="0"> <span><strong>Lagos:</strong></span>
                                        <span>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        </span>

                                    </div>

                                    <div class="form-group">
                                        <input type="radio" name="pickup_center" class="pickup-center" value="1"> <span><strong>Port Harcourt:</strong></span>
                                        <span>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        </span>

                                    </div>
                                </div>
                                    
                                
                            </div>

                            
            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order bg-white">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach($cartProducts as $product)
                                        <li>{{ $product->title }} <span>&#8358; {{ number_format($product->price * $product->cartQty) }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>&#8358; {{ number_format(sumCartPrice($_COOKIE['guest']))  }}</span></div>
                                <div class="checkout__order__total">Total <span>&#8358; {{ number_format(sumCartPrice($_COOKIE['guest']))  }}</span></div>
                                <input type="hidden" name="subtotal" value="{{ sumCartPrice($_COOKIE['guest']) }}">
                                <input type="hidden" name="grandtotal" value="{{ sumCartPrice($_COOKIE['guest']) }}">
                                <div class="checkout__input__checkbox">
                                    <a href="{{ route('viewcart') }}" class="btn site-btn-outline btn-block">Modify Cart</a>
                                </div>
                                
                                <h5 class="mt-5">select payment method</h5>
                                <hr>
                                <div class="checkout__input__checkbo">
                                    <label for="payment">
                                        
                                        <input type="radio" id="payment" name="payment_method" value="bank_transfer"> Bank Transfer
                                        
                                    </label>
                                </div>
                                <div class="checkout__input__checkbo">
                                    <label for="paypal">
                                        
                                        <input type="radio" id="paypal" name="payment_method" value="debit_card"> Debit Card (Secured by paystack)
                                        
                                    </label>
                                </div>
                                <div class="checkout__input__checkbo">
                                    <label for="paypal">
                                        
                                        <input type="radio" id="delivery" name="payment_method" value="pay_on_delivery"> Pay on delivery
                                        
                                    </label>
                                </div>
                                <button type="button" class="site-btn" id="proceed">Proceed</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
   


   

@endsection