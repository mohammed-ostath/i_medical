<?php

namespace App\Http\Controllers\Admin;

use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        return view('admin.majors.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|max:200',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);
        $imagePath = 'majors_images/' . time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('majors_images'), $imagePath);

        $majors = Major::create([
            'title' => $request['title'],
            'image' => $imagePath,
        ]);

        return redirect()->route('majors.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $major = Major::findOrFail($id);
        return view('admin.majors.edit', compact('major'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => 'required|max:200',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4048',
        ]);

        $major = Major::find($id);

        if (!$major) {
            return redirect()->route('majors.index')->with('error', 'Major not found');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = 'majors_images/' . time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('majors_images'), $imagePath);
            $major->image = $imagePath;
        }

        $major->title = $request->input('title');
        $major->save();

        return redirect()->route('majors.index')->with('success', 'Major Updated successfully');
    }

    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('majors.index')->with('success', 'Category deleted successfully');
    }
}
