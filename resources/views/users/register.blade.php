@extends('layout.app')
@section('content')
<main>
    <h2 class="alignedTitle">Register</h2>
    <div class="container">
        <div class="registerContainer">
            <div></div>
            <form action="register" method="post">
                @csrf
                <div>
                    <label for="username">Username</label>
                </div>
                <div>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>
                <br>
                <div>
                    <label for="email">Email</label>
                </div>
                <div>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <br>
                <div>
                    <label for="password">Password</label>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <br>
                <div>
                    <label for="firstname">First name</label>
                </div>
                <div>
                    <input type="text" name="firstname" id="firstname" placeholder="Firstname" required>
                </div>
                <br>
                <div>
                    <label for="lastname">Last name</label>
                </div>
                <div>
                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
                </div>
                <br>
                <input type="submit" name="create" value="Create">
            </form>
            <div></div>
        </div>
    </div>
</main>
@endsection
