@extends('layouts.admin')
@section('content')
@section('title', 'Create a Popup')

    <div class="containe mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-5">
                    <div class="card-header text-center">
                       Create a pop-up
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pop-us.store') }}" method="post">
                            @csrf


                                    <div class="form-group">
                                        <label for="title">Pop-up Title:</label>
                                        <input value="{{ old('title') }}" id="title"
                                            class="form-control @error('title') is-invalid @enderror" type="text"
                                            name="title" required>
                                        @error('title')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Pop-up message:</label>
                                        <textarea name="message" id="message" cols="30" rows="10"class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>

                                        @error('message')
                                        <li class="text-danger">{{ $message }}</li>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn-block btn-primary">Save Pop-up</button>
                                    </div>


                        </form>
                    </div>
                </div>
            </div>
            </div>
    </div>
@endsection
