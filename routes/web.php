<?php

use App\Http\Controllers\SchoolTermController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\Student\StudentRegistrationController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\Settings\SchoolSettings;
use App\Http\Livewire\Test;
use App\Models\User;
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
//Authentication
Route::get('/', function () {
//    return view('auth.login');})->name('user.login')->middleware('guest');
    return view('welcome');
});
Auth::routes();

Route::get('/users/{user}', function (User $user) {
    return $user->email;
});

//Route group for different level of authenticated users
Route::group(['middleware' => 'auth', ], function ()
{
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    //Administrator
    Route::group(['middleware' => 'admin', 'as' => 'admin.'], function(){
        Route::get('/general-settings', SchoolSettings::class)->name('general.settings');
        Route::get('/academic-years', \App\Http\Livewire\Settings\AcademicYears::class)->name('academic.years');
        Route::get('/academic-terms', \App\Http\Livewire\Settings\AcademicTerms::class)->name('academic.terms');
        Route::get('/manage-sections', \App\Http\Livewire\Academics\Sections::class)->name('manage.sections');
        Route::get('/manage-levels', \App\Http\Livewire\Academics\Levels::class)->name('manage.levels');
        Route::get('/manage-classes', \App\Http\Livewire\Academics\Classes::class)->name('manage.classes');
        Route::get('/manage-departments', \App\Http\Livewire\Academics\Departments::class)->name('manage.departments');
        Route::get('/manage-subjects', \App\Http\Livewire\Academics\Subjects::class)->name('manage.subjects');
        Route::get('/student-registration', \App\Http\Livewire\Student\StudentRegistration::class)->name('student.registration');
        Route::get('/upload-students/{id}', [\App\Http\Controllers\User\UsersController::class, 'upLoadView'])->name('upload.students');
        Route::post('/import-students', [\App\Http\Controllers\User\UsersController::class, 'import'])->name('import.students');
        Route::get('/class-rooms', [StudentRegistrationController::class, 'get_class_rooms']);
        
        Route::resources([
             'student-registration' => \App\Http\Controllers\Student\StudentRegistrationController::class,
             'staff-registration'   => \App\Http\Controllers\staff\StaffRegistrationController::class
        ]);

    });
    //Teacher
    Route::middleware(['middleware' => 'teacher', 'as' => 'teacher'])->group(function () {

        });

    //Accountant
    Route::middleware(['middleware' => 'accountant', 'as' => 'accountant'])->group(function () {

        });

    //SuperAdmin
    Route::name('admin.')
        ->middleware('superAdmin')->group(function () {

        });

    //Library
    Route::name('library.')
        ->middleware('library')->group(function () {

        });

    //Dormitory
    Route::name('dormitory.')
        ->middleware('dormitory')->group(function () {

        });

    //Student
    Route::name('student.')
        ->middleware('student')->group(function () {

        });
});
