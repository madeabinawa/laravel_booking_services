@extends('layout.app')

@section('dashboard-content')

<div class="container pt-3">
    <h4 class="h4 font-weight-light text-danger">Under Development</h4>
    <h1 class="display-4"> {{ (Auth::user()->profile_type == "App\Models\Assistant") ? 'Assistant' : 'Admin'}}
        Dashboard </h1>

    <h3 class="h3 font-weight-light mt-3">Hello,{{Auth::user()->profile->name}}</h3>
    <div class="row row-cols-1 row-cols-md-3 pt-3">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-weight-light">Dashboard Card</h5>
                    <h1 class="h1 text-center pt-2">10</h1>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title font-weight-light">Dashboard Card 2</h5>
                    <h1 class="h1 text-center pt-2">300</h1>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title font-weight-light">Dashboard Card 3</h5>
                    <h1 class="h1 text-center pt-2">0</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
