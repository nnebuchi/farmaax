@extends('layouts.app')
@section('meta-tag')
    <meta name="keywords" content="lands for sale, buy a land, agriculture, 'invest, plots of land'">
@endsection
@section('title', 'Farmaax Lands available for sales')
@section('content')
    <div class="container">
        @if (count($lands) > 0)
            <h2 class="text-center">Lands for Sale</h2>
            <div class="row">
                @foreach ($lands as $land)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('realtors.show', $land->id) }}">
                            <div class="card">
                                <div class="card-img-top">
                                    <img src="{{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}"
                                        alt="land image" width="100%" height="200px">
                                </div>
                                <div class="card-footer">
                                    <h4 class=""> {{ $land->landTitle }}</h4>
                                    {{ number_format($land->price) }} <br>
                                    <p class="text-center btn btn-success"><a href="{{ route('pay') }}">Buy Now</a></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
    </div>
@endsection
