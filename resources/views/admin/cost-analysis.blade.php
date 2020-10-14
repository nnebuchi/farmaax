@extends('layouts.admin')
@section('title', 'Add farm cost analysis')
@section('content')
    <div class=" mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-7 ">
                <div class="card ">
                    <div class="card-header text-center">
                    {{$name->name}}    Cost Analysis
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeCostAnalysis') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="clearing">Farm Clearing</label>
                                <input type="number" name="clearing" id="" class="form-control"
                                    placeholder="Land Clearing Cost" required>
                            </div>
                            <div class="form-group">
                                <label for="seeding">Farm Seeding</label>
                                <input type="number" name="seeding" id="" class="form-control"
                                    placeholder="Farm seeding Cost" required>
                            </div>
                            <div class="form-group">
                                <label for="transport">Transport</label>
                                <input type="number" name="transport" id="" class="form-control"
                                    placeholder="Transport Cost" required>
                            </div>
                        <input type="hidden" name="farm_type" value="{{$name->name}}">
                            <div class="form-group">
                                <label for="planting">Planting</label>
                                <input type="number" name="planting" id="" class="form-control" placeholder="planting Cost" required>
                            </div>
                            <div class="form-group">
                                <label for="weeding">Weeding Cost</label>
                                <input type="number" name="weeding" id="" class="form-control" placeholder="weeding Cost" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value=
                                "Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
