<?php

namespace App\Http\Controllers\Front;

use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index(){
        $majors = Major::all();
        $doctors = Doctor::all();
        return view('front.index',compact('majors','doctors'));
    }
}
