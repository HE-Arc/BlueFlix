@extends("layout.app")

@section("content")

<h1>Lists</h1>

<a href="{{route('lists.create')}}" class="btn btn-primary float-right mb-2"><i class="bi bi-plus-square-fill"></i> Create a new list</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col" class="col-lg-10">Title</th>
            <th scope="col"></th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($lists->isEmpty())
            <tr>
                <td colspan="3">No lists found</td>
            </tr>
        @else
            @foreach ($lists as $list)
            <tr>
                <td>{{$list->nom}}</td>
                <td></td>
                <td>
                    <a class="btn btn-info" href="{{route('lists.show', $list->id)}}"><i class="bi bi-eye-fill"></i></a>
                    <a class="btn btn-primary" href="{{route('lists.edit', $list->id)}}"><i class="bi bi-pencil-fill"></i></a>
                    <form action="{{route('lists.destroy', $list->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

@endsection
