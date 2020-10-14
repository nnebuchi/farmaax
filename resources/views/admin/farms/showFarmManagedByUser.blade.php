@extends('layouts.admin')
@section('title', 'Farm Managed')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="card text-center">
                <div class="card-img-top">
                    <img src="/storage/farmCoverImages/{{ $farm->cover_image }}" alt="farm Cover image" width="80%"
                        height="60%">
                </div>
                <div class="card-body">
                    <h4 class="">Farm Manager: {{ ucwords($manager) }} </h4>
                    <h4 class="">Farm Type: {{ ucwords($farm->farm_type) }} </h4>
                    <h4 class="">Farm Category: {{ ucwords($farm->farm_category) }} </h4>
                    <h4 class="">Turn Over Date: {{ ucwords($farm->turn_over_date) }} </h4>
                    <h4 class="">Hand Over Date: {{ ucwords($farm->hand_over_date) }} </h4>
                    <h4>Date Uploaded: {{ $farm->created_at->diffForHumans() }}</h4>

                </div>
                @if (count($farmPhotos) > 0)
                    <div class="row justify-content-center">
                        @foreach ($farmPhotos as $item)
                            <div class="col-md-4 col-lg-4">
                                <img src="{{ asset('/storage/farmImages/' . $item->images) }}" alt="farm images"
                                    width="100%" height="80%">
                            </div>
                        @endforeach

                    </div>
                @endif

            </div>
        </div>
    </div>

    </div>
    </div>



@endsection
