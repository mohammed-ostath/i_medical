<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register()
    {
        $majors = Major::all();
        return view('auth.register', compact('majors'));
    }

    public function registerSub(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:15',
            'phone' => 'required|unique:users,phone',
        ]);
        $validation['password'] = Hash::make($validation['password']);
        $validation['role'] = 'user';
        $users = User::create($validation);
        return view('front.index');
    }



    public function login()
    {
        return view('auth.login');
    }

    public function loginSub(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('front.index');
        }
        return back()->withErrors(['email' => 'Invalid email or password']);
    }
}
