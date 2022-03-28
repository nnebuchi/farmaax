@extends('layouts.dashboard_master')
@section('title', 'Lands')
@section('content')

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 offset-md-3 item">
                <h2 class="text-center">Lands</h2>

            </div>
        </div>
        @if (count($lands) > 0)

            <div class="row my-5">
                @foreach ($lands as $land)
                    <div class="col-md-4 col-lg-3 col-6 mb-5">
                        {{-- <a href="{{ route('lands.show', $land->id) }}"> --}}
                           <div class="card" style="box-shadow: 2px 5px 5px rgba(0,0,0,0.496);">
                                <a href="{{ route('lands.show', $land->id) }}"><div class="card-img-top" style="background-image: url({{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}); background-size: cover;background-position: center; height: 150px;">
                                    
                                </div></a>
                                <div class="card-foote">
                                    <a href="{{ route('lands.show', $land->id) }}" class="land-title"><h6 class="text-success mt-2"> {{ $land->landTitle }}</h6> <h6 class="" style="font-weight: bold; color: #262401"> &#8358;{{ number_format($land->price) }}</h6></a>
                                    
                                    @if ($land->purchase_date == null)
                                    <div class="row mb-2 px-1 mt-1">
                                        <div class="col-sm-5 mb-1">
                                            <a href="{{ route('lands.show', $land->id) }}" type="button" class="btn primary-btn btn-sm btn-block" data-toggle="modal" data-target="#modelId7"> view</a>
                                        </div>
                                        <div class="col-sm-7 mb-1 ">
                                            <a href="{{ route('lands.show', $land->id) }}" class="btn secondary-btn btn-sm btn-block text-white">
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                        
                                        
                                        
                                    @else
                                        <p class="text-danger mb-4">
                                            Sold Out
                                        </p>
                                    @endif
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>
                @endforeach
            </div>
        @else
            <div class="jumbotron text-center">
                <h3>No Land Available </h3>
            </div>
        @endif
    </div>
   
   <style type="text/css">
       .land-title{
            text-decoration: none!important;

        }
       

       /*.land-title:hover{
            color: black!important;
       } */  

   </style>

@endsection
