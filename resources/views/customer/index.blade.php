@extends('layout.app')

@section('dashboard-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    {{-- <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div> --}}
</div>



<h2>Customers List</h2>
<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Priority</th>
                <th>Assistant</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->profile->priority}}</td>
                <td>{{$item->profile->assistant_id}}</td>
                <td>
                    <a href="{{route('customer.show', $item->profile)}}" type="button"
                        class="btn btn-sm btn-outline-info">Detail</a>
                    <button type="button" class="btn btn-sm btn-outline-success">Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
