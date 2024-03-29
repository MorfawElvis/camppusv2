<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Allowance
 *
 * @method static create(array $validatedInput)
 * @method static paginate(int $int)
 * @method static find($deleted_allowance)
 * @method static findOrFail($deleted_allowance)
 * @property int $id
 * @property string $allowance_name
 * @property string $allowance_type
 * @property int|null $percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allowance query()
 * @mixin \Eloquent
 */
	class IdeHelperAllowance {}
}

namespace App\Models{
/**
 * App\Models\ClassRoom
 *
 * @property int $id
 * @property string $class_name
 * @property int $level_id
 * @property int $academic_year_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Level|null $level
 * @method static \Illuminate\Database\Eloquent\Builder|ClassRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassRoom newQuery()
 * @method static \Illuminate\Database\Query\Builder|ClassRoom onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassRoom query()
 * @method static \Illuminate\Database\Query\Builder|ClassRoom withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ClassRoom withoutTrashed()
 * @property int $section_id
 * @property int|null $payable_fee
 * @property-read \App\Models\SchoolYear|null $academic_year
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FeePayment> $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\Section|null $section
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @mixin \Eloquent
 */
	class IdeHelperClassRoom {}
}

namespace App\Models{
/**
 * App\Models\Deduction
 *
 * @method static paginate(int $int)
 * @method static findOrFail($deleted_allowance)
 * @method static create(array $array)
 * @property int $id
 * @property string $deduction_name
 * @property string $deduction_type
 * @property int|null $percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder|Deduction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deduction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deduction query()
 * @mixin \Eloquent
 */
	class IdeHelperDeduction {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $department_name
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Query\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Department withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperDepartment {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $full_name
 * @property int $user_id
 * @property string|null $matriculation
 * @property string $date_of_birth
 * @property string $place_of_birth
 * @property string $gender
 * @property string $highest_qualification
 * @property string|null $position
 * @property string|null $nationality
 * @property string|null $marital_status
 * @property string|null $denomination
 * @property string|null $date_of_employment
 * @property string|null $insurance_number
 * @property string|null $phone_number
 * @property string|null $address
 * @property bool $is_dismissed
 * @property int $is_retired
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Query\Builder|Employee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Query\Builder|Employee withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Employee withoutTrashed()
 * @property int|null $basic_salary
 * @property string|null $profile_image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Allowance> $allowances
 * @property-read int|null $allowances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deduction> $deductions
 * @property-read int|null $deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payroll> $payrolls
 * @property-read int|null $payrolls_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\EmployeeFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
	class IdeHelperEmployee {}
}

namespace App\Models{
/**
 * App\Models\Expense
 *
 * @property int $id
 * @property int|null $expense_category_id
 * @property int $expense_amount
 * @property string $entry_date
 * @property string|null $expense_description
 * @property int $enteredBy_id
 * @property int|null $approvedBy_id
 * @property int|null $is_approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $expense_item
 * @property-read \App\Models\ExpenseCategory|null $expense_category
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperExpense {}
}

namespace App\Models{
/**
 * App\Models\ExpenseCategory
 *
 * @property int $id
 * @property string $category_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Expense> $expenses
 * @property-read int|null $expenses_count
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperExpenseCategory {}
}

namespace App\Models{
/**
 * App\Models\ExtraFee
 *
 * @property int $id
 * @property string $fee_type
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|ExtraFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExtraFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExtraFee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExtraFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExtraFee withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExtraFee withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperExtraFee {}
}

namespace App\Models{
/**
 * App\Models\FeePayment
 *
 * @property int $id
 * @property int $student_id
 * @property string $transaction_date
 * @property int $amount
 * @property string $payment_mode
 * @property int|null $user_id
 * @property string|null $receipt_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Student|null $student
 * @method static \Illuminate\Database\Eloquent\Builder|FeePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeePayment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FeePayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|FeePayment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FeePayment withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperFeePayment {}
}

namespace App\Models{
/**
 * App\Models\GeneralSetting
 *
 * @property int $id
 * @property string|null $school_name
 * @property string|null $school_address
 * @property string|null $school_po_box
 * @property string|null $school_email
 * @property string|null $school_website
 * @property string|null $school_phone_number
 * @property string|null $school_logo
 * @property bool|null $collapsed_sidebar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $school_logo_path
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting query()
 * @property int|null $boarding_fee
 * @mixin \Eloquent
 */
	class IdeHelperGeneralSetting {}
}

namespace App\Models{
/**
 * App\Models\Level
 *
 * @property int $id
 * @property string $level_name
 * @property int $level_rank
 * @property int $section_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassRoom[] $class_rooms
 * @property-read int|null $class_rooms_count
 * @property-read \App\Models\Section|null $section
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Query\Builder|Level onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Query\Builder|Level withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Level withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperLevel {}
}

namespace App\Models{
/**
 * App\Models\Payroll
 *
 * @property int $id
 * @property string $month
 * @property string $year
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employee> $employees
 * @property-read int|null $employees_count
 * @method static \Database\Factories\PayrollFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payroll withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperPayroll {}
}

namespace App\Models{
/**
 * App\Models\PayrollRecord
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PayrollRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayrollRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayrollRecord query()
 * @mixin \Eloquent
 */
	class IdeHelperPayrollRecord {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $role_name
 * @property string $role_slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * App\Models\Scholarship
 *
 * @property int $id
 * @property int $student_id
 * @property int $school_year_id
 * @property int $scholarship_category_id
 * @property int $renewable
 * @property int|null $is_approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ScholarshipCategory|null $scholarship_category
 * @property-read \App\Models\SchoolYear|null $school_year
 * @property-read \App\Models\Student|null $student
 * @method static \Illuminate\Database\Eloquent\Builder|Scholarship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Scholarship newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Scholarship onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Scholarship query()
 * @method static \Illuminate\Database\Eloquent\Builder|Scholarship withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Scholarship withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperScholarship {}
}

namespace App\Models{
/**
 * App\Models\ScholarshipCategory
 *
 * @property int $id
 * @property string $scholarship_name
 * @property string $scholarship_category
 * @property int|null $discount
 * @property string $scholarship_coverage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Scholarship> $scholarships
 * @property-read int|null $scholarships_count
 * @method static \Illuminate\Database\Eloquent\Builder|ScholarshipCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScholarshipCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScholarshipCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScholarshipCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScholarshipCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ScholarshipCategory withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperScholarshipCategory {}
}

namespace App\Models{
/**
 * App\Models\SchoolTerm
 *
 * @property int $id
 * @property int $school_year_id
 * @property string $term_name
 * @property string $term_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SchoolYear|null $school_year
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTerm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTerm newQuery()
 * @method static \Illuminate\Database\Query\Builder|SchoolTerm onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTerm query()
 * @method static \Illuminate\Database\Query\Builder|SchoolTerm withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SchoolTerm withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperSchoolTerm {}
}

namespace App\Models{
/**
 * App\Models\SchoolYear
 *
 * @property int $id
 * @property string $year_name
 * @property string $year_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SchoolTerm[] $school_term
 * @property-read int|null $school_term_count
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear newQuery()
 * @method static \Illuminate\Database\Query\Builder|SchoolYear onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear query()
 * @method static \Illuminate\Database\Query\Builder|SchoolYear withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SchoolYear withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClassRoom> $class_rooms
 * @property-read int|null $class_rooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Scholarship> $scholarships
 * @property-read int|null $scholarships_count
 * @mixin \Eloquent
 */
	class IdeHelperSchoolYear {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $section_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Query\Builder|Section onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Query\Builder|Section withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Section withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClassRoom> $class_rooms
 * @property-read int|null $class_rooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @mixin \Eloquent
 */
	class IdeHelperSection {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $full_name
 * @property int $user_id
 * @property string|null $matriculation
 * @property int $class_room_id
 * @property string $date_of_birth
 * @property string $place_of_birth
 * @property string $gender
 * @property string|null $nationality
 * @property string|null $denomination
 * @property string|null $date_of_admission
 * @property string|null $phone_number
 * @property string|null $address
 * @property bool $is_dismissed
 * @property bool $is_graduated
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @property string|null $profile_image
 * @property int $is_boarding
 * @property-read \App\Models\ClassRoom|null $class_room
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExtraFee> $extra_fees
 * @property-read int|null $extra_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FeePayment> $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\Scholarship|null $scholarship
 * @property-read \App\Models\StudentCategory|null $student_category
 * @mixin \Eloquent
 */
	class IdeHelperStudent {}
}

namespace App\Models{
/**
 * App\Models\StudentCategory
 *
 * @property-write mixed $category_fee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|StudentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentCategory withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperStudentCategory {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $subject_name
 * @property string|null $subject_code
 * @property int|null $department_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department|null $department
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Query\Builder|Subject withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subject withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperSubject {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $role_id
 * @property string $user_code
 * @property string $user_status
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Employee|null $employee
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @property-read \App\Models\Student|null $student
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

