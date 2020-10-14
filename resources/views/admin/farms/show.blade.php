@extends('layouts.admin')
@section('title', 'land Details')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-img-top">
                    <img src="{{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}" alt="Land Cover image"
                        width="100%" height="80%">
                </div>
                <div class="card-body">
                    <ul>
                        <li><b>Name:</b> {{ $land->landTitle }}</li>
                        <li><b>Price:</b> &#8358;{{ number_format($land->price) }}</li>
                        <li><b>State:</b> {{ $land->state }}</li>
                        <li><b>L.G.A:</b> {{ $land->lga }}</li>
                        <li><b>Town:</b> {{ $land->town }}</li>
                        <li><b>Address:</b> {{ $land->address }}</li>
                    </ul>

                </div>
                <div class="row justify-content-center">
                    @foreach ($landPhotos as $item)
                        <div class="col-md-4 col-lg-4">
                            <img src="{{ asset('/storage/landForSaleLandImages/' . $item->images) }}" alt="land images"
                                width="100%" height="80%">
                        </div>
                    @endforeach

                </div>
                <div class="card-footer text-center">
                    @if ($land->purchase_date === null)
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                            Buy This Land
                        </button>
                    @else
                        <h4 class="text-danger">Sold Out</h4>
                    @endif

                </div>
            </div>
        </div>

    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buy A Land On Farmaax</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{ Auth::user()->firstName . ' ' . Auth::user()->lastName }}, You are about to buy
                        <b> {{ $land->landTitle }}</b> at the sum of &#8358;<b>{{ number_format($land->price) }}</b>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Not Now</button>
                    <a href="{{ route('pay', $land->id) }}" class="btn btn-primary  text-center">Buy
                        Now</a>
                </div>
            </div>
        </div>

        <script>
            $('#exampleModal').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Use above variables to manipulate the DOM

            });

        </script>
    @endsection
