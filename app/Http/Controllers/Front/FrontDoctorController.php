<?php

namespace App\Http\Controllers\Front;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('front.doctors.index', compact('doctors'));
    }
}
