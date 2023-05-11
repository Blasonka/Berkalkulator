<?php

use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    Route::get('register', function () {
        return view('register');
    })->name('register');
    Route::post('register', [UserController::class, 'store']);

    Route::get('login', function () {
        return view('login');
    })->name('login');
    Route::post('login', [UserController::class, 'login']);
});

// Only authenticated users can see
Route::middleware('auth')->group(function () {
    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');

    Route::get('/shifts', function () {
        $shifts = DB::table('shifts')->where('user_id', Auth::user()->id)->orderBy('start_time', 'desc')->get();
        setlocale(LC_TIME, 'hu_HU.UTF-8');
        Carbon::setLocale('hu');
        foreach ($shifts as $shift) {
            $shift->date = Carbon::parse($shift->start_time)->format('Y. m. j.');
            $shift->start_time = Carbon::parse($shift->start_time)->format('H:i');
            $shift->end_time = Carbon::parse($shift->end_time)->format('H:i');
        }
        return view('shift', ['shifts' => $shifts]);
    })->name('shifts');

    Route::post('shift', [ShiftController::class, 'store'])->name('shift');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/calculator', function () {
        return view('calculator');
    })->name('calculator');
});
