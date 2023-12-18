@extends('layout.app')

@section('content')
<main>
    <h2 class="alignedTitle">Login</h2>
    <div class="container">
        <form action="{{ url('/login') }}" method="post" class="row">
            @csrf
            <div class="col-12 col-lg-6 offset-0 offset-lg-3">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="username">Username or email</label>
                                <input type="text" name="username" id="username" placeholder="Username or email" class="form-control" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                            </div>

                            <!-- Display error messages if there are any validation errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3 col-12">
                                    <strong>Error!</strong> Please check your inputs.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" name="login" class="btn btn-primary mt-3">Login</button>

                            <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
