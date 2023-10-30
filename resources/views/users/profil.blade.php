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
</main>
@endsection
