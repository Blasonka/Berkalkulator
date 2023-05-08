<?php

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

// Mindig látszik
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/support', function () {
    return view('support');
})->name('support');
// Route::get('/login', function () {
//     return view('login');
// })->name('login');

Route::middleware('guest')->group(function () {
    Route::get('register', function () { return view('register'); })->name('register');
    Route::post('register', [UserController::class, 'store']);

    Route::get('login', function () { return view('login'); })->name('login');
    Route::post('login', [UserController::class, 'login']);
});
