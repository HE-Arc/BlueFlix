@extends('layout.app')

@section('content')

<form action="{{ route('profil.update', ['id' => $user->id]) }}" method="POST">
    @csrf
    @method('PUT') {{-- Utilisation de la méthode PUT pour la mise à jour --}}

    <h2 class="alignedTitle">Edit Profile</h2>

    <div class="row">
        <div class="col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    Edit Profile
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" id="username" placeholder="Username">
                        </div>

                        <div class="form-group col-12">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email" placeholder="Email">
                        </div>

                        <div class="form-group col-12">
                            <label for="password">New Password (Leave blank to keep current password)</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                        </div>

                        <div class="form-group col-12">
                            <label for="password_confirmation">Confirm new password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm new password">
                        </div>

                        <div class="form-group col-12">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" class="form-control" id="firstname" placeholder="First Name">
                        </div>

                        <div class="form-group col-12">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" class="form-control" id="lastname" placeholder="Last Name">
                        </div>

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

                        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection