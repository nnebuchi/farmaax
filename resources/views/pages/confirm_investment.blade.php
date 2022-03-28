@extends('layouts.dashboard_master')
@section('title')
@section('content')

    <section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="{{ url('makeinvestment') }}">
                    @csrf
                    <table class="table mt-5 table-dark px-3" style="border-radius: 10px;">
                        <thead>
                            <tr>
                                <th>Farm</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="{{ asset('storage/farmcategoryImages/' . $farm->typeimage) }}" height="50"
                                        width="50" class="rounded-circle"></td>
                                <td>&#8358; {{ number_format($farm->unit_cost) }} <span
                                        class="hidden-cost d-none">{{ $farm->unit_cost }}</span></td>
                                <td><input type="number" name="units" class="units" value="<?= $selected_units ?>" max="{{ $farm->total_units }}" min="1"></td>
                                <td>&#8358; <span
                                        class="sub-t">{{ number_format($selected_units * $farm->unit_cost) }}</span></td>
                                <td><button class="btn btn-sm primary-btn">proceed</button></td>

                                <input type="hidden" name="amount" class="sub-t-form"
                                    value="{{ $selected_units * $farm->unit_cost }}">
                                <input type="hidden" name="farm_id" value="{{ $farm->farm_id }}">

                            </tr>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>
    </section>

    <script>
        let myFunction = function(){

       $('.sub-t').text( $('.units').val() * $('.hidden-cost').text())
       $('.sub-t-form').val( $('.units').val() * $('.hidden-cost').text())
      }
      $('.units').on('input', myFunction);
      $('.units').on('change', myFunction);
    </script>

@endsection
