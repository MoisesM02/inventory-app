<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $users = User::all()->except(1);

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
}
