<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::get();
        return $doctors;
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        return $doctor;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'title' => 'required|max:250',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
            'major_id' => 'required|exists:majors,id',
        ]);
        $doctor = Doctor::create($request->all());
        return response()->json(['message' => 'Create Doctor Success', 'data' => $doctor], 200);
    }
    public function update(Request $request, $id)
    {
    }
}
