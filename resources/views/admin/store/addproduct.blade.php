@extends('layouts.admin')
@section('meta-tags')
    <meta name="description" content="Upload a your lands on farmaax">
    <meta name="keywords" content="Farms, Farms for farming, Farming, manage a farm">
@endsection
@section('content')
@section('title', 'Add Store Product')
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-md-12 col-lg-8 ">
            <div class="card">
                <div class="card-header text-center">
                   Add Store product
                </div>
                <div class="card-body">
                    <form action="{{ route('store-product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="landTitle">Product Title:</label>
                            <input value="{{ old('productTitle') }}" id="productTitle" class="form-control @error('productTitle') is-invalid @enderror" type="text" name="title"
                                required>
                            @error('productTitle')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" required>
                            @error('price')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror" required>
                            @error('quantity')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select id="category" value="{{ old('category') }}" class="form-control @error('category') is-invalid @enderror"
                                type="text" name="category" required>
                                <option selected disabled></option>
                                @foreach($product_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="weight">weight:</label>
                            <input id="weight" value="{{ old('weight') }}" class="form-control @error('weight') is-invalid @enderror" type="text" name="weight">
                            @error('weight')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="coverImage">Product Cover Photo (only 1 photo):</label>
                            <input type="file" class="form-control imgInp" name="photo" id="coverImage"
                                placeholder="Product Cover Image" required>
                            @error('coverImage')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <img id="blah" class="mt-2 mb-3" src="{{ asset('images/thumbnail.jpg') }}" alt="your image" height="200" />
                        <div class="form-group">
                            <label for="landImages">Other Product Photo (multiplke photo can be added):</label>
                            <input type="file" multiple class="form-control" name="productImages[]" id="productImages"
                                placeholder="product Cover Image">
                            @error('productImages[]')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        
                        <button type="submit" class=" btn-block btn btn-primary">Upload Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
