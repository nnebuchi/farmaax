@extends('layouts.dashboard_master')
@section('title', 'My Transactions')
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
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>&#8358;{{ number_format($transaction->amount) }} </td>
                                        <td>{{ strtoupper($transaction->description) }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td> <span class="badge <?php echo $transaction->status =='success' ? 'badge-success' : 'badge-danger' ?>">{{ ucfirst($transaction->status) }}</span></td>

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
