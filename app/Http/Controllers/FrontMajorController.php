<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class FrontMajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('front.majors.index',compact('majors'));
    }
}
