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

use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\KeywordController;

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


// Authenticated Users Nav Bar
Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::group(['middleware' => 'auth'], function () {

    // Resource
    Route::resources([
        'user' => UserController::class,
        'course' => CourseController::class,
        'programme' => ProgrammeController::class,
        'keyword' => KeywordController::class,
    ]);

    // User Profile
    Route::get('userProfile', [UserController::class, 'userProfile'])->name('userProfile');
    Route::get('changePassword', function () {
        return view('pages.profile.changePassword');
    })->name('changePassword');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('changePassword');

    //View Course
    Route::get('viewCourse/{courseCode}', [CourseController::class, 'viewCourse'])->name('viewCourse');
    Route::get('editDetails/{courseCode}', [CourseController::class, 'editDetails'])->name('editDetails');
    Route::put('updateDetails/{courseCode}', [CourseController::class, 'updateDetails'])->name('updateDetails');

    // Assign Course to Lecturer - Admin Function
    Route::post('addLecturer', [CourseController::class, 'addLecturer'])->name('addLecturer');
    Route::post('deleteLecturer', [CourseController::class, 'deleteLecturer'])->name('deleteLecturer');

    // to be removed - reference templates
    Route::get('dashboard', function () {
        return view('pages.template.index');
    })->name('dashboard');
    Route::get('billing', function () {
        return view('pages.template.billing');
    })->name('billing');
    Route::get('tables', function () {
        return view('pages.template.tables');
    })->name('tables');
    Route::get('notifications', function () {
        return view('pages.template.notifications');
    })->name('notifications');
});
