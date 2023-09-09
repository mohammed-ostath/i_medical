<?php

namespace App\Http\Controllers\Front;

use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'name' => 'My name',
            'email' => 'The email',
            'phone' => '0569300640',
        ];

        Mail::to('mohammedostath@gmail.com')->send(new RegisterMail($data));

        dd("Email is sent successfully.");
    }
}
