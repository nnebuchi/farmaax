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
                           Cost Analysis for {{ $farmtype->name }}
                        </div>

                        @if(count($farm)==0)
                        <div class="card-body">
                            <form action="{{ route('storeCostAnalysis', $id) }}" method="post">
                                @csrf


                                {{-- <div class="input-group mb-3 mile-node">
                                    
                                    <input type="text" name="milestones[]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" aria-describedby="basic-addon2">
                                    <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                    </div>
                                    
                                </div> --}}

                                <div class="controls1">
                                    <div class="form-group">
                                        <label><strong>Farmer's Cost</strong></label>
                                        <input type="number" name="farmer_cost" class="form-control" placeholder="eg. 100000" required>
                                    </div>
                                    <div class="entry1 input-group col-xs-3 mb-3">

                                       <input type="text" name="parameters[]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" >
                                       <input type="number" name="amount[]" required aria-describedby="basic-addon2" placeholder="amount">
                                      <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more btn-add" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                      </div>
                                      
                                    </div>
                                  </div>
                                
                                <button type="submit" class=" btn-block btn btn-success">Submit</button>
                            </form>
                        </div>
                        @else
                         <div class="card-body">

                            <form  action="{{ route('updateCostAnalysis', $id) }}" method="post">
                                @csrf


                                {{-- <div class="input-group mb-3 mile-node">
                                    
                                    <input type="text" name="milestones[]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" aria-describedby="basic-addon2">
                                    <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                    </div>
                                    
                                </div> --}}

                                <div class="controls1">
                                    <div class="form-group">
                                        <label><strong>Farmer's Cost</strong></label>
                                        <input type="number" name="farmer_cost" class="form-control" placeholder="eg. 100000" required @if(!is_null($farmer_cost)) value="{{ $farmer_cost->amount }}" @endif>
                                    </div>
                                    @foreach($farm as $anal)
                                        <div class="entry1 input-group col-xs-3 mb-3">

                                       <input type="text" name="parameters[{{ $anal->anal_id }}]" class="form-control" id="milestone" required placeholder="e.g Bush clearing" value="{{ $anal->parameter }}">
                                       <input type="number" name="amounts[{{ $anal->anal_id }}]" aria-describedby="basic-addon2" placeholder="amount" value="{{ $anal->amount }}" required>
                                      <div class="input-group-append" style="cursor: pointer;">
                                        <span class="input-group-text add-more btn-plus" id="basic-addon2"><i class="fa fa-plus-circle"></i></span>
                                      </div>
                                      
                                    </div>
                                    @endforeach
                                  </div>
                                
                                <button type="submit" class=" btn-block btn btn-success">Submit</button>
                            </form>
                        </div>
                            
                        @endif


                    </div>
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
            

            $(document).on('click', '.btn-plus', function(e)
            {
                e.preventDefault();

                var controlForm = $('.controls1:first'),
                    currentEntry = $(this).parents('.entry1:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');
                 newEntry.find('input[type=text]').attr('name','new_params[]');
                 newEntry.find('input[type=number]').attr('name','new_amounts[]');
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
