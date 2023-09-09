<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route Api Majors
Route::get('api-majors', [MajorController::class, 'index']);
Route::get('api-majors/{major}', [MajorController::class, 'show']);
Route::post('api-majors', [MajorController::class,'store']);
Route::put('api-majors/{major}', [MajorController::class, 'update']);
Route::delete('api-majors/{major}', [MajorController::class, 'destroy']);
// Route Api Doctors
Route::get('api-doctors', [DoctorController::class, 'index']);
Route::get('api-doctors/{id}', [DoctorController::class, 'show']);
Route::post('api-doctors', [DoctorController::class,'store']);
Route::post('api-doctors/{doctor}', [DoctorController::class, 'update']);
Route::delete('api-doctors/{doctor}', [DoctorController::class, 'destroy']);
// Route Api Bookings
Route::get('api-bookings', [BookingController::class, 'index']);
Route::get('api-bookings/{id}', [BookingController::class, 'show']);
Route::post('api-bookings', [BookingController::class,'store']);
Route::put('api-bookings/{booking}', [BookingController::class, 'update']);
Route::delete('api-bookings/{booking}', [BookingController::class, 'destroy']);
// Route Authorization
Route::post('api/register', [RegisterController::class, 'register']);
Route::post('api/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

