@extends('layouts.auth')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center m-3">
            <div class="col-md-6 mt-3 mb-3" id="register-bg">
                <img src="/images/register.jpg" alt="" width="100%" height="100%" class="">
            </div>
            <div class="col-md-6 mt-5">
                <div class="-header text-center">
                    <h3>{{ __('Reset Password') }}</h3>
                </div>

                <div class="-body">
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
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
