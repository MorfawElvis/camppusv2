<?php

use App\Http\Controllers\Dormitory\DormitoryController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Staff\StaffRegistrationController;
use App\Http\Controllers\Student\StudentRegistrationController;
use App\Http\Controllers\Timetable\TimetableController;
use App\Http\Livewire\Finance\AddExpense;
use App\Http\Livewire\Finance\ExpenseCategory;
use App\Http\Livewire\Finance\FeePayments;
use App\Http\Livewire\Finance\SchoolFeeItems;
use App\Http\Livewire\Finance\StudentFeeItems;
use App\Http\Livewire\Finance\ViewPayments;
use App\Http\Livewire\PeriodSettings;
use App\Http\Livewire\Reports\FeeCollectedReport;
use App\Http\Livewire\Scholarship\CreateScholarships;
use App\Http\Livewire\Scholarship\ManageScholarships;
use App\Http\Livewire\Settings\SchoolSettings;
use App\Http\Livewire\Staff\StaffList;
use App\Http\Livewire\Student\StudentList;
use App\Http\Livewire\StudentCategory;
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
    return view('auth.login');
});
Route::get('/users/{user}', function (User $user) {
    return $user->email;
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')
    ->middleware(['role:Admin|Bursar|Secretary|Dean|Proprietor|Principal']);

Route::middleware(['role:Admin|Bursar'])->group(function () {
    Route::group(['middleware' => 'role:Admin', 'as' => 'admin.'], function() {
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
        Route::get('/student-category', StudentCategory::class)->name('student.category');
        Route::get('/student-list', StudentList::class)->name('student.list');
        Route::get('/staff-list', StaffList::class)->name('staff.list');
        Route::get('/edit-staff/{staff_id}/{current_page}', [StaffRegistrationController::class, 'edit'])->name('edit.staff');

        Route::controller(StudentRegistrationController::class)->group(function () {
            Route::get('/class-rooms', 'get_class_rooms');
            Route::get('/student-cards', 'studentCards')->name('student.cards');
            Route::post('/generate-cards', 'generateCards')->name('generate.cards');
        });

        Route::controller(StaffRegistrationController::class)->group(function () {
            Route::get('/employee-cards', 'employeeCards')->name('employee.cards');
            Route::get('/generate-cards', 'generateEmployeeCards')->name('generate.employee.cards');
        });

        Route::resources([
            'student-registration' => \App\Http\Controllers\Student\StudentRegistrationController::class,
            'staff-registration' => \App\Http\Controllers\Staff\StaffRegistrationController::class,
        ]);

        //Staff
        Route::get('assign-subjects-to-teacher', \App\Http\Livewire\Teacher\AssignSubjectsToTeacher::class )->name('assign-subjects-to-teacher');

        //Academics
        Route::get('/manage-class-subjects', \App\Http\Livewire\Timetable\ManageClassSubjects::class)->name('manage-class-subjects');

        //Security
        Route::get('/user-roles', \App\Http\Livewire\User\UserRoles::class)->name('user-roles');
        Route::get('/manage-database', \App\Http\Livewire\Security\ManageDatabase::class)->name('manage-database');

        //Download Database Backup File
        Route::get('/download-backup/{filename}', function ($filename) {
            $file = storage_path('app/backup/' . $filename);

            if (!Storage::disk('local')->exists('backup/' . $filename)) {
                abort(404);
            }
            return Response::download($file);
        })->name('download-backup');
    });

    Route::get('/manage-fee-payments', FeePayments::class)->name('fee_payments.manage');
    Route::get('/fee-report', FeeCollectedReport::class)->name('fee.report');
    Route::get('/print-fee-report/{from}/{to}', [FinanceController::class, 'printFeeReport'])->name('print.fee-report');
    Route::get('/manage-fee-items', SchoolFeeItems::class)->name('manage-fee-items');
    Route::get('/manage-student-fee-items', StudentFeeItems::class)->name('manage-student-fee-items');
    Route::get('/school-fee-receipt/{id}', [FinanceController::class, 'printReceipt'])->name('fee.receipt');
    Route::get('/view-receipt/{id}', [FinanceController::class, 'viewReceipt'])->name('view.receipt');
    Route::get('/school-fee-statement/{id}', [FinanceController::class, 'printFeeStatement'])->name('fee.statement');
    Route::get('/bulk-fee-statement/{id}', [FinanceController::class, 'printBulkFeeStatement'])->name('bulk_fee.statement');
    Route::get('/class-fee-summary/{id}', [FinanceController::class, 'classFeeSummary'])->name('fee.summary');
    Route::get('/view-payments', ViewPayments::class)->name('view.payments');

    //Timetable
    Route::get('/time-table-settings', \App\Http\Livewire\Timetable\ManagePeriod::class)->name('time-table-settings');
    Route::get('/manage-timetable', \App\Http\Livewire\Timetable\ManageTimetable::class )->name('manage-timetable');
    Route::get('/generate-teaching-periods-pdf', [\App\Http\Controllers\Timetable\TeachingPeriodsController::class, 'generatePDF'])->name('generate-teaching-periods-pdf');
    Route::get('/timetable/{class}', [TimetableController::class, 'show'])->name('timetable.show');
    Route::get('/timetable/download/{class}', [TimetableController::class, 'download'])->name('timetable.download');

    //Scholarship Module
    Route::get('/create-scholarships', CreateScholarships::class)->name('create.scholarships');
    Route::get('/manage-scholarships', ManageScholarships::class)->name('manage.scholarships');

    //Expense Module
    Route::get('/expense-category', ExpenseCategory::class)->name('expense.category');
    Route::get('/add-expense', AddExpense::class)->name('add.expense');

    //Payroll Module
    Route::get('/payroll-configurations', \App\Http\Livewire\Payroll\PayrollConfigurations::class)->name('payroll.configurations');
    Route::get('/employee-list', \App\Http\Livewire\Payroll\EmployeeList::class)->name('payroll.employee-list');
    Route::get('/payroll-list', \App\Http\Livewire\Payroll\PayrollList::class)->name('payroll-list');

    //BookList Module
    Route::get('/manage-book-list', \App\Http\Livewire\Books\ManageBookList::class)->name('manage-book-list');

    //Facilities
    Route::get('/dormitory-management',  \App\Http\Livewire\Facilities\DormitoryManagement::class)->name('dormitory-management');
    Route::get('/dormitory/{id}/download', [DormitoryController::class, 'downloadDormitory'])->name('dormitory.download');

    //Attendance
    Route::get('/student-attendance', \App\Http\Livewire\Student\Attendance::class)->name('student-attendance');
    Route::get('/attendance-report/{classId}/{startDate}/{endDate}', [\App\Http\Controllers\Student\StudentAttendanceController::class, 'printReport'])->name('attendance.report');

});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session(['language' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
});




