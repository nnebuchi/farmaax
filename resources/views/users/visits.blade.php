@extends('layouts.dashboard_master')
@section('title', 'My Earnings from Referral')
@section('content')

   <style type="text/css">

        @media(max-width: 576px){
            table{
                font-size: 12px!important;
            }
        }

    </style>
    <section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                    <div class="table-responsive">
                        <table class="table mt-5 table-dark px-3" style="border-radius: 10px;">

                            <thead>
                                <tr>
                                    <th>Total Referred</th>
                                     <th>Amount Earned</th>
                                </tr>
                            </thead>
                            <tbody>


                                    <tr>
                                 <td>{{ Auth::user()->visitcount()->count() }} </td>

                                        <td>&#8358;{{$total }}</td>

                                    </tr>

                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </section>




@endsection

