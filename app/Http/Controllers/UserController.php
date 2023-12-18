<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Liste;
use Illuminate\Http\Request;

use App\Models\CardInfo;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);

        if($user == null) {
            return redirect()->route('home')->with('error', 'User not found !');
        }

        $lists = Liste::where('user_id', $id)->get();

        $results = [];
        //title, image, route("route('lists.show', $list->id)")
        foreach ($lists as $list) {
            $newelement = new CardInfo();
            $newelement->title = $list->nom;
            $newelement->image = asset("images/$list->urlImage");
            $newelement->id = $list->id;
            $newelement->deleteable = $list->deleteable;
            $newelement->route = route('lists.show', $list->id);
            array_push($results, $newelement);
        }

        return view('users.profil', compact('user'),['results' => $results]);
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
        return redirect()->back()->with('success', 'You are logged out.');
    }

    public function parseLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        #$user = User::where('username', $request->input('username'))->first();

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route('profil', ['id' => auth()->id()])->with('success', 'You are logged in.');
            #return redirect()->action([UserController::class, 'index'], ['id' => auth()->id()])->with('success', 'You are logged in.');

        } else {
            return redirect()->route('login')->withErrors(['loginError' => 'Username or password is incorrect.'])->withInput();
        }
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'urlImage' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // Create new user
        $user = new User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('firstname');

        if ($request->hasFile('urlImage')) {
            $imageName = time().'.userpic.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
            $user->urlImage = $imageName;
        }
        else {
            $user->urlImage = "default/profil.png";
        }

        $user->save();

        $this->createDefaultList($user);

        auth()->login($user);

        return redirect()->route('profil', ['id' => auth()->id()])->with('success', 'Account created successfully!');
    }

    private function createDefaultList(User $user)
    {
        $li = new Liste();

        $Favorite = [
            "nom" => "Favorite",
            "urlImage" => "default/fav.png",
            "user_id" => $user->id,
            "deleteable" => false,
        ];

        $Seen = [
            "nom" => "Seen",
            "urlImage" => "default/seen.png",
            "user_id" => $user->id,
            "deleteable" => false,
        ];

        $ToSee = [
            "nom" => "To see",
            "urlImage" => "default/tosee.png",
            "user_id" => $user->id,
            "deleteable" => false,
        ];

        Liste::create($Favorite);
        Liste::create($Seen);
        Liste::create($ToSee);
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (auth()->user()->id !== $user->id) {
            return redirect()->route('home')->with('error', 'You don\'t have access to this ressource !');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (auth()->user()->id !== $user->id) {
            return redirect()->route('home')->with('error', 'You don\'t have access to this ressource !');
        }

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'urlImage' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('urlImage')) {
            unlink(public_path('images/'.$user->urlImage));
            $imageName = time().'.userpic.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
            $user->update(['urlImage' => $imageName]);
        }

        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->input('password'))]);
        }

        return redirect()->route('profil', ['id' => $user->id])->with('success', 'Profile updated successfully!');
    }
}
