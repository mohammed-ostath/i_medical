<?php

namespace App\Http\Controllers\Api;

use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MajorResource;

class MajorController extends Controller
{

    public function index()
    {
        $majors = Major::get();
        return $majors;
    }

    public function show(Major $major)
    {
        return $major;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:majors,title',
            'image' => 'string',
        ]);
        $major = Major::create($request->all());
        return response()->json(['message' => 'Store Major Success','data' => $major], 200);
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'title' => 'required|string|unique:majors,title,' . $major->id,
            'image' => 'string',
        ]);

        $major->update($request->all());

        return response()->json(['message' => 'Update Major Success'], 200);
    }

    public function destroy(Major $major)
    {
        $major->delete();
        return response()->json(['message' => 'Delete Major Success'], 200);
    }
}
