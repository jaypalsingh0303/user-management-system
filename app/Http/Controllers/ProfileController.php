<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profile()
    {
        $current_date = new \DateTime();
        $min_date = (clone $current_date)->modify('-25 years');
        $max_date = (clone $current_date)->modify('-21 years');
        $min_date_formatted = $min_date->format('Y-m-d');
        $max_date_formatted = $max_date->format('Y-m-d');

        $user = User::find(auth()->user()->id);

        return view("dashboard.users.profile", compact("user", "min_date_formatted", "max_date_formatted"));
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|alpha|max:50',
            'last_name' => 'alpha|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . auth()->user()->id,
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number,' . auth()->user()->id,
            'password' => 'max:20|confirmed',
            'password_confirmation' => 'max:20',
            'pan_card' => 'required|max:10|regex:/^[A-Z]{5}/|regex:/[0-9]{4}/|regex:/[A-Z]{1}$/',
            'date_of_birth' => 'required|date',
            'gender' => "required|alpha|max:6",
            'address' => 'max:200',
            'profile' => 'file|mimes:jpg,png,jpeg|max:1024',
        ], [
            'pan_number.regex' => [
                'regex:/^[A-Z]{5}/' => 'The first five characters must be letters.',
                'regex:/[0-9]{4}/' => 'The next four characters must be digits.',
                'regex:/[A-Z]{1}$/' => 'The last character must be a letter.',
            ],
        ]);

        if ($request->input("password")) {
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
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->input("first_name") . " " . $request->input("last_name");
        $user->first_name = $request->input("first_name");
        $user->last_name = $request->input("last_name");
        $user->email = $request->input("email");
        $user->mobile_number = $request->input("mobile_number");
        if ($request->input("password")) {
            $user->password = Hash::make($request->input("password"));
        }
        $user->pan_card = $request->input("pan_card");
        $user->date_of_birth = $request->input("date_of_birth");
        $user->gender = $request->input("gender");
        $user->address = $request->input("address");
        $user->save();

        if ($request->file("profile")) {
            $profile = $request->file('profile');
            $unique_file_name = uniqid() . '.' . $profile->getClientOriginalExtension();
            $path = $profile->storeAs('uploads', $unique_file_name, 'public');
            $user->profile = $path;
            $user->save();
        }

        Session::flash('success', 'Update profile successful.');
        return redirect()->route("dashboard.profile");
    }

    public function delete()
    {
        $user = User::find(auth()->user()->id);

        if (file_exists(storage_path("app/public/$user->profile"))) {
            unlink(storage_path("app/public/$user->profile"));
        }

        $user->profile = null;
        $user->save();

        Session::flash('success', 'Profile delete successful.');
        return redirect()->route("dashboard.profile");
    }
}
