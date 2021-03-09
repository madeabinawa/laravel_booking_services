@extends('layout.app')

@section('title','Appointment Create')

@section('dashboard-content')
<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a href="{{route('appointments.index')}}" type="button" class="btn btn-warning btn-sm mr-4 text-light">
        <i class="fa fa-chevron-left fa-sm pr-2"></i>Back</a>
    <h1 class="h3">Appointment / Create</h1>
</div>
<form method="POST" action="{{route('appointments.store')}}">
    @csrf
    <div class="row">
        <div class="col-md-6 ">
            <div class="form-group">
                <label for="title">Title</label>
                <input autocomplete="off" type="text" class="form-control" name="title" id="title"
                    aria-describedby="emailHelp" value="{{old('title')}}">
                @error('title')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class=" col-md-3">
            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <div id="datepicker-group" class="input-group date" data-date-format="mm-dd-yyyy">
                    <input autocomplete="off" class="form-control" name="appointment_date" id="appointment_date"
                        type="text" placeholder="Select Appointment Date" />
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    @error('appointment_date')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="description">Descriptions</label>
                <textarea class="form-control" name="description" id="description" value="{{old('description')}}"
                    rows="3"></textarea>

                @error('description')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 ">
            <div class="form-group">
                <label for="status">Appointment Status</label>
                <select name="status" id="status" class="form-control">

                    @if (old('status'))
                    <option value="{{old('status')}}">{{old('status')}}</option>
                    @else
                    <option value="UPCOMING">Upcoming</option>
                    <option value="FINISHED">Finished</option>
                    <option value="CANCELLED">Cancelled</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="assistant_id">Assistants</label>
                <select name="assistant_id" id="assistant_id" class="form-control selectpicker" data-live-search="true">

                    @if (old('assistant_id'))
                    <option value="{{old('assistant_id')}}">
                        {{App\Models\Assistant::where('id', old('assistant_id'))->value('name')}}</option>
                    @else
                    <option>Select Assistant</option>
                    @endif

                    {{-- GET ASSISTANTS LIST --}}
                    {{$assistants = App\Models\Assistant::all()}}

                    @foreach ($assistants as $assistant)
                    <option value="{{$assistant->id}}">{{$assistant->name}}
                    </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="customer_id">Customers</label>
                <select name="customer_id" id="customer_id" class="form-control selectpicker" data-live-search="true">

                    @if (old('customer_id'))
                    <option value="{{old('customer_id')}}">
                        {{App\Models\Customer::where('id', old('customer_id'))->value('name')}}</option>
                    @else
                    <option>Select Customer</option>
                    @endif

                    {{-- GET ASSISTANTS LIST --}}
                    {{$customers = App\Models\Customer::all()}}

                    @foreach ($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->name}}
                    </option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
<div>
    @if ($errors->any())
    <div class="text-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection
