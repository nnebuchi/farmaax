@extends('layouts.user')
@section('meta-tag')
    <meta name="keywords" content="lands for sale, buy a land, agriculture, 'invest, plots of land'">
@endsection
@section('title', 'Farmaax Lands available for sales')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 offset-md-3 item">
                <h2 class="text-center">List of your Lands</h2>

            </div>
        </div>
        @if (count($lands) > 0)
            <div class="row my-5">
                @foreach ($lands as $land)
                    <div class="col-md-6 col-lg-4 ">
                        <a href="{{ route('lands.show', $land->id) }}">
                            <div class="card">
                                <div class="card-img-top">
                                    <img src="{{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}"
                                        alt="land image" width="100%" height="200px">
                                </div>
                                <div class="card-footer">
                                    <h4 class=""> {{ $land->landTitle }} - &#8358;{{ number_format($land->price) }}</h4>
                                    <br>
                                    @if ($land->purchase_date == null)
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modelId7">
                                            Available for sale
                                        </button>
                                        {{-- <a href="{{ route('lands.show', $land->id) }}"
                                            class="btn btn-warning btn-sm text-white" data-toggle="modal"
                                            data-target="#landCart">
                                            Add To Cart
                                        </a> --}}
                                        <a href="{{ route('lands.show', $land->id) }}"
                                            class="btn btn-warning btn-sm text-white">
                                            Add To Cart
                                        </a>
                                    @else
                                        <a class="btn btn-danger btn-sm text-white">
                                            Sold Out
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="jumbotron text-center">
                <h3>No Land Available </h3>
                <a href="{{ route('lands.create') }}" class="btn btn-primary">Sell your Land Farmaax</a>
            </div>
        @endif
    </div>


@endsection
