@extends('layouts.user')
@section('title')
@section('content')

<section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <div class="table-responsive">
                <table class="table mt-5 table-dark px-3 " style="border-radius: 10px;">
                    <thead>
                        <tr>
                            <th>Farm</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count=0
                        @endphp
                        @foreach($farmcart as $cart)
                        @php
                        $count ++;
                        @endphp
                        <tr>
                            <form method="post" action="{{ url('makeinvestment/'.$cart->cartid) }}">
                                @csrf
                                <td><img src="{{ asset('storage/farmcategoryImages/'.$cart->typeimage) }}" height="50"
                                        width="50" class="rounded-circle"></td>
                                <td>&#8358; {{number_format($cart->unit_cost) }} <span
                                        class="hidden-cost-{{ $count }} d-none">{{ $cart->unit_cost }}</span></td>
                                <td><input type="number" name="units" class="units-{{ $count }}"
                                        value="<?= $cart->units ?>"></td>
                                <td>&#8358; <span
                                        class="sub-t-{{ $count }}">{{ number_format($cart->units *  $cart->unit_cost) }}</span>
                                </td>
                                <td><button class="btn btn-sm primary-btn">proceed</button></td>
                                <td><a href="{{ route('removeFromCart', $cart->cartid) }}"><i
                                            class="fa text-danger fa-trash fa-2x" aria-hidden="true"></i></a></td>

                                <input type="hidden" name="amount" class="sub-t-form-{{ $count }}"
                                    value="{{ $cart->units *  $cart->unit_cost }}">
                                <input type="hidden" name="farm_id" value="{{ $cart->farm_id }}">
                            </form>

                        </tr>

                        <script>
                            let myFunction_{{ $count }} = function(){

									$('.sub-t-{{ $count }}').text( $('.units-{{ $count }}').val() * $('.hidden-cost-{{ $count }}').text())
									$('.sub-t-form-{{ $count }}').val( $('.units-{{ $count }}').val() * $('.hidden-cost-{{ $count }}').text())
								}
								$('.units-{{ $count }}').on('input', myFunction_{{ $count }});
								$('.units-{{ $count }}').on('change', myFunction_{{ $count }});
                        </script>


                        @endforeach
                    </tbody>
                </table>

            </div>


        </div>
    </div>
</section>
@endsection
