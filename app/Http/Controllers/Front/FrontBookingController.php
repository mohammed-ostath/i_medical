<?php

namespace App\Http\Controllers\Front;

use App\Models\Doctor;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Notification;

class FrontBookingController extends Controller
{
    public function index(Doctor $doctor)
    {
        return view('front.booking.index', compact('doctor'));
    }

    public function book(Request $request, Doctor $doctor)
    {
        $validator = $request->validate([
            'name' => 'required|unique:bookings,name|min:3|max:25',
            'email' => 'required|unique:bookings,email',
            'phone' => 'required|unique:bookings,phone|min:5|max:10',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $validator['booking_date'] = now()->format('Y-m-d H:i:s');
        $validator['status'] = 0;
        Booking::create($validator);
        $doctor = Doctor::findOrFail($validator['doctor_id']);
        Notification::send($doctor, new BookingNotification($validator['name'], $validator['email'], $validator['phone'], $validator['booking_date']));
        return back()->with('success', 'Booking Addedd Successfully');
    }
}
