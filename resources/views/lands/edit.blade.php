@extends('layouts.dashboard_master')
@section('meta-tags')
    <meta name="description" content="Sell your lands on farmaax">
    <meta name="keywords" content="Lands, lands for sale, sell lands, purchase a land">
@endsection
@section('content')
@section('title', 'Sell a land on Farmaax')
<style type="text/css">
    .card{
        /*background-color: #262401;*/
        color: white!important;
    }
</style>
    <div class="containe mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="car my-5">
                    <div class="card-header text-center">
                       Edit your land
                    </div>
                    @php
                    $states = \App\State::all();
                    @endphp
                    <div class="card-body">
                        <form action="{{ route('update-land', $land->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-lg-4 offset-lg-2 col-md-5 offset-md-1 col-sm-8 offset-sm-2">
                                    <div class="form-group">
                                        <label for="landTitle">Land Title:</label>
                                        <input value="{{ $land->landTitle }}" id="landTitle" class="form-control @error('landTitle') is-invalid @enderror" type="text" name="landTitle" required>
                                        @error('landTitle')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="acres">Acres Available:</label>
                                        <input type="number" name="acres" id="acres" value="{{ $land->acres }}"
                                            class="form-control @error('acres') is-invalid @enderror" required>
                                        @error('acres')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State:</label>

                                        <select name="state" id="state" class="form-control @error('state') is-invalid @enderror" required>
                                            <option selected disabled>Select state</option>
                                            {{-- @if(Auth::user()->state!=null) --}}
                                                @foreach( $states as $state)
                                                <option value="{{ $state->id }}"  @if($land->state==$state->id)selected @endif>{{ $state->name }}</option>
                                                @endforeach
                                            {{-- @endif --}}
                                        </select>

                                        @error('state')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="lga">L.G.A:</label>
                                        <select name="lga" id="lga" class="form-control @error('lga') is-invalid @enderror" required>
                                            <option selected disabled>Select LGA</option>

                                                @foreach( $myStateLga as $lga)
                                                    <option value="{{ $lga->id }}"  @if($land->lga==$lga->id)selected @endif>{{ $lga->name }}</option>
                                                @endforeach
                                        </select>
                                        @error('lga')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <div cxlass="form-group">
                                        <label for="town">Town:</label>
                                        <input id="town" value="{{ $land->town }}"
                                            class="form-control @error('town') is-invalid @enderror" type="text" name="town"
                                            required>
                                        @error('town')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <textarea id="address" class="form-control @error('address') is-invalid @enderror"
                                            type="text" name="address" rows="3" required>{{ $land->address }}</textarea>
                                        @error('address')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-5 offset-md-0 col-sm-8 offset-sm-2">

                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="number" name="price" id="price" value="{{ $land->price }}"
                                            class="form-control @error('price') is-invalid @enderror" required>
                                        @error('price')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Land Description: </label>
                                        <textarea class="form-control" name="description" id="description" rows="4"
                                            required>{{ $land->description }}</textarea>
                                    </div>

                                    <img id="blah" class="mt-2 mb-3" src="{{ asset('/storage/landForSaleCoverImages/'.$land->coverImage) }}" alt="your image" height="200" />
                                    <div class="form-group">
                                        <label for="coverImage">Land Cover Image:</label>
                                        <input type="file" class="form-control imgInp" name="photo" id="coverImage" placeholder="Product Cover Image">
                                        <input type="hidden" name="current_photo" value="{{ $land->coverImage }}">
                                        @error('coverImage')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    

                                    {{-- <input type="file" class="form-control imgInp" name="photo" id="coverImage" placeholder="Product Cover Image">
                                        <input type="hidden" name="current_photo" value="{{ $product->photo }}">
                                        @error('coverImage')
                                            <li class="text-danger">{{ $message }}</li>
                                        @enderror --}}
                                    {{-- <div class="form-group">
                                        <label for="landImages">Land Images:</label>
                                        <input type="file" multiple class="form-control" name="landImages[]" id="landImages"
                                            placeholder="Land Cover Image">
                                        @error('landImages[]')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div> --}}
                                </div>

                                <div class="col-12 pt-5">
                                    <h4>Other land Photos</h4>
                                    <div class="row mt-3 justify-content-center">
                                        @php $photoCount = 0; @endphp
                                        @foreach($landPhotos as $photo)
                                            @php $photoCount ++; @endphp
                                            <div class="col-md-3 col-lg-2 col-sm-4 col-6">

                                                <img id="blah-{{ $photo->id }}" class="mt-2 mb-3" src="{{ asset('/storage/landForSaleLandImages/'.$photo->images) }}" alt="your image" width="200" height="100" /><br>
                                                <input type="file" class="form-control opic" name="landImages[{{ $photo->id }}]" id="blah-{{ $photo->id }}">
                                                <input type="hidden" name="current_image[{{ $photo->id }}]" value="{{ $photo->images }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 text-center mt-3">
                                <div class="form-check mb-2">
                                    <input id="termsAndConditions" class="form-check-input" type="checkbox"
                                        name="termsAndConditions" checked required>
                                    <label for="termsAndConditions" class="form-check-label"> By Clicking on 'Upload Land', You  are agreeing to <b>Farmaax Terms and Conditions</b> on Selling Lands.</label>
                                    @error('termsAndConditions')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4 offset-md-4 col-sm-6 offset-sm-3">
                                <button type="submit" class="btn-block btn primary-btn">Update</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            </div>
    </div>
@endsection
