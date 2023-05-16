<?php

use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WageController;
use App\Models\Wage;
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

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/support', function () {
    return view('support');
})->name('support');

// Only guest can see
Route::middleware('guest')->group(function () {

    //Register methods
    Route::get('register', function () {
        return view('register');
    })->name('register');
    Route::post('register', [UserController::class, 'store']);

    //Login methods
    Route::get('login', function () {
        return view('login');
    })->name('login');
    Route::post('login', [UserController::class, 'login']);
});

// Only authenticated users can see
Route::middleware('auth')->group(function () {
    //Profile methods
    Route::get('/profile', function () {
        $wages = DB::table('wages')
            ->select(
                'id',
                'name',
                'value',
            )
            ->where('user_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();
        return view('profile', ['wages' => $wages]);
    })->name('profile');
    Route::put('/update_profile', [UserController::class, 'update'])->name('update_profile');
    Route::put('/update_password', [UserController::class, 'updatePassword'])->name('update_password');
    Route::delete('/delete_profile', [UserController::class, 'destroy'])->name('delete_profile');

    //Shifts methods
    Route::get('/shifts', [ShiftController::class, 'show_page'])->name('shifts');
    Route::post('shift', [ShiftController::class, 'store'])->name('shift');
    Route::post('wage', [WageController::class, 'store'])->name('wage');
    Route::put('/update_shift/{id}', [ShiftController::class, 'update'])->name('update_shift');
    Route::delete('/delete_shift/{id}', [ShiftController::class, 'destroy'])->name('delete_shift');

    //logout
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    //calculte
    Route::get('/calculator', function () {
        $wages = DB::table('wages')
            ->select(
                'id',
                'name',
                'value',
            )
            ->where('user_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();
        return view('calculator', ['wages' => $wages]);
    })->name('calculator');
});
