<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_keyword = "";
        $search_role = null;
        $search_programme = null;

        if ($request->get('keyword') != null)
            $search_keyword = $request->keyword;
        if ($request->has('role'))
            $search_role = $request->role;
        if ($request->has('programme'))
            $search_programme = $request->programme;

        if ($request->get('keyword') != null && $request->has('role') && $request->has('programme')) {
            $users = User::sortable()
                ->where('role', '=', $search_role)
                ->where('programme', '=', $search_programme)
                ->where(function ($query) use ($search_keyword) {
                    $query->where('user_id', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('name', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('email', 'LIKE', "%{$search_keyword}%");
                })
                ->get();
        } else if ($request->get('keyword') != null && $request->has('role')) {
            $users = User::sortable()
                ->where('role', '=', $search_role)
                ->where(function ($query) use ($search_keyword) {
                    $query->where('user_id', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('name', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('email', 'LIKE', "%{$search_keyword}%");
                })
                ->get();
        } else if ($request->get('keyword') != null && $request->has('programme')) {
            $users = User::sortable()
                ->where('programme', '=', $search_programme)
                ->where(function ($query) use ($search_keyword) {
                    $query->where('user_id', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('name', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('email', 'LIKE', "%{$search_keyword}%");
                })
                ->get();
        } else if ($request->has('role') && $request->has('programme')) {
            $users = User::sortable()
                ->where('role', '=', $search_role)
                ->where('programme', '=', $search_programme)
                ->get();
        } else if ($request->get('keyword') != null) {
            $users = User::sortable()
                ->where(function ($query) use ($search_keyword) {
                    $query->where('user_id', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('name', 'LIKE', "%{$search_keyword}%")
                        ->orWhere('email', 'LIKE', "%{$search_keyword}%");
                })
                ->get();
        } else if ($request->has('role')) {
            $users = User::sortable()
                ->where('role', '=', $search_role)
                ->get();
        } else if ($request->has('programme')) {
            $users = User::sortable()
                ->where('programme', '=', $search_programme)
                ->get();
        } else {
            $users = User::sortable()->get();
        }

        $programmes = DB::table('programme')->get();

        return view('pages.admin.user.index', ['users' => $users, 'programmes' => $programmes, 'search_keyword' => $search_keyword, 'search_role' => $search_role, 'search_programme' => $search_programme]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programmes = DB::table('programme')->get();
        return view('pages.admin.user.create', ['programmes' => $programmes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:users,user_id',
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('App\Models\User', 'email'), 'unique:users,email'],
            'role' => 'required'
        ]);

        if ($request->role == "Student" && $request->programme == null)
            return back()->withErrors('Programme is not selected for the new user(Student).');

        $user = new User;
        $user->user_id = $request->user_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->user_id);
        $user->role = $request->role;
        $user->programme = $request->programme;

        if ($user->save()) {
            return redirect()->route('user.index')->with('success', 'User created successfully!');
        } else {
            return redirect()->route('user.index')->with('error', 'User cannot be created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $programmes = DB::table('programme')->get();
        return view('pages.admin.user.edit', ['user' => $user, 'programmes' => $programmes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('App\Models\User', 'email')->ignore($user->id)]
        ]);

        $user->user_id = $request->user_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->programme = $request->programme;

        if ($user->save()) {
            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } else {
            return redirect()->route('user.index')->with('error', 'User cannot be updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // check if user is self
        if ($user != auth()->user()) {
            if ($user->delete()) {
                return back()->with('success', 'User deleted successfully!');
            }
            return back()->with('error', "User cannot not deleted.");
        }
        return back()->with('error', "You cannot delete yourself.");
    }


    /**
     * User Profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userProfile(Request $request)
    {
        return view('pages.profile.userProfile');
    }


    /**
     * Change Password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required', 'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ]);

        //Check if match current password
        if (Hash::check($request->current_password, auth()->user()->password)) {
            // Check if new password is not the same as current password
            if (!Hash::check($request->new_password, auth()->user()->password)) {
                //Update the new Password
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return back()->with('success', 'Password changed successfully!');
            } else
                return back()->with('error', 'New password is the same as current password.');
        } else
            return back()->with("error", "Old Password Doesn't match!");
    }
}
