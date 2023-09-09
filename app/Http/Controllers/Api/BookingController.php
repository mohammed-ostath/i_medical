<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::get();
        return $bookings;
    }

    public function show($id)
    {
        $booking = Booking::find($id);
        return $booking;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:bookings,name|max:255',
            'email' => 'required|string|email|unique:bookings,email|max:255',
            'phone' => 'required|string|unique:bookings,phone|max:255',
            'status' => 'required|in:0,1',
            'doctor_id' => 'required|exists:doctors,id',
            'booking_date' => 'required|date',
        ]);

        $booking = Booking::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
            'doctor_id' => $request->input('doctor_id'),
            'booking_date' => $request->input('booking_date'),
        ]);

        return response()->json(['message' => 'Create Booking Success', 'data' => $booking], 201);
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'doctor_id' => 'required|exists:doctors,id',
            'booking_date' => 'required|date',
        ]);

        $booking->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
            'doctor_id' => $request->input('doctor_id'),
            'booking_date' => $request->input('booking_date'),
        ]);

        return response()->json(['message' => 'Update Booking Success', 'data' => $booking], 200);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['message' => 'Delete Booking Success'], 200);
    }
}
