<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Database\Schema\IndexDefinition;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('front.majors.index',compact('majors'));
    }
}
