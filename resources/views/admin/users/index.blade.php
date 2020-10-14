@extends('layouts.admin')
@section('title', 'All Users in Farmaax')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users mr-1"></i>
            All Farmaax Users
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->firstName }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">View
                                        User</a></td>
                            </tr>
                        @endforeach




                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
