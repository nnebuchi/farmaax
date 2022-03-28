@extends('layouts.dashboard_master')
@section('title', 'Available Lands')
@section('content')
    <style>
        input {
            border: 2px solid #676501 !important;
        }

        label {
            color: #4e9525 !important;
        }

        .card {
            border: 2px solid #676501 !important;
            border-radius: 12px;
            ">

        }

        .card-header {
            border-radius: 12px;
            background-color: #525225 !important;
            border-bottom: 2px solid #676501;
        }

        .card-header h4 {
            color: white;
            font-weight: bold;
        }

    </style>
    <section class="ftco-section testimony-section mt-5" style="background-colo: #676501;">
        <div class="container">
            @if(empty($land))

                <h2 class="text-danger">We don't have farmlands currently in {{ $stateData->name }} state.</h2>
            @else
            <div class="row justify-content-center">


                 <div class="col-md-8 mt-5">
                    <h2> Selected Land for your farm</h2>
                    <div class="card card-body myBorder myFarmSelect bg-transparent">
                        <div class="myImg d-flex justify-content-center" style="background-image: url({{ asset('storage/landForSaleCoverImages/'.$land[0]->coverImage) }}); background-size: cover; height:300px; background-position: center;">
                            {{-- <img src="images/apple.png" alt=""> --}}
                        </div>
                        <!-- row1 -->

                        <div class="row mt-5">
                            <div class="col-4 mb-3 offset-2">
                                <span class="float text-center float-left nanumGothic">
                                    State
                                </span>

                            </div>

                            <div class="col-4 mb-3 offset-2">
                                 <span class="float text-center float-left">
                                    {{ ucfirst($land[0]->stateName)}}
                                </span>
                            </div>

                            <div class="col-4 mb-3 offset-2">
                                <span class="float text-center float-left nanumGothic">
                                    LGA
                                </span>
                            </div>
                            <div class="col-4 mb-3 offset-2">
                                 <span class="float text-center float-left text-muted">
                                    {{ucfirst($land[0]->lgaName) }}
                                </span>
                            </div>

                            <div class="col-4 mb-3 offset-2">
                                <span class="float text-center float-left nanumGothic">
                                    Size
                                </span>
                                
                            </div>

                            <div class="col-4 mb-3 offset-2">
                                <span class="loat text-center float-left text-muted">
                                    {{ $requestedSize }} Acres
                                </span>
                            </div>
                            <div class="col-4 mb-3 offset-2">
                                <span class="float text-center float-left nanumGothic">
                                    Price
                                </span>
                                
                            </div>

                            <div class="col-4 mb-3 offset-2">
                                <span class="loat text-center float-left text-muted">
                                   &#8358 {{ number_format(($land[0]->price/$land[0]->acres)*$requestedSize)  }}
                                </span>
                            </div>

                        </div>
                        

                        <div class="float-container mx-4 py-4">
                            <span class="float text-center float-left">
                             <a href="" class="btn btn-sm btn-outline-success nanumGothic myDetails" data-toggle="modal" data-target="#staticBackdrop">Details</a>
                            </span>
                            <!-- Select 2 Modal -->
                             <!-- Modal -->
                            {{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content myModal">
                                        <div class="modal-header">
                                            <div class="modal-title h4 myPaddingTB" id="staticBackdropLabel">Select Farm Land</div>
                                            <button type="button" class="close myOutline" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="btn myExit">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="form-row form-group px-3">                                   
                                                    <label for="" class="nanumGothic myLabel">State</label>
                                                    <input type="text" name="" class="form-control myControl" id="">        
                                                </div>

                                                <div class="form-row form-group px-3">    
                                                    <label for="" class="nanumGothic myLabel">Local Government</label>
                                                    <input type="text" name="" class="form-control myControl" id="">
                                                </div>

                                                <div class="form-row form-group px-3">    
                                                    <label for="" class="nanumGothic myLabel">Community</label>
                                                    <input type="text" name="" class="form-control myControl" id="">
                                                </div>

                                                <div class="form-row form-group px-3">    
                                                    <label for="" class="nanumGothic myLabel">How many Acres</label>
                                                    <input type="text" name="" class="form-control myControl" id="">
                                                </div>

                                                <div class="form-row form-group px-3">    
                                                    
                                                      <button class="btn btn-success mySelect">
                                                          Proceed
                                                      </button>
                                                </div>
                                            </form>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div> --}}

                            <span class="float text-center text-capitalize float-right">
                                <a href="{{ url('finalize-setup') }}" class="btn btn-sm btn-success nanumGothic mySelect">Proceed</a>
                            </span>
                        </div>

                    </div>
                </div>

                
            </div>

            <div class="row justify-content-center">
                @foreach($land as $pic)

                 <div class="col-md-4 mt-5">
                    <div class="card card-body myBorder myFarmSelect bg-transparent">
                        <div class="myImg d-flex justify-content-center" style="background-image: url({{ asset('storage/landForSaleLandImages/'.$pic->landpic) }}); background-size: cover; height:150px; background-position: center;">
                            
                        </div>
                    </div>
                               
                </div>

                @endforeach
            </div>

            @endif
        </div>

                        
    
                <script>

                    $('#farm-manager').on('click', function(){
                       
                        $('.sub-form').css('display', 'none');
                        if ($(this).is(':checked')) {
                             $('.consultant-type').each(function(){
                                $(this).prop('checked', false);
                            });
                            var nextForm = document.getElementById('managerForm');

                                nextForm.style.display = 'block';
                           
                        }else{
                            nextForm.style.display = 'none';
                        }

                        // console.log()
                        
                    })


                    $('#consultant').on('click', function(){
                         
                        $('.sub-form').css('display', 'none');
                        if ($(this).is(':checked')) {
                            $('.farm-type').each(function(){
                            $(this).prop('checked', false);
                        });
                            var nextForm = document.getElementById('consultantForm');
                            // if (nextForm.style.display == 'none') {
                                nextForm.style.display = 'block';
                            // } else {
                                

                            // }
                        }else{
                            nextForm.style.display = 'none';
                        }

                        
                    })
                   

                </script>
            </div>
        </div>
    </section>
@endsection
