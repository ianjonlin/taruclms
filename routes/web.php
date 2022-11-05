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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;

// General Routing
Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');
Route::get('/home', function () {
    return redirect('userProfile');
})->middleware('auth');;


// Login and Forgot Password
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');

Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');

Route::get('/reset-password/{token}', function ($token) {
    return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');


// Header Nav Bar
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');


// Side Nav Bar
Route::group(['middleware' => 'auth'], function () {

    Route::get('userProfile', function () {
        return view('pages.profile.userProfile');
    })->name('userProfile');

    Route::get('changePassword', function () {
        return view('pages.profile.changePassword');
    })->name('changePassword');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('changePassword');

    // Resource
    Route::resource('user', UserController::class);
    Route::resource('course', CourseController::class);
    // Route::resources([
    //     'user' => UserController::class,
    //     'course' => CourseController::class,
    // ]);

    Route::get('billing', function () {
        return view('pages.billing');
    })->name('billing');
    Route::get('tables', function () {
        return view('pages.tables');
    })->name('tables');
    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');
    Route::get('user-management', function () {
        return view('pages.user-management');
    })->name('user-management');
});
