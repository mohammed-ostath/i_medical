<?php

namespace App\Http\Controllers\Front;

use App\Events\RegisterEvent;
use App\Models\User;
use App\Models\Major;
use App\Models\Doctor;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function register()
    {
        $majors = Major::all('*');
        $doctors = Doctor::all('*');
        return view('auth.register', compact('majors', 'doctors'));
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
        // $data = [
        //     'name' => $users->name,
        //     'email' => $users->email,
        // ];
        // Mail::to($users->email)->send(new RegisterMail($data));
        event(new RegisterEvent($users));
        return back()->with('success', 'Checked Email Register');
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

    public function Logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        return redirect()->route('front.index');
    }
}
