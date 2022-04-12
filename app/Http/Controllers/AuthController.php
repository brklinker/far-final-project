<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_track;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginWasSuccessful = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($loginWasSuccessful) {
            $user = Auth::user();
            if ($user->role_id == 1) {
                $count = User_track::where('user_id', '=', $user->id)->count();
                if ($count > 0) {
                    return redirect()->route('home.submitted');
                } else {
                    return redirect()->route('home.index');
                }
            } else if ($user->role_id == 2) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('anr.index');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
