<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\MajorController;
// use App\Http\Controllers\MajorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Dashboard Routes
// Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('/majors/create', [MajorController::class, 'create'])->name('majors.create');
Route::post('/majors/store', [MajorController::class, 'store'])->name('majors.store');
Route::get('/majors/edit/{major}', [MajorController::class, 'edit'])->name('majors.edit');
Route::patch('/majors/{major}', [MajorController::class, 'update'])->name('majors.update');
Route::delete('/majors/{major}', [MajorController::class, 'destroy'])->name('majors.destroy');


// Front Routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');

// Major Routes

Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
