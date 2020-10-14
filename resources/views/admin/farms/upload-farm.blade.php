@extends('layouts.admin')
@section('meta-tags')
    <meta name="description" content="Upload a your lands on farmaax">
    <meta name="keywords" content="Farms, Farms for farming, Farming, manage a farm">
@endsection
@section('content')
@section('title', 'Sell a land on Farmaax')
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-md-12 col-lg-8 ">
            <div class="card">
                <div class="card-header text-center">
                    Sell A Land on Farmaax
                </div>
                <div class="card-body">
                    <form action="{{ route('lands.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="landTitle">Land Title:</label>
                            <input value="{{ old('landTitle') }}" id="landTitle"
                                class="form-control @error('landTitle') is-invalid @enderror" type="text" name="landTitle"
                                required>
                            @error('landTitle')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price of Land:</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                class="form-control @error('price') is-invalid @enderror" required>
                            @error('price')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input value="{{ old('state') }}" id="state"
                                class="form-control @error('state') is-invalid @enderror" type="text" name="state" required>
                            @error('state')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lga">L.G.A:</label>
                            <input id="lga" value="{{ old('lga') }}" class="form-control @error('lga') is-invalid @enderror"
                                type="text" name="lga" required>
                            @error('lga')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="town">Town:</label>
                            <input id="town" value="{{ old('town') }}"
                                class="form-control @error('town') is-invalid @enderror" type="text" name="town" required>
                            @error('town')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input id="address" value="{{ old('address') }}"
                                class="form-control @error('address') is-invalid @enderror" type="text" name="address"
                                required>
                            @error('address')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coverImage">Land Cover Image:</label>
                            <input type="file" class="form-control" name="coverImage" id="coverImage"
                                placeholder="Land Cover Image" required>
                            @error('coverImage')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="landImages">Land Images:</label>
                            <input type="file" multiple class="form-control" name="landImages[]" id="landImages"
                                placeholder="Land Cover Image" required>
                            @error('landImages[]')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-check mb-2">
                            <input id="termsAndConditions" class="form-check-input" type="checkbox"
                                name="termsAndConditions" checked required>
                            <label for="termsAndConditions" class="form-check-label"> By Clicking on 'Sell this
                                Land', You
                                are agreeing to <b>Farmaax Terms and Conditions</b> on Selling Lands.</label>
                            @error('termsAndConditions')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <button type="submit" class=" btn-block btn btn-primary">Sell this Land</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
