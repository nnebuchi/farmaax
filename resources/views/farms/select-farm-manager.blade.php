@extends('layouts.user')


<style>
    .farm-cover-img {
        height: 200px;
    }

    .blog-entry {
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.296);
    }

</style>
@section('content')
    <section class="ftco-sectio bg-light py-5">

        <div class="row justify-content-center">
            <div class="col-md-6  item">
                <h2 class="text-center">Select your Farm Manager</h2>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light" style="background-color: #262401!important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-lg-3  col-sm-6 d-flex ftco-animate">
                    <div class="blog-entry justify-content-end">
                        <a class="block-20 farm-cover-img" style="background-image: url({{ asset('images/farmer.png') }});">
                        </a>
                        <div class="text p-4 float-right d-block item">

                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-center"><b>{{ $manager->firstName . ' ' . $manager->lastName }}</b></h4>
                                    <p> &#9734; &#9734; &#9734; &#9734; &#9734;</p>
                                    <hr>
                                </div>
                                <div class="col-6">

                                    <p><a id="farm-{{ $manager->id }}-invest" class="btn primary-btn btn-sm"
                                            onclick="document.getElementById('confirm').submit()">Select</a></p>
                                </div>

                                <div class="col-6">
                                    <p><button type="button" id="farm-{{ $manager->id }}" class="btn secondary-btn btn-sm"
                                            data-toggle="modal" data-target="#modelId">Details</button></p>
                                </div>
                            </div>
                            <form action="{{ route('showFarmCost') }}" method="POST" id="confirm">
                                @csrf
                                <input type="hidden" name="selectedFarmManager" value="{{ $manager->id }}">
                                <input type="hidden" name="farmDetails" value="{{ print_r($data) }}">

                            </form>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Farmaax Farmer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        {{ $manager->firstName . ' ' . $manager->lastName }} is one of <b>Farmaax </b>best Farmers. He is
                        the
                        perfect farmer for your farm setup and is dedicated to making sure you have a great farm that you
                        will be
                        proud of.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });

    </script>


@endsection
