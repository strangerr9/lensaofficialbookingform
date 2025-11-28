<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BookingController::class, 'showForm']);




Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::post('/create-booking', [BookingController::class,'create']);
// Route::post('/create-booking', function () {
//     return redirect('/')->with('success', 'Thank you! Your booking was submitted.');
// });
Route::post('/create-booking', [BookingController::class,'create_booking']);
