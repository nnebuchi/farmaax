@extends('layouts.dashboard_master')
@section('title')
@section('content')

<section class="ftco-section ftco-no-pt" style="background-colo: #fbd341;">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="mt-3">Land Cart</h3>
            @if(count($landcart)>0)
            <div class="table-responsive">
                <table class="table mt-5 table-dark px-3 " style="border-radius: 10px;">
                    <thead>
                        <tr>
                            <th>Farm</th>
                            <th>Price per acre</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count=0
                        @endphp
                        @foreach($landcart as $cart)
                            @php
                                $count ++;
                            @endphp
                            <tr>
                                
                                    <td><img src="{{ asset('storage/landForSaleCoverImages/'.$cart->coverImage) }}" height="50"
                                            width="50" class="rounded-circle"></td>
                                    <td>&#8358; {{number_format($cart->price/$cart->grossLandSize) }} <span
                                            class="hidden-cost-{{ $count }} d-none">{{ ($cart->price/$cart->grossLandSize) }}</span></td>
                                    <td><input type="number" name="units" class="units-{{ $count }}"
                                            value="<?= $cart->selectedSize ?>"></td>
                                    <td>&#8358; <span
                                            class="sub-t-{{ $count }}">{{ number_format($cart->selectedSize *  ($cart->price/$cart->grossLandSize)) }}</span>
                                    </td>
                                    {{-- <td><button class="btn btn-sm primary-btn">proceed</button></td> --}}
                                    <td><button class="btn btn-sm primary-btn" data-toggle="modal" data-target="#cart-{{ $cart->cartid }}">Proceed</button></td>
                                    <td><button role="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{ $cart->cartid }}"><i class="fa fa-trash"></i></button></td>

                                    <input type="hidden" name="amount" class="sub-t-form-{{ $count }}"
                                        value="{{ $cart->selectedSize *  ($cart->price/$cart->grossLandSize) }}">
                                    <input type="hidden" name="cart_id" value="{{ $cart->cartid }}">
                                

                            </tr>

                            <script>
                                let myFunction_{{ $count }} = function(){
    									$('.sub-t-{{ $count }}').text( $('.units-{{ $count }}').val() * $('.hidden-cost-{{ $count }}').text());
    									$('.sub-t-form-{{ $count }}').val( $('.units-{{ $count }}').val() * $('.hidden-cost-{{ $count }}').text());

                                        $('.sum-{{ $count }}').text( $('.units-{{ $count }}').val() * $('.hidden-cost-{{ $count }}').text());

                                        $('.size-{{ $count }}').val( $('.units-{{ $count }}').val() );

    								}

    								$('.units-{{ $count }}').on('input', myFunction_{{ $count }});
    								$('.units-{{ $count }}').on('change', myFunction_{{ $count }});
                            </script>

                            <!-- Confim Delete Modal -->
                            <div class="modal fade" id="delete-{{ $cart->cartid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                    You are about to delete this land from your cart
                                  </div>
                                  <div class="modal-footer">
                                    <form action="{{ url('landcart-delete/'.$cart->cartid)}}" method="post">
                                        @csrf
                                        {{-- <input type="hidden" name="total_amount" value="{{ $mycart->land_id>0 ? $grand_total : $mycart->total_farm_cost}}">
                                        <input type="hidden" name="farm_id" value="{{ $mycart->my_farm_id }}"> --}}
                                    
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button class="btn primary-btn">Proceed</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>




                            <!-- Confirm payment Modal -->
                            <div class="modal fade" id="cart-{{ $cart->cartid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                      <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                      </div>
                                      <div class="modal-body">
                                            You are about to pay the sum of <span class="sum-{{ $count }}"></span> naira as total farm setup cost
                                      </div>
                                      <div class="modal-footer">
                                        <form method="post" action="{{ url('landcartpayment/'.$cart->land_id) }}">
                                            @csrf
                                            

                                            <input type="hidden" name="amount" class="sub-t-form-{{ $count }}"
                                                value="{{ $cart->price/$cart->grossLandSize }}">
                                            <input type="hidden" name="cart_id" value="{{ $cart->cartid }}">

                                            <input type="hidden" name="units" class="size-{{ $count }}" value="{{ $cart->selectedSize }}">
                                        
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            <button class="btn primary-btn">Proceed</button>
                                        </form>
                                      </div>
                                </div>
                              </div>
                            </div>

                        @endforeach
                    </tbody>
                </table>

            </div>
            @else
                <h4 class="text-danger mt-5">No Land in your cart</h4>
            @endif


        </div>
    </div>
</section>
@endsection
