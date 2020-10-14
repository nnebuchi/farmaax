@extends('layouts.admin')
@section('title', 'Farm Details')
@section('content')
    <div class="row justify-content-center mb-4">
        <div class="col-md-12 col-lg-6">
            <div class="card text-center">
                <div class="card-img-top">
                    <img src="/storage/farmCoverImages/{{ $farm->cover_image }}" alt="farm Cover image" width="80%"
                        height="60%">
                </div>
                <div class="card-body">
                    <p class="">Farm Type: <b>{{ ucwords($farm->farm_type) }}</b> </p>
                    <p class="">Farm Category: <b>{{ ucwords($farm->farm_category) }}</b> </p>
                    <p class="">Farm Description: <b>{{ ucwords($farm->description) }}</b> </p>
                    <p class="">Turn Over Date: <b>{{ ucwords($farm->turn_over_date) }}</b> </p>
                    <p class="">Hand Over Date: <b>{{ ucwords($farm->hand_over_date) }}</b> </p>
                    <p>Date Uploaded: <b>{{ $farm->created_at->diffForHumans() }}</b></p>

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
                <a href="{{ route('farms.awaiting.approval.approve', $farm->id) }}" class="btn btn-success">Approve Land</a>
            </div>
        </div>
    </div>

    </div>
    </div>


@endsection
