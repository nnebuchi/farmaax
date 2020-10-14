@extends('layouts.admin')

@section('title', 'Farmaax farms awaiting for approval')
@section('content')
    @if (count($farms) > 0)
        <h2 class="text-center text-warning bg-white">Farms awaiting for Approval</h2>
        <div class="row mb-4">
            @foreach ($farms as $farm)
                <div class="col-md-12 col-lg-4">
                    <a href="{{ route('farms.show', $farm->id) }}">
                        <div class="card">
                            <div class="card-img-top">
                                <img src="/storage/farmCoverImages/{{ $farm->cover_image }}" alt="farm image" width="100%"
                                    height="200px">
                            </div>
                            <div class="card-footer">
                                <h4 class="">Farm Type: {{ ucwords($farm->farm_type) }} </h4>
                                <h4 class="">Farm Category {{ ucwords($farm->farm_category) }} </h4>
                                <a href="{{ route('users.show', $farm->owner_id) }}" class="btn btn-success btn-sm">View
                                    Owners
                                    Profile</a>
                                <a href="{{ route('farms.awaiting.approval.show', $farm->id) }}"
                                    class="btn btn-warning btn-sm">View
                                    Farm</a>
                                <br>

                            </div>
                        </div>
                    </a>
                    <br>
                </div>

            @endforeach
        </div>
    @else
        <div class="jumbotron text-center">
            <h4>No farms Awaiting for Approval</h4>
        </div>
    @endif
    </div>
    </div>



@endsection
