<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $users = User::all()->except(1); //Exclude the first username (The Administrator)

        return view('users.index', [
            'users' => $users
        ]);
    }
    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => ['required', 'confirmed', Password::min(6)],
            'role' => ['required', new Enum(UserRoles::class)],
        ]);

        $user = User::create($userAttributes);
        return redirect('/users')->with(['success' => 'User created!']);
    }

    public function edit(User $user)
    {
        if(Auth::user()->id != 1 && $user->id == 1) // Verify if the user has access to modify the first user of the DB (The administrator)
            abort(403);
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $userAttributes = $request->validate([
            'username' => ['required', 'string', 'max:32', Rule::unique('users', 'username')->ignore($user->id)],
            'password' => ['sometimes', 'nullable', 'confirmed', Password::min(6)],
            'role' => ['required', new Enum(UserRoles::class)],
        ]);

        if ($request->get('password') == null)
            unset($userAttributes['password']);

        $user->update($userAttributes);

        return redirect(route('users.edit', $user))->with(['success' => 'User updated!']);
    }

    public function destroy(User $user)
    {
        if (Auth::user()->is($user)) //Log Out User if the account deleted is the account in use
        {
            abort(403, 'You cannot delete your own account.');
//            Auth::logout();
//            request()->session()->invalidate();
//            request()->session()->regenerateToken();
        }
        $user->delete();
        return redirect('/users')->with(['success' => 'User deleted!']);
    }


}
