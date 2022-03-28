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
                    <form action="{{ route('update-product', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="landTitle">Product Title:</label>
                            <input value="{{ $product->title }}" id="productTitle" class="form-control @error('productTitle') is-invalid @enderror" type="text" name="title"
                                required>
                            @error('productTitle')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" required>
                            @error('price')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" required>{{ $product->description }}</textarea>
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
                                    <option @php echo $product->category==$category->id ? 'selected' : '' @endphp value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="weight">weight:</label>
                            <input id="weight" value="{{ $product->weight }}" class="form-control @error('weight') is-invalid @enderror" type="text" name="weight">
                            @error('weight')
                            <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="coverImage">Product Cover Photo (only 1 photo):</label>
                            <input type="file" class="form-control imgInp" name="photo" id="coverImage" placeholder="Product Cover Image">
                            <input type="hidden" name="current_photo" value="{{ $product->photo }}">
                            @error('coverImage')
                                <li class="text-danger">{{ $message }}</li>
                            @enderror
                        </div>
                        <img id="blah" class="mt-2 mb-3" src="{{ asset('storage/storeProductCoverPhotos/'.$product->photo) }}" alt="your image" height="200" />
                        

                        <div class="row">
                            @php $photoCount = 0; @endphp
                            @foreach($product_photos as $photo)
                                @php $photoCount ++; @endphp
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6">

                                    <img id="blah-{{ $photo->id }}" class="mt-2 mb-3" src="{{ asset('storage/storeProductImages/'.$photo->product_image) }}" alt="your image" width="100" height="100" /><br>
                                    <input type="file" class="form-control opic" name="productImages[{{ $photo->id }}]" id="blah-{{ $photo->id }}" placeholder="Product Cover Image">
                                    <input type="hidden" name="current_image[{{ $photo->id }}]" value="{{ $photo->product_image }}">
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
