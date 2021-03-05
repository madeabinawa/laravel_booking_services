@extends('layout.app')

@section('dashboard-content')
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a href="{{route('assistants.index')}}" type="button" class="btn btn-warning btn-sm mr-4 text-light">
        <i class="fa fa-chevron-left fa-sm pr-2"></i>Back</a>
    <h1 class="h3">Assistant / Create</h1>
</div>
<form method="POST" action="{{route('assistants.store')}}">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp"
                    value="{{old('name')}}">
                @error('name')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                @error('email')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class=" col-md-4">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}">
                @error('phone')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{old('name')}}">
                @error('address')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" value="{{old('city')}}">
                @error('city')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="assistant_id">Manager</label>
                <input type="number" class="form-control" name="assistant_id" id="assistant_id"
                    value="{{old('assistant_id')}}">
                @error('assistant_id')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                @error('password')
                <small class="text-danger">{{$message}}</small>
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
    <button type="submit" class="btn btn-primary">Create</button>
</form>

@endsection
