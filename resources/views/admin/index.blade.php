@extends('layouts.admin')
@section('title', 'All Users in Farmaax')
@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body"> Realtors</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="float-left mr-5">{{ number_format($realtors) }}</span>
                <a class="small float-right text-white stretched-link" href="{{ route('realtors') }}"> View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body"> Farm Managers</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="float-left mr-5">{{ number_format($farmManagers) }}</span>
                <a class="small float-right text-white stretched-link" href="{{ route('farmManagers') }}"> View
                    Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body"></span> Lawyers
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="float-left mr-5">{{ number_format($lawyers) }}</span> <a
                    class="small float-right text-white stretched-link" href="{{ route('lawyers') }}"> View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body"> Marketers</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="float-left mr-5">{{ number_format($marketers) }}</span>
                <a class="small text-white float-right stretched-link" href="{{ route('marketers') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Area Chart Example
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>


{{-- <div class="card mb-4">
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
                <tfoot>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->firstName }}</td>
<td>{{ $user->lastName }}</td>
<td>{{ $user->username }}</td>
<td>{{ $user->email }}</td>
<td><a href="" class="btn btn-primary">View User</a></td>
</tr>
@endforeach




</tbody>
</table>
</div>
</div>
</div> --}}
@endsection
