@extends('layouts.admin')
@section('meta-tag')
    <meta name="keywords" content="lands for sale, buy a land, agriculture, 'invest, plots of land'">
@endsection
@section('title', 'Farmaax Lands available for sales')
@section('content')
    @if (count($lands) > 0)
        <h2 class="text-center text-warning bg-white">Available Lands for Sale on Farmaax</h2>

        <div class="row">

            @foreach ($lands as $land)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('lands.show', $land->id) }}">
                        <div class="card">
                            <div class="card-img-top">
                                <img src="{{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}"
                                    alt="land image" width="100%" height="200px">
                            </div>
                            <div class="card-footer">
                                <h4 class=""> {{ $land->landTitle }} - {{ number_format($land->price) }}</h4>
                                <br>
                                <button type="button" class="btn btn-success btn-lg" data-toggle="modal"
                                    data-target="#modelId">
                                    Buy This Land
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="jumbotron text-center">
            <h4>No Lands For Sale Available</h4>
        </div>
    @endif
    </div>
    </div>



@endsection
