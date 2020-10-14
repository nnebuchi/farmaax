    @extends('layouts.admin')
    @section('title', 'Add farm category')
    @section('content')
    <style>
    input{
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
                            Add farm category
                        </div>
                        <div class="card-body">
                            <form action="{{ url('dashboard/admin/updatecategory/'.$thiscat->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="farm_category">Farm Category</label>
                                    <input type="text" name="categoryName" class="form-control" id="categoryName" value="{{ $thiscat->name }}">
                                    @error('categoryName')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>

                                
                                <div class="form-group">
                                    <label for="coverImage">Category Image:</label>
                                    <input type="file" class="form-control imgInp" name="categoryImage" id="categoryImage" placeholder="Category Image"  required >
                                    @error('categoryImage')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>

                                <img id="blah" class="mt-2 mb-3" src="{{ asset('storage/farmcategoryImages/'.$thiscat->image) }}" alt="your image" height="200" />
                                
                                <button type="submit" class=" btn-block btn btn-success">Submit</button>
                            </form>
                        </div>



                    </div>
                </div>

                <div class="col-md-8 offset-md-2 mt-3"> 

                    <h3>Existing Categories</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($categories as $category)
                        
                       
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td><img src="{{ asset('storage/farmcategoryImages/'.$category->image) }}" height="50" width="50" class="rounded-circle"></td>
                                <td><a href="{{ url('dashboard/admin/editcategory/'.$category->id) }}" class="btn btn-sm btn-success">Edit <i class="fa fa-edit"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                     
                </div>

            </div>
        </div>
    @endsection
