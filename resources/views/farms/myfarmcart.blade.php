@extends('layouts.dashboard_master')
@section('title', 'Farm Setup Cart')
@section('content')

    <section class="ftco-section ftco-no-pt" style="background-colo: #fbd341;">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-3">
              <h3>Farm Setup Cart</h3>
                {{-- <form method="post" action="{{ url('makeinvestment') }}"> --}}
                    {{-- @csrf --}}
                    <div class="table-responsive">
                        <table class="table mt-5 table-dark cart-table px-3" style="border-radius: 10px;">
                            <thead>
                                <tr>
                                    <th>Farm</th>
                                     <th>Size (acres)</th>
                                    <th>Total Farm Cost</th>
                                    <th>Land Cost (&#8358;)</th>
                                    <th>Grand Total</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myfarmcart as $mycart)

                                @php
                                  // dd($mycart->land_id)
                                @endphp

                                @php $grand_total = $mycart->total_land_cost + $mycart->total_farm_cost  @endphp
                                    <tr>
                                        <td><img src="{{ asset('storage/farmcategoryImages/'.$mycart->farmtypeImage) }}" height="50"
                                                width="50" class="rounded-circle"></td>
                                        <td>{{ number_format($mycart->size) }}</td>
                                        <td>&#8358;{{number_format($mycart->total_farm_cost) }}</td>
                                        <td><span class="sub-t">{{ $mycart->land_id>0 ? number_format($mycart->total_land_cost) : 'N/A' }}</span></td>
                                        <td>&#8358;<span class="sub-t">{{ $mycart->land_id>0 ? number_format($grand_total) : number_format($mycart->total_farm_cost)}}</span></td>
                                        <td>
                                            <button class="btn btn-sm primary-btn" data-toggle="modal" data-target="#cart-{{ $mycart->id }}">Pay</button>

                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{ $mycart->id }}"><i class="fa fa-trash"></i></button>

                                            {{-- 
                                            <button class="btn btn-sm primary-btn">pay farm cost </button>
                                            <button class="btn btn-sm primary-btn">pay land</button> --}}
                                        </td>

                                        <input type="hidden" name="amount" class="sub-t-form" value="{{ $mycart->land_id>0 ?  $grand_total : $mycart->total_farm_cost }}">
                                        <input type="hidden" name="farm_id" value="{{ $mycart->id }}">

                                    </tr>

                                     <!-- Confim payment Modal -->
                                        <div class="modal fade" id="cart-{{ $mycart->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">

                                                You are about to pay the sum of {{ $mycart->land_id>0 ? number_format($grand_total) : $mycart->total_farm_cost }} naira as total farm setup cost
                                              </div>
                                              <div class="modal-footer">
                                                <form action="{{ url('farmsetup-pay')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="total_amount" value="{{ $mycart->land_id>0 ? $grand_total : $mycart->total_farm_cost}}">
                                                    <input type="hidden" name="farm_id" value="{{ $mycart->my_farm_id }}">
                                                
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <button class="btn primary-btn">Proceed</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>


                                        <!-- Confim Delete Modal -->
                                        <div class="modal fade" id="delete-{{ $mycart->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">

                                                You are about to delete this farm from your cart
                                              </div>
                                              <div class="modal-footer">
                                                <form action="{{ url('farmcart-delete/'.$mycart->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="total_amount" value="{{ $mycart->land_id>0 ? $grand_total : $mycart->total_farm_cost}}">
                                                    <input type="hidden" name="farm_id" value="{{ $mycart->my_farm_id }}">
                                                
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



            </div>
        </div>
    </section>

    <style type="text/css">
        @media(max-width: 992px){
            .cart-table{
                font-size: 13px!important;
                font-weight: normal!important;
            }
        }
        @media(max-width: 576px){
            .cart-table{
                font-size: 11px!important;
                font-weight: normal!important;
            }
        }
    </style>

    <script>
        let myFunction = function(){

       $('.sub-t').text( $('.units').val() * $('.hidden-cost').text())
       $('.sub-t-form').val( $('.units').val() * $('.hidden-cost').text())
      }
      $('.units').on('input', myFunction);
      $('.units').on('change', myFunction);
    </script>

@endsection
