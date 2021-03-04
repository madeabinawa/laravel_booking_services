@extends('layout.app')

@section('dashboard-content')
<div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Customers List</h1>

    <div class="btn-toolbar my-3">
        <a href="{{route('customers.create')}}" type="button" class="btn btn-success btn-md mr-2"><i
                class="fa fa-plus pr-2" aria-hidden="true"></i>New Customer</a>
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
                <th>UID</th>
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
                {{-- <td>{{$loop->iteration}}</td> --}}
                <td>{{$users->firstItem() + $loop->index}}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->profile->priority}}</td>
                <td>{{$item->profile->assistant_id}}</td>
                <td>
                    <a href="{{route('customers.show', $item->profile)}}" type="button"
                        class="btn btn-sm btn-outline-info">Detail</a>
                    <a href="{{route('customers.edit', $item->profile)}}" type="button"
                        class="btn btn-sm btn-outline-success">Edit</a>

                    <form class="d-inline" action="{{ route('customers.destroy', $item->profile->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete
                        </button>

                        {{-- <form id="delete_customer" action="{{route('customers.destroy', $item->profile)}}"
                        method="post">
                        @csrf
                        @method('DELETE')
                    </form> --}}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $users->links() }}
</div>


@endsection
