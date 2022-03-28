@extends('layouts.admin')
@section('meta-tag')
    <meta name="keywords" content="lands for sale, buy a land, agriculture, 'invest, plots of land'">
@endsection
@section('title', 'Farmaax Lands available for sales')
@section('content')
    @if (count($lands) > 0)
        <h2 class="text-center text-warning bg-white">Lands for Sale on Farmaax</h2>

        <div class="row">
            @foreach ($lands as $land)
                <div class="col-md-12 col-lg-4">
                    <a href="{{ route('lands.show', $land->id) }}">
                        <div class="card">
                            <div class="card-img-top">
                                <img src="{{ asset('/storage/landForSaleCoverImages/' . $land->coverImage) }}"
                                    alt="land image" width="100%" height="200px">
                            </div>
                            <div class="card-footer">
                                <h4 class=""> {{ $land->landTitle }} - &#8358;{{ number_format($land->price) }}</h4>
                                <br>
                                @if ($land->purchase_date === null)
                                    <button type="button" class="btn btn-success ">
                                        Buy This Land
                                    </button>
                                @else
                                    <h4 class=" text-danger">Sold Out</h4>
                                @endif
                                <a href="{{ route('edit-land', $land->id) }}" class="btn btn-primary">Edit</a>
                                
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{ $land->id }}">
                                  Delete 
                                </button>
                            </div>
                        </div>
                    </a>
                    <br>
                </div>


                <div class="modal" id="exampleModal-{{ $land->id }}" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete this land?. this action can't be reversed</p>
                      </div>
                      <div class="modal-footer">
                        <a href="{{ route('delete-land', $land->id) }}" class="btn btn-primary">Proceed to delete</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Do not delete</button>
                      </div>
                    </div>
                  </div>
                </div>

            @endforeach
        </div>
    @else
        <div class="jumbotron text-center">
            <h4>No Lands For Sale Available</h4>
        </div>
    @endif
    </div>
    </div>

@endsection
