@extends('layouts.admin')
@section('title', ' User Referral Info')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users mr-1"></i>
            User Referral Information
            <a href="{{ route('admin.user-referrals') }}" class="btn btn-success float-right">Back</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total Referred</th>
                            <th>Amount Earned</th>
                        </tr>
                    </thead>

                    <tbody>

                            <tr>
                                <td>{{ $user->firstName }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->visitcount()->count() }}</td>
                                <td>{{ $total }}</td>

                            </tr>





                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
