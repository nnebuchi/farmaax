@extends('layouts.dashboard_master')
@section('title', 'My downlines')
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
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                    @foreach($downlines as $downline)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $downline->username }}  </td>
                                        <td>{{ $downline->created_at }}</td>
                                        
                                    </tr>
                                    @php $count ++ @endphp
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
 
            </div>
        </div>
    </section>


    

@endsection
