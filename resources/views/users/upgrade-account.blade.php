@extends('layouts.auth')
@section('title', 'Upgrade Account')
@section('content')
    <style>
        input {
            border: 2px solid #676501 !important;
        }

        label {
            color: #4e9525 !important;
        }

        .card {
            border: 2px solid #676501 !important;
            border-radius: 12px;
            ">

        }

        .card-header {
            border-radius: 12px;
            background-color: #4e9525 !important;
            border-bottom: 2px solid #676501;
        }

        .card-header h4 {
            color: white;
            font-weight: bold;
        }

    </style>
    <section class="ftco-section testimony-section" style="background-colo: #676501;">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="text-monospace">Upgrade Account</h4>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ route('upgrade.account.payment') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Select the boxes to upgrade to any of these plans</label> <br>
                                        <input type="checkbox" name="name[]" id="name" class="" value="Realtor"> Realtor
                                        <br>
                                        <input type="checkbox" name="name[]" id="name" class="" value="Marketer"> Marketer
                                        <br>
                                        <input type="checkbox" name="name[]" id="name" class="" value="Lawyer"> Lawyer <br>
                                        <input type="checkbox" name="name[]" id="name" class="" value="Farm_manager"
                                            onclick="showNextForm()">
                                        Farm-Manager
                                        <br>
                                        <div class="" id="nextForm" style="display: none">
                                            <b>Select the Type of Farm you can manage</b> <br>
                                            @foreach ($farmType as $item)
                                                <input type="checkbox" name="" id="farmtype" class=""
                                                    value="{{ $item->name }}">
                                                {{ $item->name }} <br>
                                            @endforeach


                                        </div>
                                        <small>Cost of &#8358;5,000</small>
                                        @error('name')
                                        <li class="text-danger">
                                            {{ $message }}
                                        </li>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Upgrade My Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function showNextForm() {
            var nextForm = document.getElementById('nextForm');
            if (nextForm.style.display == 'none') {
                nextForm.style.display = 'block';
            } else {
                nextForm.style.display = 'none';

            }
        }

    </script>
@endsection
