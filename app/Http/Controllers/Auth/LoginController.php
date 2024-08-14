<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController
{
    public function login()
    {
        return view("auth.login");
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        if (Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $request->input("remember"))) {
            Session::flash('success', 'Login successful.');
            return redirect()->route("dashboard.profile");
        }

        Session::flash('error', 'Invalid username or password!');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
