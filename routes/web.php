<?php

use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Staff\StaffRegistrationController;
use App\Http\Controllers\Student\StudentRegistrationController;
use App\Http\Livewire\Finance\AddExpense;
use App\Http\Livewire\Finance\ExpenseCategory;
use App\Http\Livewire\Finance\ExtraFee;
use App\Http\Livewire\Finance\FeeItems;
use App\Http\Livewire\Finance\FeePayments;
use App\Http\Livewire\Finance\ViewPayments;
use App\Http\Livewire\Scholarship\CreateScholarships;
use App\Http\Livewire\Scholarship\ManageScholarships;
use App\Http\Livewire\Settings\SchoolSettings;
use App\Http\Livewire\Student\StudentList;
use App\Http\Livewire\Staff\StaffList;
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
        Route::get('/upload-students/{id}', [\App\Http\Controllers\User\UsersController::class, 'upLoadView'])->name('upload.students');
        Route::post('/import-students', [\App\Http\Controllers\User\UsersController::class, 'import'])->name('import.students');
        Route::get('/student-list', StudentList::class)->name('student.list');
        Route::get('/staff-list', StaffList::class)->name('staff.list');

        Route::controller(StudentRegistrationController::class)->group(function(){
            Route::get('/class-rooms', 'get_class_rooms');
            Route::get('/student-cards', 'studentCards')->name('student.cards');
            Route::post('/generate-cards', 'generateCards')->name('generate.cards');
        });

        Route::controller(StaffRegistrationController::class)->group(function(){
            Route::get('/employee-cards', 'employeeCards')->name('employee.cards');
            Route::get('/generate-cards', 'generateEmployeeCards')->name('generate.employee.cards');
        });

        Route::resources([
             'student-registration' => \App\Http\Controllers\Student\StudentRegistrationController::class,
             'staff-registration'   => \App\Http\Controllers\Staff\StaffRegistrationController::class
        ]);

    });
    //Bursar
        //Fees Module
        Route::get('/extra-fees', ExtraFee::class)->name('extra_fee.create');
        Route::get('/manage-fee-payments', FeePayments::class)->name('fee_payments.manage');
        Route::get('/manage-extra-fees', [FinanceController::class, 'managaeExtraFees'])->name('extra_fee.manage');
        Route::get('/school-fee-receipt/{id}', [FinanceController::class, 'printReceipt'])->name('fee.receipt');
        Route::get('/view-receipt/{id}', [FinanceController::class, 'viewReceipt'])->name('view.receipt');
        Route::get('/school-fee-statement/{id}', [FinanceController::class, 'printFeeStatement'])->name('fee.statement');
        Route::get('/view-payments', ViewPayments::class)->name('view.payments');
        //Scholarship Module
        Route::get('/create-scholarships', CreateScholarships::class)->name('create.scholarships');
        Route::get('/manage-scholarships', ManageScholarships::class)->name('manage.scholarships');
        //Expense Module
        Route::get('/expense-category', ExpenseCategory::class)->name('expense.category');
        Route::get('/add-expense', AddExpense::class)->name('add.expense');
});
