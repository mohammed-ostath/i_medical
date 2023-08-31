<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('admin.inc.login.login');
    }
    public function login()
    {
        // dd($request->all());
        $cred = request()->only('email', 'password');
        if (auth()->attempt($cred) && auth()->user()->role == 'admin') {
            return redirect()->route('admin.index');
        }
        $this->logout();
        return redirect()->back()->with('error', 'Wrong Admin Logging?!');
    }

    public function logout()
    {
        Auth()->logout();
        request()->session()->invalidate();
        return redirect()->route('admin.loginPage');
    }
}
