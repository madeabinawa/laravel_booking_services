@extends('layout.app')
@section('title', 'Appointmets List')

@section('dashboard-content')
<div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4 font-weight-light text-danger">Under Development</h4>
    <h1 class="h2">Appointments List</h1>

    <div class="btn-toolbar my-3">
        <a href="{{route('appointments.create')}}" type="button" class="btn btn-success btn-md mr-2"><i
                class="fa fa-plus pr-2" aria-hidden="true"></i>New Appointment</a>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Customer</th>
                <th>Assistant</th>
                <th>Appt. Date</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $item)
            <tr>
                {{-- <td>{{$loop->iteration}}</td> --}}
                <td>{{$appointments->firstItem() + $loop->index}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                {{-- <td>{{ App\Models\Customer::find($item->customer_id)->name}}</td> --}}
                {{-- <td>{{ App\Models\Assistant::find($item->assistant_id)->name}}</td> --}}
                <td>{{ $item->customer->name}}</td>
                <td>{{ $item->assistant->name}}</td>
                <td>{{$item->appointment_date}}</td>
                <td>{{$item->status}}</td>
                <td>
                    <a href="{{route('appointments.show', $item->id)}}" type="button"
                        class="btn  btn-sm btn-outline-info">Detail</a>
                    <a href="{{route('appointments.edit', $item->id)}}" type="button"
                        class="btn btn-sm btn-outline-success">Edit</a>

                    <form class="d-inline" action="{{ route('appointments.destroy', $item->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class=" btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $appointments->links() }}
</div>
@endsection
