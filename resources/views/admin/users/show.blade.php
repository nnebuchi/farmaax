@extends('layouts.admin')
@section('title', 'Farmaax User Profile')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header text-center">{{ $user->firstName . ' ' . $user->lastName }}'s Profile </div>
                <div class="card-body">
                    <p>First Name: <b>{{ $user->firstName }}</b></p>
                    <p>Last Name: <b>{{ $user->lastName }}</b></p>
                    <p>Username: <b>{{ $user->username }}</b></p>
                    <p>Email Address: <b>{{ $user->email }}</b></p>
                    <p>Phone Number: <b><a href="tel://{{ $user->phone }}">{{ $user->phone }}</a></b></p>
                    <div id="accountDetails" style="display: none">
                        <p>Account Name: <b>{{ $user->account_name }}</b></p>
                        <p>Account Number: <b>{{ $user->account_number }}</b></p>
                        <p>Bank Name: <b>{{ $user->bank_name }}</b></p>
                    </div>
                    <button class="btn btn-success " onclick="accountDetailsFunction()"> Show/Hide Acccount
                        Details</button>

                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        function accountDetailsFunction() {
            var x = document.getElementById("accountDetails");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
@endsection
@endsection
