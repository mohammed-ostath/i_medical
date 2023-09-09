<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function info($id)
    {

        $notification = DB::table('notifications')
            ->where('id', $id)
            ->where('notifiable_id', auth()->id())
            ->update(['read_at' => now()]);
        return redirect()->back();
    }



    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
