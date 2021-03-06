@extends('layout.app')

@section('dashboard-content')
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a href="{{route('admins.index')}}" type="button" class="btn btn-warning btn-sm mr-4 text-light">
        <i class="fa fa-chevron-left fa-sm pr-2"></i>Back</a>
    <h1 class="h3">Manager / Edit / {{$data->name}}</h1>
</div>
<form method="POST" action="{{route('admins.update',$data)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}">
            </div>
        </div>

        <div class="col-md-4">
            <fieldset disabled>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$data->user->email}}">
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password"
                    aria-describedby="passwordlHelp">
                <small id="passwordHelp" class="form-text text-muted">Leave this blank if you don't want to change your
                    password.</small>
                @error('password')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save <i class="fa fa-floppy-o pl-2" aria-hidden="true"></i></button>
</form>

@endsection
