@extends('layouts.user')
@section('title', 'My Farm List')
@section('content')

    <section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                    @csrf
                    <table class="table mt-5 table-dark px-3" style="border-radius: 10px;">
                        <thead>
                            <tr>
                                <th>Farm</th>
                                <th>Price Per Unit</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="{{ asset('storage/farmcategoryImages/' . $farm->image) }}" height="50"
                                        width="50" class="rounded-circle"></td>
                                <td>&#8358;{{ number_format($data['total_cost']) }}.00 </td>
                                <td><input type="number" id="acres" name="acres" class="units" min="1" value="{{ $data['acre'] }}"
                                        onchange="myFunction()"></td>
                                <td id="total">&#8358; {{ $data['total_cost']   * $data['acre']}}.00 </td>
                                <td id="total">
                                  <a href="" class=" btn btn-primary" data-toggle="modal"
                                  data-target="#modelId7">Proceed</a>
                                <a href="{{ route('remove-items') }}"><i class="fa fa-2x fa-trash text-danger" aria-hidden="true"></i></a>
                                </td>
                                @php

                                    $total = $data['total_cost']
                                @endphp

                            </tr>
                        </tbody>
                    </table>

            </div>
        </div>
    </section>


     <div class="modal fade" id="modelId7" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title "> Payment Method: <b></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('farmSetUpCheckout') }}" method="get">
                            <div class="form-group">
                                <label for="paymentMethod">Choose Payment method:</label>
                                <select id="paymentMethod" class="form-control" name="paymentMethod" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="wallet">Wallet</option>
                                    <option value="bank">Bank Debit</option>
                                </select>
                                <input type="hidden" id="total" value="{{ $total }}" name="amount">
                            </div>
                            @csrf


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Checkout</button>
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
      <script>
        function myFunction() {
            let cost = '{{ $data['total_cost'] }}';
            let acre = document.getElementById('acres').value;
            let = total = cost * acre
           document.getElementById('total').innerHTML = total
        }

    </script>

@endsection
