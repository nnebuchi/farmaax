@extends('layouts.user')


<style>
    .farm-cover-img {
        height: 200px;
    }

    .blog-entry {
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.296);
    }
</style>
@section('content')
<section class="ftco-sectio bg-light py-5">

    <div class="row">
        <div class="col-md-6 offset-md-3 item">
            <h2 class="text-center">Choose Farm here</h2>
        </div>
    </div>
</section>



<!-- detail Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>

        </div>
    </div>
</div>

<!-- invest Modal -->
<div class="modal fade" id="invest-modal" tabindex="-1" role="dialog" aria-labelledby="invest-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titl" id="exampleModalLabel">Farm Setup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-bod px-3 py-3">
                <form method="post" action="{{ route('confirmFarmSetup') }}">
                    @csrf
                 <div class="form-group">
                        <label>Farm Name:    <b class="aval-unit"></b></label>
                    </div>
                    <div class="form-group">
                      <label for="">Do you have a farm?</label>
                    @php
                    $states = \App\State::all();
                    @endphp
                      <select class="form-control" name="" id="haveAFarm"  onclick="showNextForm()"required>
                        <option>choose answer</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                     
                      </select>
                    </div>
                    <div class="form-group" style="display:none" id="locationIfNoLand">
                      <label for="">Where do you want your farm to be located:</label>
                      <select class="form-control" name="location"  >
                         @foreach ($states as $state)
                           <option value="{{$state->name}}">{{$state->name}}</option> 
                        @endforeach
                      </select>
                      <p><b>Note:</b> If you don't have a farmland, you will have to either buy or lease from us.</p>
                    </div>
                    <div class="form-group" style="display:none" id="locationIfHasFarm">
                      <label for="">Location of your farm</label>
                      <select class="form-control" name="" id="haveAFarm" >
                        @foreach ($states as $state)
                           <option value="{{$state->name}}">{{$state->name}}</option> 
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group" style="display:none" id="addressIfHasFarm">
                      <label for="">Address of your farm location</label>
                      <input type="text" name="address" id="address" class="form-control" placeholder="Enter address of your farm">
                    </div>
                    
                  
                    <button class="btn btn-block primary-btn">Proceed</button>
                </form>

            </div>

        </div>
    </div>
</div>


<section class="ftco-section bg-light" style="background-color: #262401!important;">
    <div class="container">
        <div class="row d-flex">
            @foreach($farms as $farm)
            <div class="col-md-4 col-lg-3  col-sm-6 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="blog-single.html" class="block-20 farm-cover-img"
                        style="background-image: url({{asset('storage/farmcategoryImages/'.$farm->typeimage) }});">
                    </a>
                    <div class="text p-4 float-right d-block item">
                  
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center"><b>{{ $farm->farmtype}}</b></h4>
                                <hr>
                            </div>
                            <div class="col-6">
                                <!-- <small class="headin mb-0"><a href="#">Rivers</a></small> -->
                                <!-- <span> Farm Cost</span> -->
                                <p><button type="button" id="farm-{{ $farm->farm_id }}-invest"
                                        class="btn primary-btn btn-sm" data-toggle="modal"
                                        data-target="#invest-modal">Select</button></p>
                            </div>

                            <div class="col-6">
                                <!-- <small class="headin mb-0"><a href="#">6 Months</a></small> -->
                                <!-- <span> Duration</span> -->
                                <p><button type="button" id="farm-{{ $farm->farm_id }}" class="btn secondary-btn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Details</button></p>
                            </div>
                        </div>
                        <script>
                            $('#farm-{{ $farm->farm_id }}').on('click', function(){

                                        // let desc = ;
                                        // desc =desc.st
                                        let farm_id='farm-{{ $farm->farm_id }}';
                                        let farmtype='<?php echo $farm->farmtype; ?>';

                                        $('.modal-body').empty();
                                        $('.modal-body').html(`<?=$farm->description?>`);
                                        $('.modal-title').empty();
                                        $('.modal-title').append(farmtype);
                                    });


                                    $('#farm-{{ $farm->farm_id }}-invest').on('click', function(){

                                        let farmid='{{ $farm->farm_id }}';

                                        // $('.farm_id').val('');
                                        $('.farm_id').val(farmid);
                                        $('.aval-unit').empty();
                                        $('.aval-unit').append('{{ $farm->name}}');
                                        $('.units').attr('max', '{{ (int)$farm->total_units - (int)$farm->units_taken }}');
                                        // $('.modal-bod').append(desc);

                                    });
                        </script>


                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <li><a href="#">&lt;</a></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&gt;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function showNextForm(){
    var getValue = document.getElementById('haveAFarm').value;
     if(getValue == 'yes'){
                  document.getElementById('locationIfNoLand').style.display = 'none'

         document.getElementById('locationIfHasFarm').style.display = 'block';
         document.getElementById('addressIfHasFarm').style.display = 'block';
     }
     else if(getValue == 'no'){
         document.getElementById('locationIfNoLand').style.display = 'block'
           document.getElementById('locationIfHasFarm').style.display = 'none';
         document.getElementById('addressIfHasFarm').style.display = 'none';
     }
}
</script>

<!-- loader -->
{{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px"
            height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div> --}}

@endsection
