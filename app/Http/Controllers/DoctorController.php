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
        $doctors = Doctor::all();
        $majors = Major::all();
        return view('admin.doctors.create', compact('doctors', 'majors'));
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
        return redirect()->route('doctors.index')->with('success', 'Doctor Created successfully.');
    }


    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $majors = Major::all();
        return view('admin.doctors.edit', compact('doctor', 'majors'));
    }

    public function update(Request $request, Doctor $doctor)
{
    $validatedData = $request->validate([
        'name' => 'required|max:100',
        'title' => 'required|max:250',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        'major_id' => 'required|exists:majors,id',
    ]);

    // The $doctor parameter already holds the Doctor instance based on the route model binding

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
