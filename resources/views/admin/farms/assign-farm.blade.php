@extends('layouts.admin')
@section('title', 'Farmaax farms ')
@section('content')
    @if (count($farms) > 0)
        <h2 class="text-center">Assign Farm to a Farm Manager on Farmaax</h2>
        <div class="row">
            @foreach ($farms as $farm)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('farms.show', $farm->id) }}">
                        <div class="card ">
                            <div class="card-img-top text-center">
                                <img src="/storage/farmCoverImages/{{ $farm->cover_image }} " alt="farm image" width="200px"
                                    height="200px">
                            </div>
                            <div class="card-footer">
                                <h4 class="">Farm Type: {{ ucwords($farm->farm_type) }} </h4>
                                <h4 class="">Farm Category: {{ ucwords($farm->farm_category) }} </h4>
                                <div class="text-center"> <a href="{{ route('makeUserAFarmManager', [$id, $farm->id]) }}"
                                        class="btn btn-success ">Assign this Farm to this
                                        User</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
    </div> @else
        <div class="jumbotron text-center">
            <h3>No Land Available </h3>
        </div>


    @endif

@endsection
