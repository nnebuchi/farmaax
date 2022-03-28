@extends('layouts.front')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">{{ __('Please Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <h1 class="h3 text-center">Thank you for signing up on <b>Farmaax</b>. </h1>
                    {{ __('Before proceeding to your dashboard, please check your email for a verification link and click on it to verify your  account on Farmaax.') }}
                    {{ __('If you did not receive the email, please check your spam folder') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <br><br>
                        Did not get the mail? Click <button type="submit" class="btn btn-success btn-sm">{{ __('Resend') }}</button>  to request another <br><br> want to logout? <span><a href="{{ url('logout') }}" class="btn-danger btn btn-sm text-right">Logout</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
