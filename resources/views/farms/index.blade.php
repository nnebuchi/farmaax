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
            <h2 class="text-center">Select Farm here</h2>

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
                <h5 class="modal-titl" id="exampleModalLabel">Make Investment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-bod px-3 py-3">
                <h3>Available Units: <span class="aval-unit"></span></h3>
                <form method="post" action="{{ url('confirminvestment') }}">
                    @csrf
                    <div class="form-group">
                        <label>Units</label>
                        <input type="number" name="units" class="form-control units" required>
                    </div>
                    <input type="hidden" name="farm_id" class="farm_id" required>
                    {{-- <input type="hidden" name="farm_id" class="farm_id"> --}}
                    <button class="btn btn-block primary-btn">Make Investment</button>
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
                        @if($farm->profit!='')
                        <div class="topper d-flex align-items-center">
                            <div class="one py-2 pl-3 pr-1 align-self-stretch">
                                <span class="day">{{ $farm->profit }}</span>
                            </div>
                            <div class="two pl-0 pr-3 py-2 align-self-stretch">
                                <span class="yr">%</span>
                                <span class="mos">Return</span>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center">{{ $farm->farmtype}}</h4>
                                <div class="row">
                                    <div class="col-6">
                                        @if( $farm->duration!='')<h3 class="heading mb-0 text-center mb-3"><a href="#"
                                                class="badge secondary-btn" style="background-color: ">
                                                {{ $farm->duration }} months </a></h3>@endif
                                    </div>
                                    <div class="col-6">
                                        @if( $farm->unit_cost!='')<h3 class="heading mb-0 text-center mb-3"><a href="#"
                                                class="badge secondary-btn" style="background-color: ">&#8358;
                                                {{ $farm->unit_cost }} </a></h3>@endif
                                    </div>
                                </div>



                                <hr>
                            </div>
                            <div class="col-6">
                                <!-- <small class="headin mb-0"><a href="#">Rivers</a></small> -->
                                <!-- <span> Farm Cost</span> -->
                                <p><button type="button" id="farm-{{ $farm->farm_id }}-invest"
                                        class="btn primary-btn btn-sm" data-toggle="modal"
                                        data-target="#invest-modal">Invest</button></p>
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
                                        $('.aval-unit').append('{{ (int)$farm->total_units - (int)$farm->units_taken }}');
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



<!-- loader -->
{{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px"
            height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div> --}}

@endsection
