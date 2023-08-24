<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class FrontDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('front.doctors.index', compact('doctors'));
    }
}
