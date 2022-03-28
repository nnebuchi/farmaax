@extends('layouts.dashboard_master')
@section('meta-tag')
    <meta name="keywords" content="lands for sale, buy a land, agriculture, 'invest, plots of land'">
@endsection
@section('title', 'Farmaax Lands available for sales')
@section('content')
<style>
    .text-buchi{
        color: #262401;
    }
</style>
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
                                    <h6 class="text-success"> {{ $land->landTitle }} </h6>
                                    <h5 class="text-buchi"> &#8358;{{ number_format($land->price) }}</h5>
                                   <a href="{{ route('edit-land', $land->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    
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
