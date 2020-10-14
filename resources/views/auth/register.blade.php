@extends('layouts.user')
@section('content')
@section('title', 'Create an acount | Farmaax')
    <div class="container mt-4">
        <div class="row justify-content-center m-3">
            <div class="col-md-6 mt-3 mb-3" id="register-bg">
                <img src="{{ asset('images/maize.png') }}" alt="" width="100%" height="100%" class="">
            </div>
            <div class="col-md-6">
                <div class=" mb-3">
                    <div class=" text-center mt-5 mb-4">
                        <h3>{{ __('CREATE AN ACCOUNT') }}</h3>
                    </div>
                    <div class="">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="firstName" class="">{{ __('First Name') }}</label>
                                        <input id="firstName" type="text"
                                            class="form-control @error('firstName') is-invalid @enderror" name="firstName"
                                            value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                        @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="lastName" class="">{{ __('Last Name') }}</label>
                                        <input id="lastName" type="text"
                                            class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                                            value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                        @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="username" class="">{{ __('Username') }}</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="email" class="">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="phone" class="">{{ __('Phone Number') }}</label>

                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <div class="form-group ">
                                <label for="password" class="">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input id="agreement" class="custom-control-input" type="checkbox" name="agreement"
                                    value="true" required>
                                <label for="agreement" class="custom-control-label"> By clicking "Register" You agree to
                                    Farmaax Terms of farm collaboration, set up, land purchase and privacy
                                    policy.</label>
                            </div>
                            <br>
                            <div class="form-group  mb-0">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
