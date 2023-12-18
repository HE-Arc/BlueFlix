<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Liste;
use Illuminate\Http\Request;

use App\Models\CardInfo;
use App\Models\ListClass;

class UserController extends Controller
{
    /**
     * Display the user profile and associated lists.
     *
     * @param int $id User ID
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        // Find user by ID
        $user = User::findOrFail($id);

         // Redirect to home if user not found
        if($user == null) {
            return redirect()->route('home')->with('error', 'User not found !');
        }

        // Get user's lists
        $lists = ListClass::where('user_id', $id)->get();

        // Transform lists into CardInfo objects for display
        $results = [];
        foreach ($lists as $list) {
            $newelement = new CardInfo();
            $newelement->title = $list->name;
            $newelement->image = asset("images/$list->image_url");
            $newelement->id = $list->id;
            $newelement->deleteable = $list->deleteable;
            $newelement->route = route('lists.show', $list->id);
            array_push($results, $newelement);
        }

        // Render user profile view with associated lists
        return view('users.profil', compact('user'),['results' => $results]);
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('users.login');
    }


    /**
     * Display the register form.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('users.register');
    }

    /**
     * Logout the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->back()->with('success', 'You are logged out.');
    }

    /**
     * Validate and process user login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function parseLogin(Request $request)
    {
        // Validate user input
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            // Redirect to user profile if login successful
            return redirect()->route('profil', ['id' => auth()->id()])->with('success', 'You are logged in.');

        } else {
            // Redirect to login page with error message if login failed
            return redirect()->route('login')->withErrors(['loginError' => 'Username or password is incorrect.'])->withInput();
        }
    }

    /**
     * Validate and process user registration.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        // Validate user input
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
        $user->name = $request->input('lastname');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));

        if ($request->hasFile('urlImage')) {
            $imageName = time().'.userpic.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
            $user->image_url = $imageName;
        }
        else {
            $user->image_url = "default/profil.png";
        }

        $user->save();

        $this->createDefaultList($user);

        // Log the user in
        auth()->login($user);

        // Redirect to user profile
        return redirect()->route('profil', ['id' => auth()->id()])->with('success', 'Account created successfully!');
    }

    /**
     * Create default lists for a new user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    private function createDefaultList(User $user)
    {
        $li = new ListClass();

        $Favorite = [
            "name" => "Favorite",
            "image_url" => "default/fav.png",
            "user_id" => $user->id,
            "deleteable" => false,
        ];

        $Seen = [
            "name" => "Seen",
            "image_url" => "default/seen.png",
            "user_id" => $user->id,
            "deleteable" => false,
        ];

        $ToSee = [
            "name" => "To see",
            "image_url" => "default/tosee.png",
            "user_id" => $user->id,
            "deleteable" => false,
        ];

        ListClass::create($Favorite);
        ListClass::create($Seen);
        ListClass::create($ToSee);
    }

    /**
     * Display the edit form.
     *
     * @param int $id User ID
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find user by ID
        $user = User::findOrFail($id);

        // Redirect to home if user not found
        if (auth()->user()->id !== $user->id) {
            return redirect()->route('home')->with('error', 'You don\'t have access to this ressource !');
        }

        // Render user edit view
        return view('users.edit', compact('user'));
    }

    /**
     * Validate and process user update.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id User ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find user by ID
        $user = User::findOrFail($id);

        // Redirect to home if user not found
        if (auth()->user()->id !== $user->id) {
            return redirect()->route('home')->with('error', 'You don\'t have access to this ressource !');
        }

        // Validate user input
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'urlImage' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('urlImage')) {
            unlink(public_path('images/'.$user->image_url));
            $imageName = time().'.userpic.'.$request->urlImage->extension();
            $request->urlImage->move(public_path('images'), $imageName);
            $user->update(['image_url' => $imageName]);
        }

        $user->update([
            'firstname' => $request->input('firstname'),
            'name' => $request->input('lastname'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->input('password'))]);
        }

        return redirect()->route('profil', ['id' => $user->id])->with('success', 'Profile updated successfully!');
    }
}
