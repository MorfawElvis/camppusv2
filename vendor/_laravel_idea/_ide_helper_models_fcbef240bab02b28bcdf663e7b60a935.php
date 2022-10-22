<?php //5384485645f2beb11817e6b16775dd58
/** @noinspection all */

namespace App\Models {

    use Database\Factories\UserFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Database\Eloquent\Relations\MorphToMany;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Support\Carbon;
    use LaravelIdea\Helper\App\Models\_IH_ClassRoom_C;
    use LaravelIdea\Helper\App\Models\_IH_ClassRoom_QB;
    use LaravelIdea\Helper\App\Models\_IH_Department_C;
    use LaravelIdea\Helper\App\Models\_IH_Department_QB;
    use LaravelIdea\Helper\App\Models\_IH_Employee_C;
    use LaravelIdea\Helper\App\Models\_IH_Employee_QB;
    use LaravelIdea\Helper\App\Models\_IH_GeneralSetting_C;
    use LaravelIdea\Helper\App\Models\_IH_GeneralSetting_QB;
    use LaravelIdea\Helper\App\Models\_IH_Level_C;
    use LaravelIdea\Helper\App\Models\_IH_Level_QB;
    use LaravelIdea\Helper\App\Models\_IH_Role_C;
    use LaravelIdea\Helper\App\Models\_IH_Role_QB;
    use LaravelIdea\Helper\App\Models\_IH_School_Term_C;
    use LaravelIdea\Helper\App\Models\_IH_School_Term_QB;
    use LaravelIdea\Helper\App\Models\_IH_School_Year_C;
    use LaravelIdea\Helper\App\Models\_IH_School_Year_QB;
    use LaravelIdea\Helper\App\Models\_IH_Section_C;
    use LaravelIdea\Helper\App\Models\_IH_Section_QB;
    use LaravelIdea\Helper\App\Models\_IH_Student_C;
    use LaravelIdea\Helper\App\Models\_IH_Student_QB;
    use LaravelIdea\Helper\App\Models\_IH_Subject_C;
    use LaravelIdea\Helper\App\Models\_IH_Subject_QB;
    use LaravelIdea\Helper\App\Models\_IH_User_C;
    use LaravelIdea\Helper\App\Models\_IH_User_QB;
    use LaravelIdea\Helper\Illuminate\Notifications\_IH_DatabaseNotification_C;
    use LaravelIdea\Helper\Illuminate\Notifications\_IH_DatabaseNotification_QB;

    /**
     * @property int $id
     * @property string $class_name
     * @property int $level_id
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Level $level
     * @method BelongsTo|_IH_Level_QB level()
     * @method static _IH_ClassRoom_QB onWriteConnection()
     * @method _IH_ClassRoom_QB newQuery()
     * @method static _IH_ClassRoom_QB on(null|string $connection = null)
     * @method static _IH_ClassRoom_QB query()
     * @method static _IH_ClassRoom_QB with(array|string $relations)
     * @method _IH_ClassRoom_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ClassRoom_C|ClassRoom[] all()
     * @ownLinks level_id,\App\Models\Level,id
     * @mixin _IH_ClassRoom_QB
     */
    class ClassRoom extends Model {}

    /**
     * @property int $id
     * @property string $department_name
     * @property int|null $user_id
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_Subject_C|Subject[] $subjects
     * @property-read int $subjects_count
     * @method HasMany|_IH_Subject_QB subjects()
     * @property User|null $user
     * @method BelongsTo|_IH_User_QB user()
     * @method static _IH_Department_QB onWriteConnection()
     * @method _IH_Department_QB newQuery()
     * @method static _IH_Department_QB on(null|string $connection = null)
     * @method static _IH_Department_QB query()
     * @method static _IH_Department_QB with(array|string $relations)
     * @method _IH_Department_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Department_C|Department[] all()
     * @ownLinks user_id,\App\Models\User,id
     * @foreignLinks id,\App\Models\Subject,department_id
     * @mixin _IH_Department_QB
     */
    class Department extends Model {}

    /**
     * @property int $id
     * @property int $user_id
     * @property string|null $designation
     * @property Carbon $date_of_birth
     * @property string|null $place_of_birth
     * @property string $gender
     * @property string $qualification
     * @property string|null $nationality
     * @property string|null $phone_number
     * @property string|null $denomination
     * @property string|null $marital_status
     * @property Carbon $registration_date
     * @property string|null $insurance_number
     * @property string|null $category
     * @property string|null $employment_status
     * @property string|null $address
     * @property bool $is_dismissed
     * @property string|null $employee_photo
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $user
     * @method BelongsTo|_IH_User_QB user()
     * @method static _IH_Employee_QB onWriteConnection()
     * @method _IH_Employee_QB newQuery()
     * @method static _IH_Employee_QB on(null|string $connection = null)
     * @method static _IH_Employee_QB query()
     * @method static _IH_Employee_QB with(array|string $relations)
     * @method _IH_Employee_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Employee_C|Employee[] all()
     * @ownLinks user_id,\App\Models\User,id
     * @mixin _IH_Employee_QB
     */
    class Employee extends Model {}

    /**
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
     * @property-read $school_logo_path attribute
     * @method static _IH_GeneralSetting_QB onWriteConnection()
     * @method _IH_GeneralSetting_QB newQuery()
     * @method static _IH_GeneralSetting_QB on(null|string $connection = null)
     * @method static _IH_GeneralSetting_QB query()
     * @method static _IH_GeneralSetting_QB with(array|string $relations)
     * @method _IH_GeneralSetting_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_GeneralSetting_C|GeneralSetting[] all()
     * @mixin _IH_GeneralSetting_QB
     */
    class GeneralSetting extends Model {}

    /**
     * @property int $id
     * @property string $level_name
     * @property int $level_rank
     * @property int|null $section_id
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_ClassRoom_C|ClassRoom[] $class_rooms
     * @property-read int $class_rooms_count
     * @method HasMany|_IH_ClassRoom_QB class_rooms()
     * @property Section|null $section
     * @method BelongsTo|_IH_Section_QB section()
     * @method static _IH_Level_QB onWriteConnection()
     * @method _IH_Level_QB newQuery()
     * @method static _IH_Level_QB on(null|string $connection = null)
     * @method static _IH_Level_QB query()
     * @method static _IH_Level_QB with(array|string $relations)
     * @method _IH_Level_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Level_C|Level[] all()
     * @ownLinks section_id,\App\Models\Section,id
     * @foreignLinks id,\App\Models\ClassRoom,level_id
     * @mixin _IH_Level_QB
     */
    class Level extends Model {}

    /**
     * @property int $id
     * @property string $role_name
     * @property string $role_slug
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_User_C|User[] $users
     * @property-read int $users_count
     * @method HasMany|_IH_User_QB users()
     * @method static _IH_Role_QB onWriteConnection()
     * @method _IH_Role_QB newQuery()
     * @method static _IH_Role_QB on(null|string $connection = null)
     * @method static _IH_Role_QB query()
     * @method static _IH_Role_QB with(array|string $relations)
     * @method _IH_Role_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Role_C|Role[] all()
     * @foreignLinks id,\App\Models\User,role_id
     * @mixin _IH_Role_QB
     */
    class Role extends Model {}

    /**
     * @property int $id
     * @property int $school_year_id
     * @property string $term_name
     * @property string $term_status
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property School_Year $school_year
     * @method BelongsTo|_IH_School_Year_QB school_year()
     * @method static _IH_School_Term_QB onWriteConnection()
     * @method _IH_School_Term_QB newQuery()
     * @method static _IH_School_Term_QB on(null|string $connection = null)
     * @method static _IH_School_Term_QB query()
     * @method static _IH_School_Term_QB with(array|string $relations)
     * @method _IH_School_Term_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_School_Term_C|School_Term[] all()
     * @ownLinks school_year_id,\App\Models\School_Year,id
     * @mixin _IH_School_Term_QB
     */
    class School_Term extends Model {}

    /**
     * @property int $id
     * @property string $year_name
     * @property string $year_status
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_School_Term_C|School_Term[] $school_term
     * @property-read int $school_term_count
     * @method HasMany|_IH_School_Term_QB school_term()
     * @method static _IH_School_Year_QB onWriteConnection()
     * @method _IH_School_Year_QB newQuery()
     * @method static _IH_School_Year_QB on(null|string $connection = null)
     * @method static _IH_School_Year_QB query()
     * @method static _IH_School_Year_QB with(array|string $relations)
     * @method _IH_School_Year_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_School_Year_C|School_Year[] all()
     * @foreignLinks id,\App\Models\School_Term,school_year_id
     * @mixin _IH_School_Year_QB
     */
    class School_Year extends Model {}

    /**
     * @property int $id
     * @property string $section_name
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_Level_C|Level[] $levels
     * @property-read int $levels_count
     * @method HasMany|_IH_Level_QB levels()
     * @method static _IH_Section_QB onWriteConnection()
     * @method _IH_Section_QB newQuery()
     * @method static _IH_Section_QB on(null|string $connection = null)
     * @method static _IH_Section_QB query()
     * @method static _IH_Section_QB with(array|string $relations)
     * @method _IH_Section_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Section_C|Section[] all()
     * @foreignLinks id,\App\Models\Level,section_id
     * @mixin _IH_Section_QB
     */
    class Section extends Model {}

    /**
     * @property int $id
     * @property int $user_id
     * @property Carbon $date_of_birth
     * @property string|null $place_of_birth
     * @property string $gender
     * @property string $denomination
     * @property string|null $nationality
     * @property string|null $phone_number
     * @property string|null $student_category
     * @property Carbon $registration_date
     * @property string|null $address
     * @property bool $is_dismissed
     * @property string|null $student_photo
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $user
     * @method BelongsTo|_IH_User_QB user()
     * @method static _IH_Student_QB onWriteConnection()
     * @method _IH_Student_QB newQuery()
     * @method static _IH_Student_QB on(null|string $connection = null)
     * @method static _IH_Student_QB query()
     * @method static _IH_Student_QB with(array|string $relations)
     * @method _IH_Student_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Student_C|Student[] all()
     * @ownLinks user_id,\App\Models\User,id
     * @mixin _IH_Student_QB
     */
    class Student extends Model {}

    /**
     * @property int $id
     * @property string $subject_name
     * @property string|null $subject_code
     * @property int|null $department_id
     * @property Carbon|null $deleted_at
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Department|null $department
     * @method BelongsTo|_IH_Department_QB department()
     * @method static _IH_Subject_QB onWriteConnection()
     * @method _IH_Subject_QB newQuery()
     * @method static _IH_Subject_QB on(null|string $connection = null)
     * @method static _IH_Subject_QB query()
     * @method static _IH_Subject_QB with(array|string $relations)
     * @method _IH_Subject_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Subject_C|Subject[] all()
     * @ownLinks department_id,\App\Models\Department,id
     * @mixin _IH_Subject_QB
     */
    class Subject extends Model {}

    /**
     * @property int $id
     * @property int $role_id
     * @property string $name
     * @property string $user_code
     * @property string $matricule
     * @property string $user_status
     * @property string $email
     * @property Carbon|null $email_verified_at
     * @property string $password
     * @property Carbon|null $deleted_at
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Department $department
     * @method HasOne|_IH_Department_QB department()
     * @property Employee $employee
     * @method HasOne|_IH_Employee_QB employee()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $notifications
     * @property-read int $notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB notifications()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $readNotifications
     * @property-read int $read_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB readNotifications()
     * @property Role $role
     * @method BelongsTo|_IH_Role_QB role()
     * @property Student $student
     * @method HasOne|_IH_Student_QB student()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $unreadNotifications
     * @property-read int $unread_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB unreadNotifications()
     * @method static _IH_User_QB onWriteConnection()
     * @method _IH_User_QB newQuery()
     * @method static _IH_User_QB on(null|string $connection = null)
     * @method static _IH_User_QB query()
     * @method static _IH_User_QB with(array|string $relations)
     * @method _IH_User_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_User_C|User[] all()
     * @ownLinks role_id,\App\Models\Role,id
     * @foreignLinks id,\App\Models\Employee,user_id|id,\App\Models\Student,user_id|id,\App\Models\Department,user_id
     * @mixin _IH_User_QB
     * @method static UserFactory factory(array|callable|int|null $count = null, array|callable $state = [])
     */
    class User extends Model {}
}
