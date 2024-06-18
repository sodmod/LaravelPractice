<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register user
    public function register(Request $request): string
    {
        // Validate
        $fields = $request->validate([
            "name" => ["required", "max:255"],
            "email" => ["required", "max:255", "email", "unique:users"],
            "password" => ["required", "min:3", "confirmed"]
        ]);

        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // Redirect
        return redirect()->route("dashboard");
    }

    // login user
    public function login(Request $request): string
    {
        // Validate
        $fields = $request->validate([
            "email" => ["required", "max:255", "email"],
            "password" => ["required"]
        ]);

//        dd($request);

        // try to login the user

        if (Auth::attempt($fields, $request->remember)) {
//            return redirect()->route("home");
            return redirect()->intended("dashboard");
        } else {
            return back()->withErrors([
                "failed" => "The provided credentials do not match our records."
            ]);
        }
    }

    public function logout(Request $request):string
    {
        // Logout the user
        Auth::logout();

        // Invalidate user's session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
