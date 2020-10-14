@extends('layouts.auth')
@section('title', 'Add your Bank Account Details')
@section('content')

<style>
    input{
        border: 2px solid #676501!important;
    }

    label{
        color: #4e9525 !important;
    }

    
</style>
    <section class="ftco-section testimony-section" style="background-colo: #676501;">
           
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8 col-12">
                <div class="card" style="border: 2px solid #676501 !important; border-radius: 12px;">
                         @include('layouts.alert')
                    <div class="card-header text-center" style="border-radius: 12px; background-color: #4e9525 !important; border-bottom: 2px solid  #676501;">
                        <h4 class="text-monospac text-white">Add Bank Account Details</h4>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('storeBankAccountDetails') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="account_name">Account Name:</label>
                                <input type="text" name="account_name" id="account_name"
                                    class="form-control @error('account_name') is-invalid @enderror"
                                    placeholder="Enter your Account Name" required>
                                @error('account_name')
                                <li class="text-danger">
                                    {{ $message }}
                                </li>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number:</label>
                                <input type="number" name="account_number" id="account_number"
                                    class="form-control @error('account_number') is-invalid @enderror"
                                    placeholder="Enter your Account Number" required>
                                @error('account_number')
                                <li class="text-danger">
                                    {{ $message }}
                                </li>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name:</label>
                                <input type="text" name="bank_name" id="bank_name"
                                    class="form-control @error('bank_name') is-invalid @enderror"
                                    placeholder="Enter your Bank Name" required>
                                @error('bank_name')
                                <li class="text-danger">
                                    {{ $message }}
                                </li>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add My Bank Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
