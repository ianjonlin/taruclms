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
use App\Http\Controllers\LMCategoryController;
use App\Http\Controllers\LearningMaterialController;
use App\Http\Controllers\CMCategoryController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\ForumController;


// General Routing
Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');
Route::get('/home', function () {
    return redirect('userProfile');
})->middleware('auth');


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
    Route::resource('user', UserController::class);
    Route::resource('course', CourseController::class);
    Route::resource('programme', ProgrammeController::class);
    Route::resource('keyword', KeywordController::class);

    // User Profile
    Route::get('userProfile', [UserController::class, 'userProfile'])->name('userProfile');
    Route::get('changePassword', function () {
        return view('pages.profile.changePassword');
    })->name('changePassword');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('changePassword');

    //View Course
    Route::get('course/{courseCode}/view', [CourseController::class, 'viewCourse'])->name('viewCourse');
    Route::get('course/{courseCode}/editDetails', [CourseController::class, 'editDetails'])->name('editDetails');
    Route::put('course/{courseCode}/updateDetails', [CourseController::class, 'updateDetails'])->name('updateDetails');

    // Learning Material Category
    Route::get('course/{courseCode}/LMCategory', [LMCategoryController::class, 'viewLMCategory'])->name('viewLMCategory');
    Route::get('course/{courseCode}/LMCategory/create', [LMCategoryController::class, 'createLMCategory'])->name('createLMCategory');
    Route::post('course/{courseCode}/LMCategory/store', [LMCategoryController::class, 'storeLMCategory'])->name('storeLMCategory');
    Route::get('course/{courseCode}/LMCategory/edit/{id}', [LMCategoryController::class, 'editLMCategory'])->name('editLMCategory');
    Route::put('course/{courseCode}/LMCategory/update/{id}', [LMCategoryController::class, 'updateLMCategory'])->name('updateLMCategory');
    Route::delete('course/{courseCode}/LMCategory/delete/{id}', [LMCategoryController::class, 'deleteLMCategory'])->name('deleteLMCategory');

    // Learning Material
    Route::get('course/{courseCode}/learningMaterial/create', [LearningMaterialController::class, 'createLearningMaterial'])->name('createLearningMaterial');
    Route::post('course/{courseCode}/learningMaterial/store', [LearningMaterialController::class, 'storeLearningMaterial'])->name('storeLearningMaterial');
    Route::delete('course/{courseCode}/learningMaterial/delete/{id}', [LearningMaterialController::class, 'deleteLearningMaterial'])->name('deleteLearningMaterial');
    Route::get('course/{courseCode}/learningMaterial/download/{id}', [LearningMaterialController::class, 'downloadLearningMaterial'])->name('downloadLearningMaterial');

    // Course Material Category
    Route::get('course/{courseCode}/CMCategory', [CMCategoryController::class, 'viewCMCategory'])->name('viewCMCategory');
    Route::get('course/{courseCode}/CMCategory/create', [CMCategoryController::class, 'createCMCategory'])->name('createCMCategory');
    Route::post('course/{courseCode}/CMCategory/store', [CMCategoryController::class, 'storeCMCategory'])->name('storeCMCategory');
    Route::get('course/{courseCode}/CMCategory/edit/{id}', [CMCategoryController::class, 'editCMCategory'])->name('editCMCategory');
    Route::put('course/{courseCode}/CMCategory/update/{id}', [CMCategoryController::class, 'updateCMCategory'])->name('updateCMCategory');
    Route::delete('course/{courseCode}/CMCategory/delete/{id}', [CMCategoryController::class, 'deleteCMCategory'])->name('deleteCMCategory');

    // Course Material
    Route::get('course/{courseCode}/courseMaterial/create', [CourseMaterialController::class, 'createCourseMaterial'])->name('createCourseMaterial');
    Route::post('course/{courseCode}/courseMaterial/store', [CourseMaterialController::class, 'storeCourseMaterial'])->name('storeCourseMaterial');
    Route::delete('course/{courseCode}/courseMaterial/delete/{id}', [CourseMaterialController::class, 'deleteCourseMaterial'])->name('deleteCourseMaterial');
    Route::get('course/{courseCode}/courseMaterial/download/{id}', [CourseMaterialController::class, 'downloadCourseMaterial'])->name('downloadCourseMaterial');

    // Assign Course to Lecturer - Admin Function
    Route::post('addLecturer', [CourseController::class, 'addLecturer'])->name('addLecturer');
    Route::post('deleteLecturer', [CourseController::class, 'deleteLecturer'])->name('deleteLecturer');

    // Forum Q&A Post and Answer
    Route::get('course/{courseCode}/forum/view/all', [ForumController::class, 'viewForumPostAll'])->name('viewForumPostAll');
    Route::get('course/{courseCode}/forum/create/post', [ForumController::class, 'createForumPost'])->name('createForumPost');
    Route::post('course/{courseCode}/forum/store/post', [ForumController::class, 'storeForumPost'])->name('storeForumPost');
    Route::delete('course/{courseCode}/forum/delete/post/{id}', [ForumController::class, 'deleteForumPost'])->name('deleteForumPost');
    Route::get('course/{courseCode}/forum/view/{id}', [ForumController::class, 'viewForumPost'])->name('viewForumPost');
    Route::post('course/{courseCode}/forum/view/{id}/reply/store', [ForumController::class, 'storeForumReply'])->name('storeForumReply');
    Route::delete('course/{courseCode}/forum/view/{id}/reply/delete', [ForumController::class, 'deleteForumReply'])->name('deleteForumReply');
});
