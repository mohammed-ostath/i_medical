<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

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
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'title' => 'required|max:250',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
            'major_id' => 'required|exists:majors,id',
        ]);

        $imagePath = 'doctors_images/' . time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('doctors_images'), $imagePath);

        $doctors = Doctor::create([
            'name' => $validatedData['name'],
            'title' => $validatedData['title'],
            'image' => $imagePath,
            'major_id' => $validatedData['major_id'],

        ]);
        return response()->json(['message' => 'Store Doctor Success', 'data' => $doctors], 200);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|max:100',
            'title' => 'required|max:250',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
            'major_id' => 'required|exists:majors,id'
        ]);

        $doctor->update($request->only(['name', 'title', 'major_id']));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctors_images');
            $doctor->image = $imagePath;
            $doctor->save();
        }

        return response()->json(['message' => 'Update Doctor Success', 'data' => $doctor], 200);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(['message' => 'Delete Doctor Success'], 200);
    }
}
