@extends('layouts.admin')
@section('title', 'All Farmaax Popups')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class=" fa fa-window-restore  mr-1"></i>
            All Farmaax Popups

            <a class="float-right btn btn-primary" href="{{ route('pop-us.create') }}">Add Pop-up</a>

        </div>
        <div class="card-body">
            @if (count($popups) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($popups as $popup)
                                <tr>
                                    <td>{{ $popup->title }}</td>
                                    <td>{{ Str::limit($popup->message, 10, '...') }}</td>

                                    <td><a onclick="document.getElementById('togglePopup').submit()">
                                        <input type="checkbox"  name="status" class="js-switch" {{ $popup->status == 1 ? 'checked' : '' }}>
                                    </a>
                                    </td>
                                    <form action="{{ route('togglePopupStatus', $popup->id) }}" id="togglePopup">
                                    @csrf
                                    </form>

                                    <td>
                                       <a href="{{ route('pop-us.show', $popup->id) }}" class="m-1"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                                       <a href="{{ route('pop-us.edit', $popup->id) }}" class="m-1 text-success"><i class="fa fa-edit " aria-hidden="true"></i>Edit</a>
                                       <a href="{{ route('delete-popup', $popup->id) }}" onclick="return confirm('This Pop-up will be deleted, proceed to continue or cancel')" class="m-1 text-danger"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>

                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
            @else
                <div class="jumbotron-fluid">
                    <h3>No Pop-up Available </h3>
                </div>
            @endif
        </div>
    </div>
@endsection
