@extends('layouts.admin')
@section('title', 'All Users Referral Info')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users mr-1"></i>
            All Users Referral Information
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Total Referred</th>
                            {{-- <th>Amount Earned</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->firstName }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->visitcount()->count() }}</td>
                                {{-- <td>{{ $user-> }}</td> --}}
                                <td> <a href="{{ route('admin.showUserReferral', $user->id) }}" class="btn btn-primary">View Details</a></td>
                            </tr>
                        @endforeach




                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
