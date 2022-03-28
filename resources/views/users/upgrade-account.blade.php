@extends('layouts.dashboard_master')
@section('title', 'Upgrade Account')
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
            <div class="row justify-content-center">

                <div class="col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4 class="text-monospace">Upgrade Account</h4>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ route('account_upgrade_action') }}" method="post">
                                <strong for="">Select the account type to upgrade</strong> 
                                @csrf
                                    <div class="form-group mt-3">
                                        
                                        <input type="radio" name="name" id="consultant" class="form-check-input" value="consultant">
                                        <label class="form-check-label">Consultant</label> 
                                    </div>
                                    <div class="form-grouo mt-3 border py-3 px-2 sub-form" id="consultantForm" style="display: none; background-color: #525225;">
                                            <p style="color: white!important; border-bottom: 1px solid white;">pick one or more interests (&#8358; 5000 registration fee applies) </p>
                                            
                                                <input type="checkbox" name="consultant[]" class=" consultant-type" value="lawyer"> <label class="text-white">Lawyer</label>

                                                <input type="checkbox" name="consultant[]" class=" consultant-type" value="realtor"> <label class="text-white">Realtor</label>

                                                <input type="checkbox" name="consultant[]" class=" consultant-type" value="marketer"> <label class="text-white">Marketer</label>
                                            
                                            {{-- <select name="farmType" id="farmType" class="form-control" required>
                                                <option selected disabled>Select farm type</option>
                                                @foreach ($farmType as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }} </option>
                                                @endforeach
                                            </select> --}}

                                    </div>
                                    <div class="form-group">
                                        {{-- <input type="radio" name="name" id="name" class="" value="Marketer"> Marketer
                                        <br>
                                        <input type="radio" name="name" id="name" class="" value="Lawyer"> Lawyer <br> --}}
                                        <input type="radio" name="name" id="farm-manager" class="form-check-input" value="farm_manager">
                                        <label class="form-check-label">Farm-Manager</label>
                                        
                                    </div>
                                    <div class="form-grouo mt-3 border py-3 px-2 sub-form" id="managerForm" style="display: none; background-color: #525225;">
                                            <p style="color: white!important; border-bottom: 1px solid white;">Select farm type </p>
                                            
                                            @foreach ($farmType as $item)
                                                <input type="checkbox" name="farm_type[]" class="farm-type" value="{{ $item->id }}"> <label class="text-white">{{ $item->name }}</label>
                                            @endforeach
                                            {{-- <select name="farmType" id="farmType" class="form-control" required>
                                                <option selected disabled>Select farm type</option>
                                                @foreach ($farmType as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }} </option>
                                                @endforeach
                                            </select> --}}

                                    </div>

                                        <br>
                                        @error('name')
                                        <li class="text-danger">
                                            {{ $message }}
                                        </li>
                                        @enderror
                                       
                                        {{-- <small>Cost of &#8358;5,000</small> --}}

                                    

                                    <button type="submit" class="btn primary-btn">Upgrade My Account</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endsection
