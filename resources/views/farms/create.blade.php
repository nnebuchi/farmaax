    @extends('layouts.admin')
    @section('title', 'Upload a farm on Farmaax')
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
                background-color: #4e9525 !important;
                border-bottom: 2px solid #676501;
                color: white;
                font-weight: bold;
            }

            .card-header h4 {
                color: white;
                font-weight: bold;
            }

        </style>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <div class="card">
                        <div class="card-header text-center">
                            Upload A Farm on Farmaax
                        </div>
                        <div class="card-body">
                            <form action="{{ route('farms.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="farm_category">Farm Category</label>
                                    <select class="form-control" name="farm_category" id="farm_category" required>
                                        <option selected disabled>Select farm Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="farm_type">Farm Type</label>
                                    <select class="form-control" name="farm_type" id="farm_type" required>
                                        <option selected disabled>Select farm type</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Country <span class="text-danger"><strong>*</strong></span></label>
                                    <select class='form-control pick-country' name="country" id="pick-country">
                                        <option class="myChooseCountry" selected disabled>Choose country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ ucfirst($country->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>State <span class="text-danger"><strong>*</strong></span></label>
                                    <select class='form-control pick-state' name="state" id="pick-state">
                                        <option class="myState" value="" selected disabled>State</option>
                                        {{-- @foreach ($states as $item) --}}
                                            {{-- <option value="{{ $item->id }}">{{ $item->name }}</option> --}}
                                        {{-- @endforeach --}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>LGA <span class="text-danger"><strong>*</strong></span></label>
                                    <select class='form-control pick-lga' name="lga" id="pick-lga">
                                        <option class="myTown" value="" selected disabled>LGA</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Location <span class="text-danger"></span></label>
                                    <select class='form-control pick-town' name="town" id="pick-town">
                                        <option class="myTown" value="" selected disabled>Select your Location</option>

                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="description">Farm Description: </label>
                                    <textarea class="form-control" name="description" id="description" rows="6"
                                        required></textarea>
                                </div> --}}
                                <div class="form-group">
                                    <label for="duration">Duration (months):</label>
                                    <input type="number" name="duration" id="duration" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="duration">Unit Cost (Naira):</label>
                                    <input type="number" name="unit_cost" id="unit_cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="duration">overall Cost (Naira):</label>
                                    <input type="number" name="overall_cost" id="overall_cost" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="duration">Profit (%):</label>
                                    <input type="number" name="profit" id="profit" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="turn_over_date">No. of units:</label>
                                    <input type="number" name="units" id="units" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="turn_over_date">Turn Over Date:</label>
                                    <input type="date" name="turn_over_date" id="turn_over_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="hand_over_date">Hand Over Date:</label>
                                    <input type="date" name="hand_over_date" id="hand_over_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="coverImage">Farm Cover Image:</label>
                                    <input type="file" class="form-control" name="coverImage" id="coverImage"
                                        placeholder="Farm Cover Image">
                                    @error('coverImage')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="farmImages">Farm Images:</label>
                                    <input type="file" multiple class="form-control" name="farmImages[]" id="farmImages">
                                    @error('farmImages[]')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>

                                <button type="submit" class=" btn-block btn btn-primary">Upload Farm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @include('farms.ajaxState') --}}
        <script>
            $('.pick-country').on('change', function() {
                let country_id = $(this).val();

                $.ajax(url+'/pickstates', {
                    type: 'POST',

                    data: {
                        'country_id': country_id,
                        '_token': universal_token,
                    }, // data to submit
                    success: function(feedback, status, xhr) {
                        // console.log(feedback);
                        let arr_count = -1
                        let result = JSON.parse(feedback);

                        $('.pick-state').empty();
                        var listItem = "";
                        $('.pick-state').append(
                            `<option class="myState" selected disabled>State</option>`);
                        $.each(result, function() {
                            arr_count++;
                            listItem += "<option value=" + result[arr_count]['id'] + ">" +
                                result[arr_count]['name'] + "</option>";

                            // let name=;
                            // let id=result[arr_count]['id'];
                            // $('.pick-state').append(`<option class="myState" value="`+id+`">`+name+`</option>`);
                        })
                        $('.pick-state').append(listItem);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        console.log(errorMessage);

                    }
                });
                /*$.post('pickstates', {
                'country_id':country_id,

                },
                function(feedback){
                console.log(feedback);

                var arr_count=-1
                result=JSON.parse(feedback);

                $('.pick-lga').empty();

                $('.pick-lga').append(`<option selected disabled>Select your LGA</option>`);
                $.each(result, function(){
                arr_count++;
                let name=result[arr_count]['name'];
                let id=result[arr_count]['id'];
                $('.pick-lga').append(`<option value="`+id+`">`+name+`</option>`);
                })

                })*/
            })
            // Loading LGA from database when state is selected

            $('.pick-state').on('change', function() {
                let state_id = $(this).val();
                $.post(url+'/picklgas', {
                        'state_id': state_id,
                        '_token': universal_token,
                    },
                    function(feedback) {

                        let arr_count = -1
                        let result = JSON.parse(feedback);

                        $('.pick-lga').empty();

                        $('.pick-lga').append(`<option selected disabled>Select your LGA</option>`);
                        $.each(result, function() {
                            arr_count++;
                            let name = result[arr_count]['name'];
                            let id = result[arr_count]['id'];
                            $('.pick-lga').append(`<option value="` + id + `">` + name + `</option>`);
                        })

                    })
            })

            // loading towns from database when LGA is selected

            $('.pick-lga').on('change', function() {
                let lga_id = $(this).val();
                $.post(url+'/picktowns', {
                        'lga_id': lga_id,
                        '_token': universal_token,
                    },
                    function(feedback) {
                        let arr_count = -1
                        let result = JSON.parse(feedback);
                        $('.pick-town').empty();

                        $('.pick-town').append(`<option selected disabled>Select your location </option>`);
                        $.each(result, function() {
                            arr_count++;
                            let name = result[arr_count]['name'];
                            let id = result[arr_count]['id'];
                            $('.pick-town').append(`<option value="` + id + `">` + name + `</option>`);
                        })

                    })
            })

        </script>
    @endsection
