@extends('layout.app')
@section('content')
<main>
    <h2 class="alignedTitle">Login</h2>
    <div class="container">
        <div class="loginContainer">
            <div></div>
            <form action="{{ url('/login') }}" method="post">
                @csrf
                <div>
                    <label for="username">Username or email</label>
                    <input type="text" name="username" id="username" placeholder="Username or email" required>
                </div>
                <br>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <br>
                <input type="submit" name="login" value="Login">
            </form>
            <div></div>
        </div>
    </div>
</main>
@endsection
