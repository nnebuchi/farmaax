@extends('layouts.admin')
@section('title', 'Pop-up Details')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header"><h6>You are viewing <b>{{ $popup->title }}</b> Popup</h6></div>
                <div class="card-body">
                    <h5>Title: {{ $popup->title }}</h5>
                  <p>
                    {{ $popup->message }}
                  </p>
                </div>
               <div class="card-footer">
                    <a href="{{ route('pop-us.index') }}" class="btn btn-primary">Show all Popups</a>

            </div>
            </div>
        </div>

    </div>
    </div>
    </div>



    @endsection
