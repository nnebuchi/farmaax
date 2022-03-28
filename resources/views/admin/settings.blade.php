@extends('layouts.admin')
@section('title', 'Site Settings')
@section('content')
    <div class=" mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-7 ">
                <div class="card ">
                    <div class="card-header text-center">
                    Site Settings
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add-settings') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="clearing">Consultant Signup Fee</label>
                                <input type="number" name="consultant_signup_fee" id="" class="form-control" placeholder="Consultant Signup Fee" value="{{ $settings->consultant_signup_fee }}" required>
                            </div>
                            <div class="form-group">
                                <label for="seeding">Consultant Referral Bonus</label>
                                <input type="number" name="consultant_referral_bonus" id="" class="form-control"
                                    placeholder="Consultant Referral Bonus" value="{{$settings->consultant_referral_bonus}}" required>
                            </div>
                            <div class="form-group">
                                <label for="transport">Paystack Key (Secret Key)</label>
                                <input type="text" name="paystack_key" id="" class="form-control" placeholder="Transport Cost" value="{{ $settings->paystack_key }}" required>
                            </div>

                            <div class="form-group">
                                <label for="transport">Price Per 10 Points</label>
                                <input type="number" name="referral_points" id="" class="form-control" placeholder="Referral Points" value="{{ $settings->referral_points }}" required>
                            </div>
                            <div class="form-group">
                                <label for="transport">Earning Count</label>
                                <input type="number" name="earning_count" id="" class="form-control" placeholder="Earning Count" value="{{ $settings->earning_count }}" required>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value=
                                "Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
