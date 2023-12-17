@extends('layout.app')

@section('content')
    <main>
        <h2 class="alignedTitle">Profil</h2>
        <div class="container">
            <div class="profilContainer">
                <div></div>
                <p>Username: {{ $user->username }}</p>
                <p>Email: {{ $user->email }}</p>
                <p>Firstname: {{ $user->firstname }}</p>
                <p>Lastname: {{ $user->lastname }}</p>
                <p>Created at: {{ $user->created_at }}</p>
                <div></div>
            </div>
        </div>
        @if(auth()->id() == $user->id)
            <a href="{{route('lists.create')}}" class="btn btn-primary float-right mb-2"><i class="bi bi-plus-square-fill"></i> Create a new list</a>
        @endif


        @isset($results)
            <div class="card-container">
                @foreach ($results as $result)
                    @include("partials.card", ["cardInfo" => $result])
                    @if(auth()->id() == $user->id)
                        <a class="btn btn-primary" href="{{route('lists.edit', $result->id)}}"><i class="bi bi-pencil-fill"></i></a>

                        <form action="{{route('lists.destroy', $result->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>


                    @endif
                @endforeach
            </div>
        @endisset
    </main>
@endsection
