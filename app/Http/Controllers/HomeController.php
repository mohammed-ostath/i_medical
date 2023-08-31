<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $majors = Major::all();
        $doctors = Doctor::all();
        return view('front.index', compact('majors', 'doctors'));
    }
}
