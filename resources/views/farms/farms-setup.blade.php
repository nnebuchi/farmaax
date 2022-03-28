@extends('layouts.dashboard_master')
@section('title', 'Farm Setup')
@section('content')

<style>
    .farm-cover-img {
        height: 200px;
    }

    .blog-entry {
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.296);
    }
</style>

<section class="ftco-sectio bg-ligh py-5">

    <div class="row">
        <div class="col-md-6 offset-md-3 item">
            <h2 class="text-center">Choose Farm here</h2>
        </div>
    </div>
</section>



<!-- detail Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="invest-modal" tabindex="-1" role="dialog" aria-labelledby="invest-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titl" id="exampleModalLabel">Farm Setup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-bod px-3 py-3">
                <form method="post" action="{{ route('showFarmCost') }}">
                    @csrf
                    <div class="form-group">
                        <label>Farm Name: <b class="aval-unit"></b></label>
                        <input type="hidden" value="" name="nameOfFarm" id="nameOfFarm">
                    </div>
                    <div class="form-group">
                        <label for="">Do you have a farm?</label>
                        @php
                       
                        @endphp
                        <select class="form-control first-option" name="haveAFarm" id="haveAFarm" onchange="showNextForm()" required>
                            <option selected disabled>choose answer</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group" style="display:none" id="locationIfNoLand">
                        <label for="">Where do you want your farm to be located:</label>
                        <select class="form-control" name="state_id" id="locationIfNoLands" required>
                            <option selected disabled>Select State</option>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <label for="">LGA</label>
                        <select class="form-control pick-lga" id="lga" name="lga">

                        </select>
                        <p><b>Note:</b> If you don't have a farmland, you will have to either buy or lease from us.</p>
                    </div>
                    <div class="form-group" style="display:none" id="locationIfHasFarm">
                        <label for="">Location of your farm</label>

                        <select class="form-control" name="state_id" id="haveAFarm">
                            <option selected disabled>Select State</option>
                            @foreach ($states as $state)
                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                            @endforeach
                        </select>

                        {{-- <label for="">LGA</label>
                        <select class="form-control pick-lga" id="lga" name="lga">

                        </select> --}}
                    </div>
                    <div class="form-group" style="display:none" id="addressIfHasFarm">
                        <label for="">Address of your farm location</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter address of your farm">
                    </div>

                    <input type="hidden" name="idOfFarm" id="idOfFarm" value="">
                    <button class="btn btn-block primary-btn proceed">Proceed</button>
                </form>
                

            </div>

        </div>
    </div>
</div>


<section class="ftco-section bg-ligh" style="background-colo: #262401!important;">
    <div class="container">
        <div class="row d-flex">
            @foreach ($farms as $farm)

                <div class="col-md-4 col-lg-3  col-sm-6 mb-3">
                    <div class="card card-body bg-white myBorder">
                        <img class="img-fluid" src="{{asset('storage/farmcategoryImages/'.$farm->image) }}" style="border-radius: 20px;height: 200px;">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center"><b>{{ $farm->name }}</b></h4>
                                <hr>
                            </div>
                            <div class="col-6">
                                <!-- <small class="headin mb-0"><a href="#">Rivers</a></small> -->
                                <!-- <span> Farm Cost</span> -->
                                <p><button type="button" id="farm-{{ $farm->id }}-invest" farm-id="{{ $farm->id }}" class="btn primary-btn btn-sm btn-block farm-select" data-toggle="modal" data-target="#invest-modal" style="border-radius: 10px;">Select</button></p>
                            </div>

                            <div class="col-6">
                                <!-- <small class="headin mb-0"><a href="#">6 Months</a></small> -->
                                <!-- <span> Duration</span> -->
                                <p><button type="button" id="farm-{{ $farm->id }}" class="btn secondary-btn btn-sm btn-block" data-toggle="modal" data-target="#exampleModal" style="border-radius: 10px;">Details</button></p>
                            </div>
                        </div>

                    </div>
                </div>

                <script>

                    var universal_token = '<?php echo csrf_token();?>';
                    // let idOfFarm = "{{ $farm->id }}";
                     // console.log(idOfFarm);
                    $('#farm-{{ $farm->id }}').on('click', function() {


                        let farm_id = 'farm-{{ $farm->id }}';
                        let farmtype = '<?php echo $farm->name; ?>';

                        $('.modal-body').empty();
                        $('.modal-body').html(`<?= $farm->description ?>`);
                        $('.modal-title').empty();
                        $('.modal-title').append(farmtype);
                    });


                    $('#farm-{{ $farm->id }}-invest').on('click', function() {

                       
                        $('#idOfFarm').val("{{ $farm->id }}");

                    });




                    $.ajaxSetup({
                        data: {
                            // _token: $('meta[name="csrf-token"]').attr('content')
// 
                             _token: universal_token
                        }
                    });

                    $(document).ready(function() {
                             $('#locationIfNoLands').on('change', function() {


                                //var id = $(this).val();
                                let state_id = document.getElementById("locationIfNoLands").value
                                $('#lga').empty();
                                // $('#lga').append('<option value="0">Processing . . .</option>');
                                // console.log(id)

                                $.post(url+'/lgas', {
                                        'state_id': state_id,
                                    },

                                    function(feedback) {
                                        // console.log(feedback);
                                        var arr_count = -1;
                                        result = JSON.parse(feedback);
                                        // console.log(result);
                                        $('.pick-lga').empty();


                                        $('.pick-lga').append(
                                            `<option selected disabled>Select your LGA</option>`);

                                        $.each(result, function() {
                                            arr_count++;
                                            let name = result[arr_count]['name'];
                                            let id = result[arr_count]['id'];
                                            $('.pick-lga').append(`<option value="` + id + `">` + name +
                                                `</option>`);

                                        });

                                    });
                            });
                        });
                
                </script>

            @endforeach

        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    {{-- {{ $farms->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function showNextForm() {
        var getValue = document.getElementById('haveAFarm').value;
        if (getValue == 'yes') {
            document.getElementById('locationIfNoLand').style.display = 'none'

            document.getElementById('locationIfHasFarm').style.display = 'block';
            document.getElementById('addressIfHasFarm').style.display = 'block';
        } else if (getValue == 'no') {
            document.getElementById('locationIfNoLand').style.display = 'block'
            document.getElementById('locationIfHasFarm').style.display = 'none';
            document.getElementById('addressIfHasFarm').style.display = 'none';
        }
    }


    $('.farm-select').on('click', function(){

        $('.proceed').attr('disabled', 'true');

        $('.first-option').children('option:selected').prop("selected", false)
        $('.first-option option:first').prop("selected", true)

    });


     $('.first-option').on('change', function(){

        $('.proceed').removeAttr('disabled');
     })


</script>

@endsection