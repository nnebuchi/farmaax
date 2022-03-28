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
                            Edit Milestone 
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update-milestone', $milestone->id) }}" method="post">
                                @csrf


                                <div class="form-group">
                                    <label for="farm_type">Milestone Title</label>
                                    <input type="text" name="milestone" class="form-control" id="milestone" required value="{{ $milestone->title }}">
                                    @error('milestone')
                                    <li class="text-danger">{{ $message }}</li>
                                    @enderror
                                </div>
                                
                                <button type="submit" class=" btn-block btn btn-success">Submit</button>
                            </form>
                        </div>


                    </div>
                </div>

                

            </div>
        </div>
    @endsection
