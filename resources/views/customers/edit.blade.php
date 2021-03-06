@extends('layout.app')

@section('dashboard-content')
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a href="{{route('customers.index')}}" type="button" class="btn btn-warning btn-sm mr-4 text-light">
        <i class="fa fa-chevron-left fa-sm pr-2"></i>Back</a>
    <h1 class="h3">Customer / Edit / {{$data->name}}</h1>
</div>
<form method="POST" action="{{route('customers.update',$data)}}">
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

        <div class=" col-md-4">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{$data->phone}}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{$data->address}}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" value="{{$data->city}}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control">
                    <option value="{{$data->priority}}">{{$data->priority}}</option>
                    <option value="HIGH">HIGH</option>
                    <option value="MEDIUM">MEDIUM</option>
                </select>
            </div>
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

        <div class="col-md-4">
            <div class="form-group">
                <label for="assistant_id">Assistant</label>
                <select name="assistant_id" id="assistant_id" class="form-control selectpicker" data-live-search="true">

                    {{-- CUSTOMER RECENT ASSISTANT --}}
                    <option value="{{$data->assistant->id ?? ''}}">{{$data->assistant->name ?? ''}}</option>

                    {{-- GET ASSISTANTS LIST --}}
                    {{$assistants = App\Models\Assistant::all()->except($data->assistant->id ?? '')}}

                    @foreach ($assistants as $assistant)
                    <option value="{{$assistant->id}}">{{$assistant->name}}
                    </option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save <i class="fa fa-floppy-o pl-2" aria-hidden="true"></i></button>
</form>

@endsection
