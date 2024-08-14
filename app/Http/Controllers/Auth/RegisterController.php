<?php


namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController
{
    public function register()
    {
        $current_date = new \DateTime();
        $min_date = (clone $current_date)->modify('-25 years');
        $max_date = (clone $current_date)->modify('-21 years');
        $min_date_formatted = $min_date->format('Y-m-d');
        $max_date_formatted = $max_date->format('Y-m-d');

        return view("auth.register", compact('min_date_formatted', 'max_date_formatted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha|max:50',
            'last_name' => 'alpha|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'mobile_number' => 'required|numeric|unique:users,mobile_number|digits:10',
            'password' => 'required|max:20|confirmed',
            'password_confirmation' => 'required|max:20',
            'pan_card' => 'required|max:10|regex:/^[A-Z]{5}/|regex:/[0-9]{4}/|regex:/[A-Z]{1}$/',
            'date_of_birth' => 'required|date',
            'gender' => "required|alpha|max:6",
            'address' => 'max:200',
        ], [
            'pan_number.regex' => [
                'regex:/^[A-Z]{5}/' => 'The first five characters must be letters.',
                'regex:/[0-9]{4}/' => 'The next four characters must be digits.',
                'regex:/[A-Z]{1}$/' => 'The last character must be a letter.',
            ],
        ]);

        $password_errors = [];
        if (!preg_match('/[A-Z]/', $request->input("password"))) {
            $password_errors[] = 'The password must contain at least one uppercase letter.';
        }
        if (!preg_match('/[a-z]/', $request->input("password"))) {
            $password_errors[] = 'The password must contain at least one lowercase letter.';
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $request->input("password"))) {
            $password_errors[] = 'The password must contain at least one special character.';
        }

        if (!empty($password_errors)) {
            return back()->withErrors(['password' => $password_errors])->withInput();
        }

        User::create([
            "name" => $request->input("first_name") . " " . $request->input("last_name"),
            "first_name" => $request->input("first_name"),
            "last_name" => $request->input("last_name"),
            "email" => $request->input("email"),
            "mobile_number" => $request->input("mobile_number"),
            "password" => Hash::make($request->input("password")),
            "pan_card" => $request->input("pan_card"),
            "date_of_birth" => $request->input("date_of_birth"),
            "gender" => $request->input("gender"),
            "address" => $request->input("address"),
        ]);

        Session::flash('success', 'Registration successful.');
        return redirect()->route("login");
    }
}
