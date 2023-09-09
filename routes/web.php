<?php

// use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AuthLoginController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Front\FrontMajorController;
use App\Http\Controllers\Front\FrontDoctorController;
use App\Http\Controllers\Front\FrontBookingController;

// Dashboard Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth', 'isAdmin']);

// admin login
Route::get('/admin/login', [AuthLoginController::class, 'loginPage'])->name('admin.loginPage')->middleware('guest');
Route::post('/admin/login', [AuthLoginController::class, 'login'])->name('admin.login')->middleware('guest');

// admin logout
Route::get('/admin/logout', [AuthLoginController::class, 'logout'])->name('admin.logout')->middleware('auth');

// Admin Major Routes
Route::get('/admin/majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('/admin/majors/create', [MajorController::class, 'create'])->name('majors.create');
Route::post('/admin/majors/store', [MajorController::class, 'store'])->name('majors.store');
Route::get('/admin/majors/edit/{major}', [MajorController::class, 'edit'])->name('majors.edit');
Route::patch('/admin/majors/{major}', [MajorController::class, 'update'])->name('majors.update');
Route::delete('/admin/majors/{major}', [MajorController::class, 'destroy'])->name('majors.destroy');

// Admin Doctor Routes
Route::get('/admin/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/admin/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
Route::post('/admin/doctors/store', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/admin/doctors/edit/{doctor}', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/admin/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/admin/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

// Admin Booking Routes
Route::get('/admin/read-notifications/{id}', [BookingController::class, 'info'])->name('admin.booking.info');
Route::get('/admin/booking', [BookingController::class, 'readAll'])->name('read.all');


// Front Routes
Route::get('/VCare', [FrontController::class, 'index'])->name('front.index');
Route::get('/', [FrontController::class, 'index'])->name('front2.index');
// Major Routes
Route::get('/majors', [FrontMajorController::class, 'index'])->middleware(['auth', 'verified'])->name('front.majors.index');
// Doctor Routes
Route::get('/doctors', [FrontDoctorController::class, 'index'])->middleware(['auth', 'verified'])->name('front.doctors.index');
// Booking Routes
Route::get('/booking/{doctor}', [FrontBookingController::class, 'index'])->middleware(['auth', 'verified'])->name('front.booking');
Route::post('/booking', [FrontBookingController::class, 'book'])->middleware(['auth', 'verified'])->name('front.store');



Auth::routes();
// // register
Route::get('/VCare/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/VCare/register', [AuthController::class, 'registerSub'])->name('registerSub');
// Route::get('/VCare/register/', [AuthController::class, 'index'])->name('send-mail');

// login
Route::get('/VCare/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/VCare/login', [AuthController::class, 'loginSub'])->name('loginSub');

Route::get('/VCare/logout', [AuthController::class, 'Logout'])->name('auth.logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
