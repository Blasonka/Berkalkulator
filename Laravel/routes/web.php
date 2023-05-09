<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Always visible
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/support', function () {
    return view('support');
})->name('support');

// Only guest can see
Route::middleware('guest')->group(function () {
    Route::get('register', function () { return view('register'); })->name('register');
    Route::post('register', [UserController::class, 'store']);

    Route::get('login', function () { return view('login'); })->name('login');
    Route::post('login', [UserController::class, 'login']);
});

// Only authenticated users can see
Route::middleware('auth')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');;
});
