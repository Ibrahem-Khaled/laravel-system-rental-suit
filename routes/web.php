<?php

use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\ReservationController;
use App\Http\Controllers\dashboard\SuitController;
use Illuminate\Support\Facades\Route;

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


Route::group([], function () {

    //this home route
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //this route add suit 
    Route::resource('suits', SuitController::class);
    Route::post('suits/{suit}/sizes', [SuitController::class, 'addSize'])->name('suits.addSize');
    Route::get('/suits/{suit}', [SuitController::class, 'show'])->name('suits.show');

    //this route 
    Route::resource('reservations', ReservationController::class);
});
