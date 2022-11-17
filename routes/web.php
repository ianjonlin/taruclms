<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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

    // Global Data - View Composer
    View::composer(['*'], function ($view) {
        // For students
        if (auth()->user()->role == "Student") {
            $programme_id = auth()->user()->programme;

            $programme_structure_y1_s1 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 1],
                    ['sem', '=', 1]
                ])->get();
            $programme_structure_y1_s2 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 1],
                    ['sem', '=', 2]
                ])->get();
            $programme_structure_y1_s3 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 1],
                    ['sem', '=', 3]
                ])->get();

            $programme_structure_y2_s1 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 2],
                    ['sem', '=', 1]
                ])->get();
            $programme_structure_y2_s2 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 2],
                    ['sem', '=', 2]
                ])->get();
            $programme_structure_y2_s3 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 2],
                    ['sem', '=', 3]
                ])->get();

            $programme_structure_y3_s1 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 3],
                    ['sem', '=', 1]
                ])->get();
            $programme_structure_y3_s2 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 3],
                    ['sem', '=', 2]
                ])->get();
            $programme_structure_y3_s3 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 3],
                    ['sem', '=', 3]
                ])->get();

            $programme_structure_y4_s1 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 4],
                    ['sem', '=', 1]
                ])->get();
            $programme_structure_y4_s2 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 4],
                    ['sem', '=', 2]
                ])->get();
            $programme_structure_y4_s3 = DB::table('programme_structure')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course.code as code', 'course.title as title')
                ->where([
                    ['programme_id', '=', $programme_id],
                    ['year', '=', 4],
                    ['sem', '=', 3]
                ])->get();

            View::share([
                'programme_structure_y1_s1' => $programme_structure_y1_s1,
                'programme_structure_y1_s2' => $programme_structure_y1_s2,
                'programme_structure_y1_s3' => $programme_structure_y1_s3,
                'programme_structure_y2_s1' => $programme_structure_y2_s1,
                'programme_structure_y2_s2' => $programme_structure_y2_s2,
                'programme_structure_y2_s3' => $programme_structure_y2_s3,
                'programme_structure_y3_s1' => $programme_structure_y3_s1,
                'programme_structure_y3_s2' => $programme_structure_y3_s2,
                'programme_structure_y3_s3' => $programme_structure_y3_s3,
                'programme_structure_y4_s1' => $programme_structure_y4_s1,
                'programme_structure_y4_s2' => $programme_structure_y4_s2,
                'programme_structure_y4_s3' => $programme_structure_y4_s3
            ]);
        }

        // For lecturers - assigned courses / CC
        if (auth()->user()->role == "Lecturer") {

            // If lecturer is CC

            // Else
            $assigned_courses = DB::table('assigned_course')
                ->join('course', 'course_id', '=', 'course.id')
                ->select('course_id as id', 'course.code as code', 'course.title as title')
                ->where('lecturer_id', '=', auth()->user()->id)
                ->get();

            View::share('assigned_courses', $assigned_courses);
        }
    });

    // User Profile
    Route::get('userProfile', [UserController::class, 'userProfile'])->name('userProfile');
    Route::get('changePassword', function () {
        return view('pages.profile.changePassword');
    })->name('changePassword');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('changePassword');

    // Resource
    Route::resources([
        'user' => UserController::class,
        'course' => CourseController::class,
        'programme' => ProgrammeController::class,
        'keyword' => KeywordController::class,
    ]);

    // assigned_course
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
