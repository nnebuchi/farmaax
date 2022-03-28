@extends('layouts.front')

@section('content')
    <div class="my-5 py-5 px-2 px-md-3">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12">
                <div class="car">
                    <div class="card-heade text-center"><h3>{{ __('Reset Password') }}</h3></div>

                    <div class="card-bod mt-5">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                          

                           
                                <div class="form-group">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                           

                                <div class="form-group">
                                     <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            

                            
                                <div class="form-group">
                                    <button type="submit" class="btn-outline-success text-decoration-none  mySuccess my-2 my-sm-0">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
