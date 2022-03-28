@extends('layouts.dashboard_master')
@section('content')
@section('title', 'Farmaax')
    <div class="row">
        <div class="col-sm-6 offset-sm-3 offset-md-0 col-md-3 col-xs-12">
            <div class="card myCardStyle shadow-sm card-body">
                <div class="d-flex justify-content-center">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->firstName . '+' . Auth::user()->lastName }}" width="60px" class="rounded-circle" alt="" srcset="">

                </div>
                <div class="mypadding-bottom">
                    <div class="text-center card-title myCardTitle font-weight-bold">
                        {{ Auth::user()->firstName . ' ' . Auth::user()->lastName }}
                    </div>
                    <div class="text-center font-weight-bold userID p-0">
                        {{ Auth::user()->wallet_id }}
                    </div>
                    

                    <div class="">
                        <a href="{{ route('farms.index') }}" class="text-dark text-decoration-none">Start farm</a>
                    </div>

                    <div class="">
                        <a href="{{ route('lands.index') }}" class="text-dark text-decoration-none">Buy a
                            Land</a>
                    </div>
                    <div class="">
                        <a href="{{ route('upgrade') }}" class="text-dark text-decoration-none">Upgrade
                            Account</a>
                    </div>
                    

                    <div class="">
                        <a href="{{ route('lands.create') }}" class="text-dark text-decoration-none">Upload a
                            Land</a>
                    </div>


                    <div class="">
                        <a href="{{ route('farmsInvestedIn') }}" class="text-dark text-decoration-none">Farms
                            Invested In</a>
                    </div>
                    
                    <div class="">
                        <a href="{{ route('myLandsForSale') }}" class="text-dark text-decoration-none">My Lands
                            For Sale</a>
                    </div>

                    
                    <div class="">
                        <a href="{{ route('fundWallet') }}" class="text-dark text-decoration-none">Fund
                            Wallet</a>
                    </div>

                    <div class="">
                        <a href="{{ route('mytransactions') }}" class="text-dark text-decoration-none">My Transactions</a>
                    </div>

                    <div class="">
                        <a href="{{ route('myearnings') }}" class="text-dark text-decoration-none">My Earnings</a>
                    </div>

                    <div class="">
                        <a href="{{ route('mydownlines') }}" class="text-dark text-decoration-none">My Downlines</a>
                    </div>
                </div>

            </div>
        </div>


        <div class=" col-md-6">

            <div class="row">
                <div class="col-sm-4 col-6">
                    <div class="card mySmCard card-body">
                        <div class="totalCost text-lg-left">
                            ₦0.0
                        </div>
                        <div class="farmCost text-lg-left">
                            Total Farm Cost
                        </div>

                    </div>
                </div>
                <div class="col-sm-4 col-6">
                    <div class="card mySmCard card-body">
                        <div class="totalCost text-lg-left">
                            0
                        </div>
                        <div class="farmCost text-lg-left">
                            Total Farm
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card mySmCard card-body">
                        <div class="totalCost text-lg-left">
                            &#8358;{{ number_format(Auth::user()->wallet_balance) }}
                        </div>
                        <div class="farmCost text-lg-left">
                            Available Balance
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">


                <div class="col-sm-4 col-md-4">
                    <div class="card  card-body bg-transparent border-0 pt-3 pt-lg-2">
                        <div class="totalCost text-lg-center">
                            <img src="{{ asset('user-dashboard/images/icon/agriculture.png') }}" width="70px"
                                alt="" class="img-fluid">
                        </div>
                        <div class="farmCost h4 text-lg-center pt-3">
                            Farm Setup
                        </div>
                        <p class="font-weight-light pt-3">Own your farm, minimum cost ₦250,000.00</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('farmSetup') }}"
                                class="btn btn-sm btn-success rounded-0">Proceed</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="card  card-body bg-transparent border-0 pt-3 pt-lg-2">
                        <div class="totalCost text-lg-center">
                            <img src="{{ asset('user-dashboard/images/icon/sunflowers.png') }}" width="70px"
                                alt="" class="img-fluid">
                        </div>
                        <div class="farmCost h4 text-lg-center pt-3">
                            Partnership Farming
                        </div>
                        <p class="font-weight-light pt-3">Invest in a farm, minimum cost ₦20,000.00</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('farms.index') }}"
                                class="btn btn-sm btn-success rounded-0">Proceed</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-4">
                    <div class="card  card-body bg-transparent border-0 pt-3 pt-lg-2">
                        <div class="totalCost text-lg-center">
                            <img src="{{ asset('user-dashboard/images/icon/grass.png') }}" width="70px" alt=""
                                class="img-fluid">
                        </div>
                        <div class="farmCost h4 text-lg-center pt-3">
                            Farm land
                        </div>
                        <p class="font-weight-light pt-3">Own your farm at affordable prices</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('lands.index') }}"
                                class="btn btn-sm btn-success rounded-0">Proceed</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <div class="col-sm-6 offset-sm-3 offset-md-0 col-md-3 mb-4">
            <div class="card myCardStyleGreen shadow-sm card-body">

                <div class="">
                    <div class="myCountContainer pt-4">
                        <canvas id="myCanvas" class="bg-dark" width="150px" height="150px"
                            style="border:5px solid #fff; border-radius:100%;">

                        </canvas>
                        <div class="myCount">
                            0
                        </div>
                        <div class="total">
                            Total Farm
                        </div>

                         

                        @if(Auth::user()->lawyer!='no'||Auth::user()->realtor!='no'||Auth::user()->marketer!='no')
                        
                        <div class="input-group" style="margin-top:-100px; margin-bottom: 50px;">

                                <p class="text-white"> Earn 5% when you refer a friend</p>

                               <input type="text" class="form-control" id="click-to-copy" value="{{ url('register?ref='.Auth::user()->referral_code) }}" style="width: 60%;">

                                <div class="input-group-btn">

                                  <button class="btn" style=" background:#ffb400!important; color:#000;" onclick="clickToCopy()">

                                   copy <i class="fa fa-copy"></i>

                                  </button>

                                </div>

                        </div>
                        
                        @endif

                    </div>
                     

                </div>

            </div>
        </div>
    </div>
    
@endsection       