<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile()
    {
        return view("dashboard.users.profile");
    }
}
