<?php

// use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthLoginController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\FrontMajorController;
use App\Http\Controllers\Front\FrontDoctorController;
use App\Http\Controllers\Auth\LoginController;




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

// Doctor Routes
Route::get('/admin/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/admin/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
Route::post('/admin/doctors/store', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/admin/doctors/edit/{doctor}', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/admin/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/admin/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

// Front Routes
Route::get('/VCare', [FrontController::class, 'index'])->name('front.index');
Route::get('/', [FrontController::class, 'index'])->name('front2.index');
// Major Routes
Route::get('/majors', [FrontMajorController::class, 'index'])->name('front.majors.index');
// Doctor Routes
Route::get('/doctors', [FrontDoctorController::class, 'index'])->name('front.doctors.index');

Auth::routes();
// // register
Route::get('/VCare/register', [RegisterController::class, 'index'])->name('auth.register');
Route::post('/VCare/register', [RegisterController::class, 'create'])->name('auth.register_data');

// login
Route::get('/VCare/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/VCare/login', [LoginController::class, 'login'])->name('auth.login_data');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
