@extends('layouts.auth')
@section('title')
@section('content')
<div class="container-fluid mt-5 mb-5 py-3  dashboard">
    <div class="row justify-content-center text-center">
        <div class="col-md-4 text-center">
            <div class="card secondary-btn m-1 text-white mb-4">
                <div class="card-body">Wallet Balance</div>
                <div class="card-footer text-center">
                    <span class="btn btn-light">
                        &#8358;{{ number_format(Auth::user()->wallet_balance) }}</span>

                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card m-1 text-white mb-4" style="background-color: #4e9525 !important;">
                <div class="card-body">FARM SETUP</div>
                <div class="card-footer text-center">
                    <span class=" ">
                        <a href="{{ route('farms.index') }}" class="btn btn-light">GET STARTED</a></span>

                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card m-1 text-white mb-4" style="background-color: #676501;">
                <div class="card-body">FARMAAX PRODUCTS</div>
                <div class="card-footer text-center">
                    <span class="">
                        <a href="{{ route('lands') }}" class="btn btn-light">GET STARTED</a>
                    </span>

                </div>
            </div>
        </div>

    </div>
    <div class="row mb-5 px-md-5">
        <div class="col-md-3 dashboard" style="background-color: #96bd46 ;color:white; border-radius:25%">
            <div class=" p-4">
                <div class="text-center">
                    <div class="profile-img rounded-circle">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->firstName . '+' . Auth::user()->lastName }}" alt="" class="rounded-circle" width="50%">
                    </div>
                    <div class="user-details ">
                        <h4 class="text-white">{{ Auth::user()->name() }}</h4>
                    </div>
                    <div class="quick-links">
                        <h4 class="text-success">Quick Links</h4>
                        <ul class="navbar-nav ml-auto text-white">
                            <li class="nav-item"><a href="{{ route('home') }}" class="text-white"><i class="icons fa fa-database" aria-hidden="true"></i> Dashboard</a></li>
                            <li class="text-white mt-2"><a href="{{ route('farms.index') }}" class="text-white"><i class="flaticon-lawn-mower icons" aria-hidden="true"></i> Go-to Farms</a>
                            </li>
                            <li class="text-white mt-2"><a href="{{ route('fundWallet') }}" class="text-white"><i class="fa fa-credit-card icons" aria-hidden="true"></i> Fund My Wallet</a>
                            </li>
                            <li class="text-white mt-2"><a href="{{ route('lands.index') }}" class="text-white"><i class="icons fa fa-area-chart" aria-hidden="true"></i> Find Lands</a>
                            </li>
                            <li class="text-white mt-2"><a href="{{ route('upgrade') }}" class="text-white"><i class="icons fa fa-level-up" aria-hidden="true"></i> Upgrade
                                    Account</a></li>
                            <li class="text-white mt-2"><a href="{{ route('upgrade') }}" class="text-white"><i class="icons fa fa-bell" aria-hidden="true"></i> Notifications</a></li>
                            <li class="text-white mt-2"><a href="{{ route('upgrade') }}" class="text-white">
                                    <i class="icons fa fa-history" aria-hidden="true"></i> Transaction History</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 py-5">
            <div class="row py-5">
                <div class="col-md-4 py-5">
                    <h3>Partnership Farming</h3>
                    <a href="{{ url('farms') }}" class="btn primary-btn">Proceed</a>
                </div>
                <div class="col-md-4 py-5">
                    <h3>Partnership Farming</h3>
                    <a href="" class="btn primary-btn">Proceed</a>
                </div>
                <div class="col-md-4 py-5">
                    <h3>Partnership Farming</h3>
                    <a href="" class="btn primary-btn">Proceed</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 dashboard px-5" style="background-color: #676501;color:white; border-radius:25%">
            <div class="">
                <a href="{{ route('farms.create') }}" class="btn btn-light btn-lg mt-5 ml-4">Upload Farm</a>

                <div class="mt-3" style="width: 100%; height: 300px; border: 4px solid white; border-radius: 50px;">

                </div>
            </div>
        </div>

    </div>



</div>


@endsection
