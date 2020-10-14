@extends('layouts.user')
@section('title', 'My Lands')
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 offset-md-3 item">
                <h2 class="text-center">List of my Lands</h2>

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
                                    <p class=""><a class=" btn btn-success"
                                            href="{{ route('lands.show', $land->id) }} ">View</a></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="jumbotron text-center">
                <h3>No Land Available </h3>
                <a href="{{ route('lands.index') }}" class="btn btn-primary">Buy A Land</a>
            </div>
        @endif
    </div>
@endsection
