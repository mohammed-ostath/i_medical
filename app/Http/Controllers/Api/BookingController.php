<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        $bookings = Booking::get();
        return $bookings;
    }

    public function show($id){
        $booking = Booking::find($id);
        return $booking;
    }
}
