@extends('layouts.admin')
@section('title', 'land Details')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-6 my-5">
                <div class="card">
                    <div class="card-img-top">
                        <img src="{{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}"
                            alt="Land Cover image" width="100%" height="80%">
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><b>Name:</b> {{ $land->landTitle }}</li>
                            <li><b>Price:</b> &#8358;{{ number_format($land->price) }}</li>
                            <li><b>State:</b> {{ $land->state }}</li>
                            <li><b>L.G.A:</b> {{ $land->lga }}</li>
                            <li><b>Town:</b> {{ $land->town }}</li>
                            <li><b>Address:</b> {{ $land->address }}</li>
                            <li><b>Available Acres:</b> {{ $land->acres }}</li>
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
                        @if ($land->purchase_date == null)
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modelId7">
                                Buy This Land
                            </button>
                            <a class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#landCart">
                                Add To Cart
                            </a>
                        @else
                            <a class="btn btn-danger btn-sm text-white">
                                Sold Out
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <div class="modal fade" id="landCart" tabindex="-1" role="dialog" aria-labelledby="landCart" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Available Acres: <b>{{ $land->acres }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('addLandToCart', $land->id) }}" method="get">
                            <div class="form-group">
                                <label for="acres">Number of Acres</label>
                                <input type="number" name="acres" id="acres" oninput="calculate()" class="form-control"
                                    placeholder="Number Of Acres" required max="{{ $land->acres }}">
                            </div>
                            <div class=" form-group">
                                <p id="subtotal" class="text-center">Subtotal:</p>
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                    </form>
                </div>
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


    <!-- Modal -->
    <div class="modal fade" id="modelId7" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Available Acres: <b>{{ $land->acres }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('landPayment', $land->id) }}" method="get">
                            <div class="form-group">
                                <label for="quantityOfAcres">Number of Acres</label>
                                <input type="number" name="quantityOfAcres" id="quantityOfAcres"
                                    oninput="calculateQuantity()" class="form-control" placeholder="Number Of Acres"
                                    required max="{{ $land->acres }}">
                            </div>
                            <div class="form-group">
                                <label for="paymentMethod">Choose Payment method:</label>
                                <select id="paymentMethod" class="form-control" name="paymentMethod" required>
                                    <option>Select Payment Method</option>
                                    <option value="wallet">Wallet</option>
                                    <option value="bank">Bank Debit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <p id="quantitySubtotal" class="text-center">Subtotal:</p>
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Buy Now</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
    <script>
        function calculate() {
            var land = document.getElementById('acres').value;
            var total = '{{ $land->price }}' * land;

            document.getElementById('subtotal').innerHTML = 'Subtotal: &#8358;' + total
        }

        function calculateQuantity() {
            var land = document.getElementById('quantityOfAcres').value;
            var total = '{{ $land->price }}' * land;

            document.getElementById('quantitySubtotal').innerHTML = 'Subtotal: &#8358;' + total
        }

    </script>
    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });

    </script>


@endsection
