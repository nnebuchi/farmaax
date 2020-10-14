@extends('layouts.admin')
@section('title', 'All Farmaax ' . $name)
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users mr-1"></i>
            All Farmaax {{ $name }}
        </div>
        <div class="card-body">
            @if (count($users) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Farm Managing</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->firstName }}</td>
                                    <td>{{ $user->lastName }}</td>
                                    <td>
                                        @if ($user->managesFarm == 1)
                                            {{ 'Has A Farm Managing' }}
                                        @else
                                            {{ 'Not Managing any Farm' }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->managesFarm == 1)
                                            <a href="{{ route('showFarmManaged', $user->id) }}"
                                                class="btn btn-sm btn-primary">View
                                                Farm Managing</a>
                                        @else
                                            <a href="{{ route('assignFarm', $user->id) }}"
                                                class="btn btn-sm btn-primary">Assign a Farm</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
            @else
                <div class="jumbotron-fluid">
                    <h3>No {{ $name }} Available </h3>
                </div>
            @endif
        </div>
    </div>
@endsection
