@extends('layouts.admin')
@section('meta-tag')
    <meta name="keywords" content="farms for sale, buy a farm, agriculture, 'invest, plots of farm'">
@endsection
@section('title', 'Farmaax farms available for sales')
@section('content')
    @if (count($farms) > 0)
        <h2 class="text-center text-warning bg-white">Farms for Sale on Farmaax</h2>

        <div class="row">

            @foreach ($farms as $farm)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('farms.show', $farm->id) }}">
                        <div class="card">
                            <div class="card-img-top">
                                <img src="{{ asset('/storage/farmForSaleCoverImages/' . $farm->coverImage) }}"
                                    alt="farm image" width="100%" height="200px">
                            </div>
                            <div class="card-footer">
                                <h4 class=""> {{ $farm->farmTitle }} - &#8358;{{ number_format($farm->price) }}</h4>
                                <br>
                                @if ($farm->purchase_date === null)
                                    <button type="button" class="btn btn-success ">
                                        Buy This farm
                                    </button>
                                @else
                                    <h4 class=" text-danger">Sold Out</h4>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="jumbotron text-center">
            <h4>No farms Available</h4>
        </div>
    @endif




@endsection
