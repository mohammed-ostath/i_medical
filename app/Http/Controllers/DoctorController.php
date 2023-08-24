<?php

namespace App\Http\Controllers;


use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        $doctors = Doctor::all();
        return view('admin.doctors.index', compact('doctors', 'majors'));
    }

    public function create()
    {
        $majors = Major::all();
        $doctors = Doctor::all();
        return view('admin.doctors.create', compact('majors', 'doctors'));
    }

    public function store(Request $request)
    {
        dd($request->all());

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'title' => 'nullable|exists:doctors,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
            'major_id' => 'required|exists:majors,id',
        ]);

        $imagePath = 'doctors_images/' . time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('doctors_images'), $imagePath);
        dd($request->all());

        $doctors = Doctor::create([
            'name' => $validatedData['name'],
            'title' => $validatedData['title'],
            'image' => $imagePath,
            'major_id' => $validatedData['major_id'],

        ]);


        return redirect()->route('doctors.index')->with('success', 'Doctor Created successfully.');
    }


    public function edit($id)
    {
        $doctors = Doctor::find($id);
        $majors = Major::all();
        return view('admin.doctors.edit', compact('doctors', 'majors'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'title' => 'nullable|exists:doctors,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
            'major_id' => 'required|exists:majors,id',
        ]);
        $doctor = Doctor::find($doctor);
        if (!$doctor) {
            return redirect()->route('doctors.index')->with('error', 'Doctor not found');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = 'doctors_images/' . time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('doctors_images'), $imagePath);
            $doctor->image = $imagePath;
        }
        $doctor->name = $request->input('name');
        $doctor->title = $request->input('title');
        $doctor->major_id = $request->input('major_id');
        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor Updated successfully.');
    }


    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    }

}
