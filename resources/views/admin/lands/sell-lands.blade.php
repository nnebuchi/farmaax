@extends('layouts.'.$layout)
@section('meta-tags')
    <meta name="description" content="Sell your lands on farmaax">
    <meta name="keywords" content="Lands, lands for sale, sell lands, purchase a land">
@endsection
@section('title', 'Sell a land on Farmaax')
@section('content')
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-md-12 col-lg-8 ">
            <div class="card">
                @if ($errors->any())
                    @foreach ($errors as $item)
                        {{ $item }}
                    @endforeach
                @endif
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
                        @php
                        $states = \App\State::all();
                        @endphp
                        <div class="form-group">
                            <label for="state">State:</label>

                            <select class="form-control" name="state">
                                <option>State of location</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
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

                        <button type="submit" class=" btn-block btn btn-primary">Sell this Land</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
