@extends('layouts.front')
@section('content')
@section('title', 'Login to Farmaax')
<style>
    .form-control{
       background-color: transparent!important;
       border: 1px solid #5f5d37!important;
       color: white!important;   
    }
              
</style>
<div class="container mt-4">

    <div class="row justify-content-center m-3 pt-5 pb-5">
        <div class="col-md-6">
            <div class="mb-3 py-3 px-3" style="background-color: #363c39; border-radius: 10px; border: 1px solid #5f5d37;">
                <div class="text-center">
                    <h3 class="text-white">{{ __('Login to Farmaax') }}</h3>
                </div>
                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>


                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="btn-outline-success text-decoration-none mySuccess my-2 my-sm-0 px-5 py-2">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="font-weight: bold; color: #f3ef8f;">
                                    Forgot Your Password?
                                </a>
                            @endif
                        </div>
                            
                            <span class="text-white">Don't have an account?</span><a class="btn btn-link" href="{{ url('register') }}" style="color: #f3ef8f; font-weight: bold;">Register</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3 d-none d-md-block" id="register-bg">
            <img src="images/farm-images/farmaax-image-file2.png" width="600px" alt="">
            {{-- <img src="{{ asset('images/tractor.jpg')}}" alt="" width="100%" height="100%" class=""> --}}
        </div>
        
    </div>
</div>

<style type="text/css">
    label{
        color: white;
    }


</style>
@endsection
