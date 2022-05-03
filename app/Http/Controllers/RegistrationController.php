<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use Auth;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|unique:users',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // bcrypt

        $userRole = Role::where('slug', '=', $request->input('options'))->first()->id;
        $user->role()->associate($userRole);

        $user->save();

        Auth::login($user);

        if ($user->role_id == 1) {
            return redirect()->route('home.index');
        } else if ($user->role_id == 2) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('anr.index');
        }
    }
}
