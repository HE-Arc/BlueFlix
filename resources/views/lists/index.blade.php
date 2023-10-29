@extends("layout.app")

@section("content")

<h1>Lists</h1>

<a href="{{route('lists.create')}}" class="btn btn-primary float-right mb-2"><i class="bi bi-plus-square-fill"></i> Create a new list</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col"></th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lists as $list)
        <tr>
            <td>{{$list->nom}}</td>
            <td></td>
            <td>
                <a class="btn btn-info" href="{{route('lists.show', $list->id)}}"><i class="bi bi-eye-fill"></i></a>
                <a class="btn btn-primary" href="{{route('lists.edit', $list->id)}}"><i class="bi bi-pencil-fill"></i></a>
                <form action="{{route('lists.destroy', $list->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
