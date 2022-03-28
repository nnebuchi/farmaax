@extends('layouts.dashboard_master')
@section('title', 'Fund my wallet')
@section('content')
<style>
    input{
        border: 2px solid #676501!important;
    }

    label{
        color: #4e9525 !important;
    }

    .card{
        border: 2px solid #676501 !important; border-radius: 12px;">
    }

    .card-header{
        border-radius: 12px; background-color: #4e9525 !important; border-bottom: 2px solid  #676501;
    }

    .card-header h4{
        color: white;
        font-weight: bold;
    }
</style>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="text-monospace">Fund your Wallet</h4>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('initializeWalletFunding') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="amount">Enter Amount:</label>
                                    <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Enter Amount to be funded" required min="1">
                                    @error('amount')
                                    <li class="text-danger">
                                        {{ $message }}
                                    </li>
                                    @enderror
                                </div>

                                <button type="submit" class="btn primary-btn">Proceed >>></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
