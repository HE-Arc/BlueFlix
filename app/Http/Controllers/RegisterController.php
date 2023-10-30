<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('users.register');
    }

    public function createUser(Request $request)
    {
        // Validate the request data (you can customize the validation rules as needed)
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        // Create new user
        $user = new User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));

        // C'est quoi name? IMPORTANT
        $user->name = $request->input('firstname');


        $user->save();

        // Redirect the user after registration (you can customize the redirect path)
        #return redirect()->route('login')->with('success', 'Account created successfully! You can now log in.');
        return redirect()->route('register')->with('success', 'Account created successfully! You can now log in.');
    }
}
