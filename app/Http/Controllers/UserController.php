<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            $user = Auth::user();
        }

        return view('users.profil', compact('user'));
    }

    public function login()
    {
        return view('users.login');
    }

    public function register()
    {
        return view('users.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'You are logged out.');
    }

    public function parseLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('username', $request->input('username'))->first();

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            #return redirect()->route('login')->with('success', 'You are logged in.');
            return redirect()->route('profil')->with('success', 'You are logged in.');
        } else {
            return redirect()->route('login')->with('error', 'Username or password is incorrect.');
        }
    }

    public function createUser(Request $request)
    {
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


        $user->name = $request->input('firstname');


        $user->save();

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }
}
