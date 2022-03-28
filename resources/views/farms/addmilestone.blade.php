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
                            Add Milestone for {{ $farm->name }} 
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store-milestone', $farm->id) }}" method="post">
                                @csrf


                                {{-- <div class="input-group mb-3 mile-node">
                                    
                                    <input type="text" name="milestones[]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" aria-describedby="basic-addon2">
                                    <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                    </div>
                                    
                                </div> --}}

                                <div class="controls1">
                                    <div class="entry1 input-group col-xs-3 mb-3">
                                       <input type="text" name="milestones[]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" aria-describedby="basic-addon2">
                                      <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more btn-add" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                      </div>
                                    </div>
                                  </div>
                                
                                <button type="submit" class=" btn-block btn btn-success">Submit</button>
                            </form>
                        </div>


                    </div>
                </div>

                <div class="col-md-8 offset-md-2 mt-3"> 

                    <h3>Existing Milestones</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Milestone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count =1; @endphp
                            @foreach($milestones as $milestone)
                                
                            
                            <tr>
                                <td>Milestone {{ $count }}</td>
                                <td>{{ $milestone->title }}</td>
                                
                                <td><a class="btn btn-sm btn-success" href="{{ route('edit-milestone', $milestone->id) }}">Edit <i class="fa fa-edit"></i></a> <a href="{{ route('delete-milestone', $milestone->id) }}" class="btn btn-sm btn-danger">delete <i class="fa fa-times"></i></a>  </td>
                             
                            </tr>

                            @php $count ++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                     
                </div>

            </div>
        </div>

        <script>


            /*$('.add-more').on('click', function(){
                // var node = $(this).parents('.mile-node');
                $(this).parents('.mile-node').after(`<div class="input-group mb-3 mile-node">
                                    
                                    <input type="text" name="milestones[]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" aria-describedby="basic-addon2">
                                    <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                    </div>
                                    
                                </div>`)
                
            })*/
            /*function addInput(){
                
            }*/
            

            $(document).on('click', '.btn-add', function(e)
            {
                e.preventDefault();

                var controlForm = $('.controls1:first'),
                    currentEntry = $(this).parents('.entry1:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');
                controlForm.find('.entry1:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-dark').addClass('btn-danger')
                    .html('<span class=" glyphicon glyphicon-minus"> x </span>');
            }).on('click', '.btn-remove', function(e)
            {
              $(this).parents('.entry1:first').remove();

                e.preventDefault();
                return false;
            });

        </script>
    @endsection
