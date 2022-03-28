@extends('layouts.'.$layout)
@section('title', 'Farm Details')
@section('content')
    <div class="row justify-content-center my-5">
        <div class="col-md-12 col-lg-6">
            <div class="card text-center">
                <div class="card-img-top">
                    <img src="{{ asset('/storage/farmcategoryImages/' . $mainFarmDetails->image) }}" alt="farm Cover image"
                        width="80%" height="60%">
                </div>
                <div class="card-body">
                    <p class=""><b>Farm Name</b> {{ ucwords($mainFarmDetails->name) }} </p>
                    <p class=""><b>Farm Details</b> {{ ucwords($farm->description) }} </p>
                    <p class=""><b>Name Of Owner</b> {{ ucwords($owner->firstName . ' '. $owner->lastName) }} </p>


                </div>
                {{-- @if (count($farmPhotos) > 0)
                    <div class="row justify-content-center">
                        @foreach ($farmPhotos as $item)
                            <div class="col-md-4 col-lg-4">
                                <img src="{{ asset('/storage/farmImages/' . $item->images) }}" alt="farm images"
                                    width="100%" height="80%">
                            </div>
                        @endforeach

                    </div>
                @endif --}}

            </div>
        </div>
    </div>

    </div>
    </div>



@endsection
