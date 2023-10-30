<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
}
