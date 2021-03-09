@extends('layout.app')

@section('dashboard-content')
<div class="d-block justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Assistants List</h1>

    <div class="btn-toolbar my-3">
        <a href="{{route('assistants.create')}}" type="button" class="btn btn-success btn-md mr-2"><i
                class="fa fa-plus pr-2" aria-hidden="true"></i>New Assistant</a>
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
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            {{-- {{$assistant = $item->profile()->manager()}} --}}
            <tr>
                <td>{{$loop->iteration}}</td>
                {{-- <td>{{$users->firstItem() + $loop->index}}</td> --}}
                <td>{{$item->id}}</td>
                <td>{{$item->profile->name}}</td>
                <td>{{$item->email}}</td>
                {{-- <td>{{App\Models\Manager::where('id',$item->profile->manager_id)->value('name')}}</td> --}}
                <td>
                    <a href="{{route('assistants.show', $item)}}" type="button"
                        class="btn btn-sm btn-outline-info">Detail</a>
                    <a href="{{route('assistants.edit', $item)}}" type="button"
                        class="btn btn-sm btn-outline-success">Edit</a>

                    <form class="d-inline" action="{{ route('assistants.destroy', $item) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete
                        </button>
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
