@extends('layouts.dashboard_master')
@section('title', 'Add your Bank Account Details')
@section('content')

<style>
    input, select{
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
                        <h4 class="text-monospac text-white">Update Account Details</h4>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('storeBankAccountDetails') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" id="country" class="form-control @error('country') is-invalid @enderror" required>
                                        <option selected disabled>Select Country</option>
                                        @foreach( $countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('countries')
                                    <li class="text-danger">
                                        {{ $message }}
                                    </li>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select name="state" id="state" class="form-control @error('state') is-invalid @enderror" required>
                                        <option selected disabled>Select state</option>
                                        @if(Auth::user()->state!=null)
                                            @foreach( $states as $state)
                                            <option value="{{ $state->id }}"  @if(Auth::user()->state==$state->id)selected @endif>{{ $state->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('state')
                                    <li class="text-danger">
                                        {{ $message }}
                                    </li>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">LGA</label>
                                    <select name="lga" id="lga" class="form-control @error('lga') is-invalid @enderror" required>
                                        <option selected disabled>Select LGA</option>
                                         @if(Auth::user()->lga!=null)
                                            @foreach( $lgas as $lga)
                                            <option value="{{ $lga->id }}" @if(Auth::user()->lga==$lga->id)selected @endif>{{ $lga->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('state')
                                    <li class="text-danger">
                                        {{ $message }}
                                    </li>
                                    @enderror
                                </div>
                                <label for="account_name">Account Name:</label>
                                <input type="text" name="account_name" id="account_name" class="form-control @error('account_name') is-invalid @enderror" required>
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
                                <select name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" required>
                                    <option selected disabled>Select Bank</option>
                                    @foreach( $banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }} @php echo !empty($bank->abbr)? '('.$bank->abbr.')' : '' @endphp </option>
                                    @endforeach
                                </select>
                                @error('bank_name')
                                <li class="text-danger">
                                    {{ $message }}
                                </li>
                                @enderror
                            </div>

                            <button type="submit" class="btn primary-btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
