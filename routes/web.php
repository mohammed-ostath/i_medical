<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontMajorController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\FrontDoctorController;


// Dashboard Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
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
// Major Routes
Route::get('/majors', [FrontMajorController::class, 'index'])->name('front.majors.index');
// Doctor Routes
Route::get('/doctors', [FrontDoctorController::class, 'index'])->name('front.doctors.index');

Auth::routes();
// login
Route::get('/VCare/login', [LoginController::class, 'index'])->name('auth.login');
// Route::post('/VCare/login', [LoginController::class, 'login'])->name('post.auth.login');
// register
Route::get('/VCare/register', [RegisterController::class, 'index'])->name('auth.register');
// Route::post('/VCare/register', [LoginController::class, 'register'])->name('post.auth.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
