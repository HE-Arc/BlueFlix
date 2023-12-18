@extends('layout.app')

@section('content')
    <main>
        <h2 class="alignedTitle">Profil</h2>
        <div class="container">
            <div class="profilContainer p-4 mb-4" style="background-color: #f8f9fa;">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset("images/$user->urlImage") }}" alt="Image Placeholder" style="max-height: 15rem; max-width: 15rem;" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <p>Username: {{ $user->username }}</p>
                        <p>Email: {{ $user->email }}</p>
                        <p>Firstname: {{ $user->firstname }}</p>
                        <p>Lastname: {{ $user->lastname }}</p>
                        <p>Created at: {{ $user->created_at }}</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Display buttons for profile editing and list creation if the authenticated user is viewing their own profile -->
        @if(auth()->id() == $user->id)
            <!-- Button to edit the user's profile -->
            <a href="{{ route('profil.edit', ['id' => $user->id]) }}" class="btn btn-primary float-right mb-2"><i class="bi bi-pencil-fill"></i> Edit Profile</a>
            <!-- Button to create a new list -->
            <a href="{{ route('lists.create') }}" class="btn btn-primary float-right mb-2 mr-2"><i class="bi bi-plus-square-fill"></i> Create a new list</a>
        @endif

        @isset($results)
            <div class="card-container row">
                @foreach ($results as $result)
                    <!-- Display cards for the user's lists -->
                    @include("partials.listCard", ["cardInfo" => $result])
                @endforeach
            </div>
        @endisset

    </main>
@endsection
