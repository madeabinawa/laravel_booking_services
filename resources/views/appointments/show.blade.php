@extends('layout.app')

@section('dashboard-content')
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a href="{{route('assistants.index')}}" type="button" class="btn btn-warning btn-sm mr-4 text-light">
        <i class="fa fa-chevron-left fa-sm pr-2"></i>Back</a>
    <h1 class="h3">Assistant / Detail </h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3 mx-auto mt-5" style="max-width: 75%">
                <div class="d-flex justify-content-between card-header h2">{{$AppointmentDetail->name}}
                    <div class="div">
                        <a href="{{route('assistants.edit',$AppointmentDetail)}}" type="button"
                            class="btn btn-primary ml-3 mb-3">Edit
                            <i class="fa fa-pencil-square-o pl-2" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="card-body">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fa fa-map-marker fa-lg pr-2"
                                        aria-hidden="true"></i>
                                    {{$AppointmentDetail->address}}, {{$AppointmentDetail->city}}</li>
                                <li class="list-group-item"><i class="fa fa-mobile fa-lg pr-2" aria-hidden="true"></i>
                                    {{$AppointmentDetail->phone}}</li>
                                <li class="list-group-item"><i class="fa fa-user fa-lg pr-2" aria-hidden="true"></i>
                                    {{$AppointmentDetail->manager->name ?? 'Doesn\'t have manager yet'}}</li>
                            </ul>
                            {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="container">
                            <img src="https://images.unsplash.com/photo-1585221140117-5bc4baee9cd1?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=750&q=80"
                                class="img-fluid rounded mx-auto mt-3" alt="...">
                        </div>

                    </div>

                </div>
                <div class="card-footer text-muted">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
