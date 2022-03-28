    @extends('layouts.admin')
    @section('title', 'Add farm category')
    @section('content')
    <style>
    input, textarea, select{
        border: 2px solid #676501!important;
    }

    label{
        color: #4e9525 !important;
    }

    .card{
        border: 2px solid #676501 !important; border-radius: 12px;">
    }

    .card-header{
        border-radius: 12px; background-color: #4e9525 !important; border-bottom: 2px solid  #676501; color: white;
        font-weight: bold;
    }

    .card-header h4{
        color: white;
        font-weight: bold;
    }

    
</style>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <div class="card">
                        <div class="card-header text-center">
                            Add farm type
                        </div>
                        <div class="card-body">
                            <form action="{{ url('dashboard/admin/storefarmtype') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="farm_type">Category</label>
                                    <select name="parent" class="form-control" id="parent">
                                        <option disabled selected>select catgory</option>

                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="farm_type">Farm type</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    @error('name')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>


                                 <div class="form-group">
                                    <label for="description">Farm Description: </label>
                                    <textarea class="form-control" name="description" id="description" rows="6" required></textarea>
                                         @error('description')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">type Image:</label>
                                    <input type="file" class="form-control imgInp" name="image" id="image"
                                        placeholder="type Image" required>
                                    @error('image')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                                <img id="blah" class="mt-2 mb-3" src="{{ asset('images/thumbnail.jpg') }}" alt="your image" height="200" />
                                
                                <button type="submit" class=" btn-block btn btn-success">Submit</button>
                            </form>
                        </div>


                    </div>
                </div>

                <div class="col-md-8 offset-md-2 mt-3"> 

                    <h3>Existing Farm types</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($farmtypes as $type)
                        
                       
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td><img src="{{ asset('storage/farmcategoryImages/'.$type->image) }}" height="50" width="50" class="rounded-circle"></td>
                                <td><a href="{{ url('dashboard/admin/editfarmtype/'.$type->id) }}" class="btn btn-sm btn-success">Edit <i class="fa fa-edit"></i></a> <a href="{{ route('costAnalysis', $type->id) }}" class="btn btn-sm btn-warning">Add Farm Cost Analysis <i class="fa fa-edit"></i></a> <a class="btn btn-dark" href="{{ route('add-milestone', $type->id) }}">Add Milestone <i class="fa fa-edit"></i></a></td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                     
                </div>

            </div>
        </div>

         <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
         <script>
                CKEDITOR.replace( 'description' );
        </script>
    @endsection
