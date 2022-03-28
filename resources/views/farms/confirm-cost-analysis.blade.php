@extends('layouts.dashboard_master')
<style>
    .my-tabs,
    #my-tabs {
        border-radius: 20px !important;
        background-color: black;
        color: white !important;
        width: 200px;
        margin: 3px;
        padding: 7px;
        text-align: center;


    }

    a:hover{
        text-decoration: none!important;
    }
    .tab-link{
        color: #94bd41!important;
    }
    .btn-next{
        background-color: #94bd41!important;
        color: white!important;
    }
    .btn-next:hover{
        background-color: black!important;
        color: white!important;
    }
</style>
@section('title', 'Farm Cost Analysis for')
@section('content')

<section class="ftco-section ftco-no-pt bg-white" style="background-colo: #fbd341;">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            @if(!is_null($costs))
            <form method="post" action="{{ url('makeinvestment') }}">
                @csrf
                <div class="my-5 text-white">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active text-white" id="my-tabs"><a class="tab-link" href="#home" aria-controls="home" role="tab" data-toggle="tab">Cost Analysis</a></li>

                        <li role="presentation" class="text-white" id="my-tabs"><a class="tab-link" href="#farmer" aria-controls="farmer" role="tab" data-toggle="tab">Farmer Charges</a></li>

                        <li role="presentation" class="text-white" id="my-tabs"><a class="tab-link" href="#milestones" aria-controls="milestones" role="tab" data-toggle="tab">Project Milestone</a></;>

                        <li role="presentation" class="text-white" id="my-tabs"><a class="tab-link" href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Total Estimation</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="home">
                            @if(isset($costs) && !is_null($costs))
                            <div class="table-responsive">
                                 <table class="table table-dark " style="border-radius: 10px;width:100%;overflow:hiden">
                                    
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>ITEM</th>
                                                <th>COST</th>
                                                <th>TOTAL COST</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $anal_count=1; @endphp
                                            @foreach($costs as $cost)
                                                <tr>
                                                    <td>{{ $anal_count }}</td>

                                                    <td>{{ $cost->parameter }}</td>
                                                    <td>&#8358;{{ number_format($cost->amount) }}</td>
                                                    <td>&#8358;{{ number_format($cost->amount) }}</td>
                                                </tr>
                                                @php $anal_count ++; @endphp
                                            @endforeach
                                            
                                            <p>
                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <td>&#8358;{{ number_format($all_cost)}}</td>
                                                </p>
                                            </tr>
                                        </tfoot>
                                    

                                </table>
                            </div>
                            @else
                                <p class="text-danger">No cost Analysis for this farm</p>
                            @endif
                           
                            <a data-toggle="modal" data-target="#modelId" class="btn btn-next">Next </a>

                        </div>

                        <div role="tabpanel" class="tab-pane" id="farmer">
                            @if(isset($farmer_cost) && !is_null($farmer_cost))
                            <div class="table-responsive">
                                <table class="table table-dark " style="border-radius: 10px;width:100%;overflow:hiden">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>COST</th>
                                            <th>TOTAL COST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>


                                            <td>Farmer charges</td>
                                            <td>&#8358;{{ number_format($farmer_cost->amount) }}</td>
                                            <td>&#8358;{{ number_format($farmer_cost->amount) }}</td>
                                        </tr>
                                    </tbody>


                                </table>
                                <a data-toggle="modal" data-target="#modelId" class="btn btn-next">Next</a>
                            </div>
                            @else
                                <p class="text-danger">No Farmer cost Added for this farm</p>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="milestones">
                            @if(isset($milestones) && !is_null($milestones))
                            <div class="table-responsive">
                                <table class="table table-dark " style="border-radius: 10px;width:100%;overflow:hiden">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count=0; @endphp
                                        @foreach($milestones as $milestone)
                                             @php $count ++ @endphp
                                        <tr>
                                            <td>Milestone {{ $count }}</td>
                                            <td>{{ $milestone->title }}</td>
                                        </tr>
                                       
                                        @endforeach
                                        


                                    </tbody>


                                </table>
                                <a data-toggle="modal" data-target="#modelId" class="btn btn-next">Next</a>
                            </div>
                            @else
                                <p class="text-danger">No Milestone for this farm yet</p>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="settings">
                            @if(isset($costs) && !is_null($costs) && isset($farmer_cost) && !is_null($farmer_cost) )
                            <div class="table-responsive">
                                <table class="table table-dark " style="border-radius: 10px;width:100%;overflow:hiden">
                                    <thead>
                                        <tr>
                                            <th>TOTAL COST ANALYSIS</th>
                                            <th>FARMER COST</th>
                                            <th>TOTAL FARM COST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>


                                            <td>&#8358;{{ number_format($all_cost) }}</td>
                                            <td>&#8358;{{ number_format($farmer_cost->amount) }}</td>
                                            @php $total = $all_cost + $farmer_cost->amount @endphp
                                            <td>&#8358;{{ number_format($total) }}</td>
                                        </tr>
                                    </tbody>


                                </table> 
                                <a data-toggle="modal" data-target="#modelId" class="btn btn-next">Next</a>
                            </div>
                            @else
                                <p class="text-danger">Cannot display this data until cost analysis is completely added</p>
                            @endif
                        </div>
                    </div>
                </div>

            </form>

            @else
            <h3 class="text-danger text-center mt-3">No Cost Analysis Available for this farm</h3>
            @endif

        </div>
    </div>
</section>

@if(isset($cost) && !is_null($costs))
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize"> {{-- $manager->username --}} Finanlise Setup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid text-capitalize">
                    
                    <form action="{{ url('check_land_availability')  }}" method="post">
                        <div class="form-group">
                            <label for="farmer_name">Selected Farmer</label>
                            <input type="text" name="farmer_name" id="farmer_name" class="form-control" value="{{$selectedManager->wallet_id }}" readonly>
                        </div>
                        @csrf

                        <div class="form-group">
                            <label for="total_cost">Total Farm Cost: <b>&#8358;{{ number_format($total) }}</b></label>
                            <input type="text" name="total_cost" id="total_cost" class="form-control" value="{{$total}}" readonly>
                        </div>
                        {{-- <div class="form-group">
                            <label for="haveAFarm">Has a farm?</label>
                            <input type="text" value="{{$haveAFarm}}" readonly name="haveAfarm" class="form-control">
                        </div> --}}
                        <div class="form-group">
                            <label for="acre">@php echo session('hasLand')? 'How many Acres is your land?' :'Number of Acres' ; @endphp</label>
                            <input type="number" name="acre" id="acre" class="form-control" value="1" min="1" onchange="calcCost()">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                <button type="submit" class="btn btn-next">Proceed</button>


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


    function calcCost() {
        let total_cost = '{{$total}}';
        let acres = document.getElementById("acre").value;
        let totalFarmCost = document.getElementById("total_cost").value;
        let newTotal = acres * parseFloat(total_cost);
        //alert(totalFarmCost);

        document.getElementById("total_cost").value = newTotal;
    }
</script>

@endif



@endsection