@extends('layouts.front')

@section('content')
<style>
    .form-control{
       background-color: transparent!important;
       border: 1px solid #5f5d37!important; 
       color: white!important;  
    }

              
</style>
    <div class="container mt-4">
        <div class="row justify-content-center m-3">
            <div class="col-md-6 mt-5 pt-5">
                

                <div class="py-5 px-3" style="background-color: #363c39; border-radius: 10px; border: 1px solid #5f5d37;">

                    <div class="text-center">
                        <h3>{{ __('Reset Password') }}</h3>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="email">{{ __('E-Mail Address') }}</label>


                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="enter your email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            
                            <button type="submit"  class="btn-outline-success text-decoration-none  mySuccess my-2 my-sm-0">
                                {{ __('Send Password Reset Link') }}
                            </button>
                           
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-3 d-none d-md-block" id="register-bg">
            <img src="{{ asset('images/farm-images/farmaax-image-file2.png') }}" width="600px" alt="">
            {{-- <img src="{{ asset('images/tractor.jpg')}}" alt="" width="100%" height="100%" class=""> --}}
        </div>
            
        </div>
    </div>
    <style type="text/css">
    label, h3{
        color: white;
    }


</style>
@endsection
