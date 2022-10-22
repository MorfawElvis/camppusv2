<?php //bb114efa631aee9d3cfe7ea4e0eb3c86
/** @noinspection all */

namespace LaravelIdea\Helper\App\Models {

    use App\Models\ClassRoom;
    use App\Models\Department;
    use App\Models\Employee;
    use App\Models\GeneralSetting;
    use App\Models\Level;
    use App\Models\Role;
    use App\Models\School_Term;
    use App\Models\School_Year;
    use App\Models\Section;
    use App\Models\Student;
    use App\Models\Subject;
    use App\Models\User;
    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;

    /**
     * @method ClassRoom|null getOrPut($key, $value)
     * @method ClassRoom|$this shift(int $count = 1)
     * @method ClassRoom|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method ClassRoom|$this pop(int $count = 1)
     * @method ClassRoom|null pull($key, \Closure $default = null)
     * @method ClassRoom|null last(callable $callback = null, \Closure $default = null)
     * @method ClassRoom|$this random(int|null $number = null)
     * @method ClassRoom|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method ClassRoom|null get($key, \Closure $default = null)
     * @method ClassRoom|null first(callable $callback = null, \Closure $default = null)
     * @method ClassRoom|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method ClassRoom|null find($key, $default = null)
     * @method ClassRoom[] all()
     */
    class _IH_ClassRoom_C extends _BaseCollection {
        /**
         * @param int $size
         * @return ClassRoom[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_ClassRoom_QB whereId($value)
     * @method _IH_ClassRoom_QB whereClassName($value)
     * @method _IH_ClassRoom_QB whereLevelId($value)
     * @method _IH_ClassRoom_QB whereDeletedAt($value)
     * @method _IH_ClassRoom_QB whereCreatedAt($value)
     * @method _IH_ClassRoom_QB whereUpdatedAt($value)
     * @method ClassRoom baseSole(array|string $columns = ['*'])
     * @method ClassRoom create(array $attributes = [])
     * @method _IH_ClassRoom_C|ClassRoom[] cursor()
     * @method ClassRoom|null|_IH_ClassRoom_C|ClassRoom[] find($id, array|string $columns = ['*'])
     * @method _IH_ClassRoom_C|ClassRoom[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method ClassRoom|_IH_ClassRoom_C|ClassRoom[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method ClassRoom|_IH_ClassRoom_C|ClassRoom[] findOrFail($id, array|string $columns = ['*'])
     * @method ClassRoom|_IH_ClassRoom_C|ClassRoom[] findOrNew($id, array|string $columns = ['*'])
     * @method ClassRoom first(array|string $columns = ['*'])
     * @method ClassRoom firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method ClassRoom firstOrCreate(array $attributes = [], array $values = [])
     * @method ClassRoom firstOrFail(array|string $columns = ['*'])
     * @method ClassRoom firstOrNew(array $attributes = [], array $values = [])
     * @method ClassRoom firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method ClassRoom forceCreate(array $attributes)
     * @method _IH_ClassRoom_C|ClassRoom[] fromQuery(string $query, array $bindings = [])
     * @method _IH_ClassRoom_C|ClassRoom[] get(array|string $columns = ['*'])
     * @method ClassRoom getModel()
     * @method ClassRoom[] getModels(array|string $columns = ['*'])
     * @method _IH_ClassRoom_C|ClassRoom[] hydrate(array $items)
     * @method ClassRoom make(array $attributes = [])
     * @method ClassRoom newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|ClassRoom[]|_IH_ClassRoom_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|ClassRoom[]|_IH_ClassRoom_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method ClassRoom sole(array|string $columns = ['*'])
     * @method ClassRoom updateOrCreate(array $attributes, array $values = [])
     * @method _IH_ClassRoom_QB withTrashed()
     * @method _IH_ClassRoom_QB onlyTrashed()
     * @method _IH_ClassRoom_QB withoutTrashed()
     * @method _IH_ClassRoom_QB restore()
     */
    class _IH_ClassRoom_QB extends _BaseBuilder {}

    /**
     * @method Department|null getOrPut($key, $value)
     * @method Department|$this shift(int $count = 1)
     * @method Department|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Department|$this pop(int $count = 1)
     * @method Department|null pull($key, \Closure $default = null)
     * @method Department|null last(callable $callback = null, \Closure $default = null)
     * @method Department|$this random(int|null $number = null)
     * @method Department|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Department|null get($key, \Closure $default = null)
     * @method Department|null first(callable $callback = null, \Closure $default = null)
     * @method Department|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Department|null find($key, $default = null)
     * @method Department[] all()
     */
    class _IH_Department_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Department[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Department_QB whereId($value)
     * @method _IH_Department_QB whereDepartmentName($value)
     * @method _IH_Department_QB whereUserId($value)
     * @method _IH_Department_QB whereDeletedAt($value)
     * @method _IH_Department_QB whereCreatedAt($value)
     * @method _IH_Department_QB whereUpdatedAt($value)
     * @method Department baseSole(array|string $columns = ['*'])
     * @method Department create(array $attributes = [])
     * @method _IH_Department_C|Department[] cursor()
     * @method Department|null|_IH_Department_C|Department[] find($id, array|string $columns = ['*'])
     * @method _IH_Department_C|Department[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Department|_IH_Department_C|Department[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Department|_IH_Department_C|Department[] findOrFail($id, array|string $columns = ['*'])
     * @method Department|_IH_Department_C|Department[] findOrNew($id, array|string $columns = ['*'])
     * @method Department first(array|string $columns = ['*'])
     * @method Department firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Department firstOrCreate(array $attributes = [], array $values = [])
     * @method Department firstOrFail(array|string $columns = ['*'])
     * @method Department firstOrNew(array $attributes = [], array $values = [])
     * @method Department firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Department forceCreate(array $attributes)
     * @method _IH_Department_C|Department[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Department_C|Department[] get(array|string $columns = ['*'])
     * @method Department getModel()
     * @method Department[] getModels(array|string $columns = ['*'])
     * @method _IH_Department_C|Department[] hydrate(array $items)
     * @method Department make(array $attributes = [])
     * @method Department newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Department[]|_IH_Department_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Department[]|_IH_Department_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Department sole(array|string $columns = ['*'])
     * @method Department updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Department_QB withTrashed()
     * @method _IH_Department_QB onlyTrashed()
     * @method _IH_Department_QB withoutTrashed()
     * @method _IH_Department_QB restore()
     */
    class _IH_Department_QB extends _BaseBuilder {}

    /**
     * @method Employee|null getOrPut($key, $value)
     * @method Employee|$this shift(int $count = 1)
     * @method Employee|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Employee|$this pop(int $count = 1)
     * @method Employee|null pull($key, \Closure $default = null)
     * @method Employee|null last(callable $callback = null, \Closure $default = null)
     * @method Employee|$this random(int|null $number = null)
     * @method Employee|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Employee|null get($key, \Closure $default = null)
     * @method Employee|null first(callable $callback = null, \Closure $default = null)
     * @method Employee|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Employee|null find($key, $default = null)
     * @method Employee[] all()
     */
    class _IH_Employee_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Employee[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Employee_QB whereId($value)
     * @method _IH_Employee_QB whereUserId($value)
     * @method _IH_Employee_QB whereDesignation($value)
     * @method _IH_Employee_QB whereDateOfBirth($value)
     * @method _IH_Employee_QB wherePlaceOfBirth($value)
     * @method _IH_Employee_QB whereGender($value)
     * @method _IH_Employee_QB whereQualification($value)
     * @method _IH_Employee_QB whereNationality($value)
     * @method _IH_Employee_QB wherePhoneNumber($value)
     * @method _IH_Employee_QB whereDenomination($value)
     * @method _IH_Employee_QB whereMaritalStatus($value)
     * @method _IH_Employee_QB whereRegistrationDate($value)
     * @method _IH_Employee_QB whereInsuranceNumber($value)
     * @method _IH_Employee_QB whereCategory($value)
     * @method _IH_Employee_QB whereEmploymentStatus($value)
     * @method _IH_Employee_QB whereAddress($value)
     * @method _IH_Employee_QB whereIsDismissed($value)
     * @method _IH_Employee_QB whereEmployeePhoto($value)
     * @method _IH_Employee_QB whereDeletedAt($value)
     * @method _IH_Employee_QB whereCreatedAt($value)
     * @method _IH_Employee_QB whereUpdatedAt($value)
     * @method Employee baseSole(array|string $columns = ['*'])
     * @method Employee create(array $attributes = [])
     * @method _IH_Employee_C|Employee[] cursor()
     * @method Employee|null|_IH_Employee_C|Employee[] find($id, array|string $columns = ['*'])
     * @method _IH_Employee_C|Employee[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Employee|_IH_Employee_C|Employee[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Employee|_IH_Employee_C|Employee[] findOrFail($id, array|string $columns = ['*'])
     * @method Employee|_IH_Employee_C|Employee[] findOrNew($id, array|string $columns = ['*'])
     * @method Employee first(array|string $columns = ['*'])
     * @method Employee firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Employee firstOrCreate(array $attributes = [], array $values = [])
     * @method Employee firstOrFail(array|string $columns = ['*'])
     * @method Employee firstOrNew(array $attributes = [], array $values = [])
     * @method Employee firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Employee forceCreate(array $attributes)
     * @method _IH_Employee_C|Employee[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Employee_C|Employee[] get(array|string $columns = ['*'])
     * @method Employee getModel()
     * @method Employee[] getModels(array|string $columns = ['*'])
     * @method _IH_Employee_C|Employee[] hydrate(array $items)
     * @method Employee make(array $attributes = [])
     * @method Employee newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Employee[]|_IH_Employee_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Employee[]|_IH_Employee_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Employee sole(array|string $columns = ['*'])
     * @method Employee updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Employee_QB extends _BaseBuilder {}

    /**
     * @method GeneralSetting|null getOrPut($key, $value)
     * @method GeneralSetting|$this shift(int $count = 1)
     * @method GeneralSetting|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method GeneralSetting|$this pop(int $count = 1)
     * @method GeneralSetting|null pull($key, \Closure $default = null)
     * @method GeneralSetting|null last(callable $callback = null, \Closure $default = null)
     * @method GeneralSetting|$this random(int|null $number = null)
     * @method GeneralSetting|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method GeneralSetting|null get($key, \Closure $default = null)
     * @method GeneralSetting|null first(callable $callback = null, \Closure $default = null)
     * @method GeneralSetting|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method GeneralSetting|null find($key, $default = null)
     * @method GeneralSetting[] all()
     */
    class _IH_GeneralSetting_C extends _BaseCollection {
        /**
         * @param int $size
         * @return GeneralSetting[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_GeneralSetting_QB whereId($value)
     * @method _IH_GeneralSetting_QB whereSchoolName($value)
     * @method _IH_GeneralSetting_QB whereSchoolAddress($value)
     * @method _IH_GeneralSetting_QB whereSchoolPoBox($value)
     * @method _IH_GeneralSetting_QB whereSchoolEmail($value)
     * @method _IH_GeneralSetting_QB whereSchoolWebsite($value)
     * @method _IH_GeneralSetting_QB whereSchoolPhoneNumber($value)
     * @method _IH_GeneralSetting_QB whereSchoolLogo($value)
     * @method _IH_GeneralSetting_QB whereCollapsedSidebar($value)
     * @method _IH_GeneralSetting_QB whereCreatedAt($value)
     * @method _IH_GeneralSetting_QB whereUpdatedAt($value)
     * @method GeneralSetting baseSole(array|string $columns = ['*'])
     * @method GeneralSetting create(array $attributes = [])
     * @method _IH_GeneralSetting_C|GeneralSetting[] cursor()
     * @method GeneralSetting|null|_IH_GeneralSetting_C|GeneralSetting[] find($id, array|string $columns = ['*'])
     * @method _IH_GeneralSetting_C|GeneralSetting[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method GeneralSetting|_IH_GeneralSetting_C|GeneralSetting[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method GeneralSetting|_IH_GeneralSetting_C|GeneralSetting[] findOrFail($id, array|string $columns = ['*'])
     * @method GeneralSetting|_IH_GeneralSetting_C|GeneralSetting[] findOrNew($id, array|string $columns = ['*'])
     * @method GeneralSetting first(array|string $columns = ['*'])
     * @method GeneralSetting firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method GeneralSetting firstOrCreate(array $attributes = [], array $values = [])
     * @method GeneralSetting firstOrFail(array|string $columns = ['*'])
     * @method GeneralSetting firstOrNew(array $attributes = [], array $values = [])
     * @method GeneralSetting firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method GeneralSetting forceCreate(array $attributes)
     * @method _IH_GeneralSetting_C|GeneralSetting[] fromQuery(string $query, array $bindings = [])
     * @method _IH_GeneralSetting_C|GeneralSetting[] get(array|string $columns = ['*'])
     * @method GeneralSetting getModel()
     * @method GeneralSetting[] getModels(array|string $columns = ['*'])
     * @method _IH_GeneralSetting_C|GeneralSetting[] hydrate(array $items)
     * @method GeneralSetting make(array $attributes = [])
     * @method GeneralSetting newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|GeneralSetting[]|_IH_GeneralSetting_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|GeneralSetting[]|_IH_GeneralSetting_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method GeneralSetting sole(array|string $columns = ['*'])
     * @method GeneralSetting updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_GeneralSetting_QB extends _BaseBuilder {}

    /**
     * @method Level|null getOrPut($key, $value)
     * @method Level|$this shift(int $count = 1)
     * @method Level|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Level|$this pop(int $count = 1)
     * @method Level|null pull($key, \Closure $default = null)
     * @method Level|null last(callable $callback = null, \Closure $default = null)
     * @method Level|$this random(int|null $number = null)
     * @method Level|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Level|null get($key, \Closure $default = null)
     * @method Level|null first(callable $callback = null, \Closure $default = null)
     * @method Level|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Level|null find($key, $default = null)
     * @method Level[] all()
     */
    class _IH_Level_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Level[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Level_QB whereId($value)
     * @method _IH_Level_QB whereLevelName($value)
     * @method _IH_Level_QB whereLevelRank($value)
     * @method _IH_Level_QB whereSectionId($value)
     * @method _IH_Level_QB whereDeletedAt($value)
     * @method _IH_Level_QB whereCreatedAt($value)
     * @method _IH_Level_QB whereUpdatedAt($value)
     * @method Level baseSole(array|string $columns = ['*'])
     * @method Level create(array $attributes = [])
     * @method _IH_Level_C|Level[] cursor()
     * @method Level|null|_IH_Level_C|Level[] find($id, array|string $columns = ['*'])
     * @method _IH_Level_C|Level[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Level|_IH_Level_C|Level[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Level|_IH_Level_C|Level[] findOrFail($id, array|string $columns = ['*'])
     * @method Level|_IH_Level_C|Level[] findOrNew($id, array|string $columns = ['*'])
     * @method Level first(array|string $columns = ['*'])
     * @method Level firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Level firstOrCreate(array $attributes = [], array $values = [])
     * @method Level firstOrFail(array|string $columns = ['*'])
     * @method Level firstOrNew(array $attributes = [], array $values = [])
     * @method Level firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Level forceCreate(array $attributes)
     * @method _IH_Level_C|Level[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Level_C|Level[] get(array|string $columns = ['*'])
     * @method Level getModel()
     * @method Level[] getModels(array|string $columns = ['*'])
     * @method _IH_Level_C|Level[] hydrate(array $items)
     * @method Level make(array $attributes = [])
     * @method Level newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Level[]|_IH_Level_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Level[]|_IH_Level_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Level sole(array|string $columns = ['*'])
     * @method Level updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Level_QB withTrashed()
     * @method _IH_Level_QB onlyTrashed()
     * @method _IH_Level_QB withoutTrashed()
     * @method _IH_Level_QB restore()
     */
    class _IH_Level_QB extends _BaseBuilder {}

    /**
     * @method Role|null getOrPut($key, $value)
     * @method Role|$this shift(int $count = 1)
     * @method Role|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Role|$this pop(int $count = 1)
     * @method Role|null pull($key, \Closure $default = null)
     * @method Role|null last(callable $callback = null, \Closure $default = null)
     * @method Role|$this random(int|null $number = null)
     * @method Role|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Role|null get($key, \Closure $default = null)
     * @method Role|null first(callable $callback = null, \Closure $default = null)
     * @method Role|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Role|null find($key, $default = null)
     * @method Role[] all()
     */
    class _IH_Role_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Role[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Role_QB whereId($value)
     * @method _IH_Role_QB whereRoleName($value)
     * @method _IH_Role_QB whereRoleSlug($value)
     * @method _IH_Role_QB whereDeletedAt($value)
     * @method _IH_Role_QB whereCreatedAt($value)
     * @method _IH_Role_QB whereUpdatedAt($value)
     * @method Role baseSole(array|string $columns = ['*'])
     * @method Role create(array $attributes = [])
     * @method _IH_Role_C|Role[] cursor()
     * @method Role|null|_IH_Role_C|Role[] find($id, array|string $columns = ['*'])
     * @method _IH_Role_C|Role[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Role|_IH_Role_C|Role[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Role|_IH_Role_C|Role[] findOrFail($id, array|string $columns = ['*'])
     * @method Role|_IH_Role_C|Role[] findOrNew($id, array|string $columns = ['*'])
     * @method Role first(array|string $columns = ['*'])
     * @method Role firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Role firstOrCreate(array $attributes = [], array $values = [])
     * @method Role firstOrFail(array|string $columns = ['*'])
     * @method Role firstOrNew(array $attributes = [], array $values = [])
     * @method Role firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Role forceCreate(array $attributes)
     * @method _IH_Role_C|Role[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Role_C|Role[] get(array|string $columns = ['*'])
     * @method Role getModel()
     * @method Role[] getModels(array|string $columns = ['*'])
     * @method _IH_Role_C|Role[] hydrate(array $items)
     * @method Role make(array $attributes = [])
     * @method Role newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Role[]|_IH_Role_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Role[]|_IH_Role_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Role sole(array|string $columns = ['*'])
     * @method Role updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Role_QB withTrashed()
     * @method _IH_Role_QB onlyTrashed()
     * @method _IH_Role_QB withoutTrashed()
     * @method _IH_Role_QB restore()
     */
    class _IH_Role_QB extends _BaseBuilder {}

    /**
     * @method School_Term|null getOrPut($key, $value)
     * @method School_Term|$this shift(int $count = 1)
     * @method School_Term|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method School_Term|$this pop(int $count = 1)
     * @method School_Term|null pull($key, \Closure $default = null)
     * @method School_Term|null last(callable $callback = null, \Closure $default = null)
     * @method School_Term|$this random(int|null $number = null)
     * @method School_Term|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method School_Term|null get($key, \Closure $default = null)
     * @method School_Term|null first(callable $callback = null, \Closure $default = null)
     * @method School_Term|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method School_Term|null find($key, $default = null)
     * @method School_Term[] all()
     */
    class _IH_School_Term_C extends _BaseCollection {
        /**
         * @param int $size
         * @return School_Term[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_School_Term_QB whereId($value)
     * @method _IH_School_Term_QB whereSchoolYearId($value)
     * @method _IH_School_Term_QB whereTermName($value)
     * @method _IH_School_Term_QB whereTermStatus($value)
     * @method _IH_School_Term_QB whereDeletedAt($value)
     * @method _IH_School_Term_QB whereCreatedAt($value)
     * @method _IH_School_Term_QB whereUpdatedAt($value)
     * @method School_Term baseSole(array|string $columns = ['*'])
     * @method School_Term create(array $attributes = [])
     * @method _IH_School_Term_C|School_Term[] cursor()
     * @method School_Term|null|_IH_School_Term_C|School_Term[] find($id, array|string $columns = ['*'])
     * @method _IH_School_Term_C|School_Term[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method School_Term|_IH_School_Term_C|School_Term[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method School_Term|_IH_School_Term_C|School_Term[] findOrFail($id, array|string $columns = ['*'])
     * @method School_Term|_IH_School_Term_C|School_Term[] findOrNew($id, array|string $columns = ['*'])
     * @method School_Term first(array|string $columns = ['*'])
     * @method School_Term firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method School_Term firstOrCreate(array $attributes = [], array $values = [])
     * @method School_Term firstOrFail(array|string $columns = ['*'])
     * @method School_Term firstOrNew(array $attributes = [], array $values = [])
     * @method School_Term firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method School_Term forceCreate(array $attributes)
     * @method _IH_School_Term_C|School_Term[] fromQuery(string $query, array $bindings = [])
     * @method _IH_School_Term_C|School_Term[] get(array|string $columns = ['*'])
     * @method School_Term getModel()
     * @method School_Term[] getModels(array|string $columns = ['*'])
     * @method _IH_School_Term_C|School_Term[] hydrate(array $items)
     * @method School_Term make(array $attributes = [])
     * @method School_Term newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|School_Term[]|_IH_School_Term_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|School_Term[]|_IH_School_Term_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method School_Term sole(array|string $columns = ['*'])
     * @method School_Term updateOrCreate(array $attributes, array $values = [])
     * @method _IH_School_Term_QB withTrashed()
     * @method _IH_School_Term_QB onlyTrashed()
     * @method _IH_School_Term_QB withoutTrashed()
     * @method _IH_School_Term_QB restore()
     */
    class _IH_School_Term_QB extends _BaseBuilder {}

    /**
     * @method School_Year|null getOrPut($key, $value)
     * @method School_Year|$this shift(int $count = 1)
     * @method School_Year|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method School_Year|$this pop(int $count = 1)
     * @method School_Year|null pull($key, \Closure $default = null)
     * @method School_Year|null last(callable $callback = null, \Closure $default = null)
     * @method School_Year|$this random(int|null $number = null)
     * @method School_Year|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method School_Year|null get($key, \Closure $default = null)
     * @method School_Year|null first(callable $callback = null, \Closure $default = null)
     * @method School_Year|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method School_Year|null find($key, $default = null)
     * @method School_Year[] all()
     */
    class _IH_School_Year_C extends _BaseCollection {
        /**
         * @param int $size
         * @return School_Year[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_School_Year_QB whereId($value)
     * @method _IH_School_Year_QB whereYearName($value)
     * @method _IH_School_Year_QB whereYearStatus($value)
     * @method _IH_School_Year_QB whereDeletedAt($value)
     * @method _IH_School_Year_QB whereCreatedAt($value)
     * @method _IH_School_Year_QB whereUpdatedAt($value)
     * @method School_Year baseSole(array|string $columns = ['*'])
     * @method School_Year create(array $attributes = [])
     * @method _IH_School_Year_C|School_Year[] cursor()
     * @method School_Year|null|_IH_School_Year_C|School_Year[] find($id, array|string $columns = ['*'])
     * @method _IH_School_Year_C|School_Year[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method School_Year|_IH_School_Year_C|School_Year[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method School_Year|_IH_School_Year_C|School_Year[] findOrFail($id, array|string $columns = ['*'])
     * @method School_Year|_IH_School_Year_C|School_Year[] findOrNew($id, array|string $columns = ['*'])
     * @method School_Year first(array|string $columns = ['*'])
     * @method School_Year firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method School_Year firstOrCreate(array $attributes = [], array $values = [])
     * @method School_Year firstOrFail(array|string $columns = ['*'])
     * @method School_Year firstOrNew(array $attributes = [], array $values = [])
     * @method School_Year firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method School_Year forceCreate(array $attributes)
     * @method _IH_School_Year_C|School_Year[] fromQuery(string $query, array $bindings = [])
     * @method _IH_School_Year_C|School_Year[] get(array|string $columns = ['*'])
     * @method School_Year getModel()
     * @method School_Year[] getModels(array|string $columns = ['*'])
     * @method _IH_School_Year_C|School_Year[] hydrate(array $items)
     * @method School_Year make(array $attributes = [])
     * @method School_Year newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|School_Year[]|_IH_School_Year_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|School_Year[]|_IH_School_Year_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method School_Year sole(array|string $columns = ['*'])
     * @method School_Year updateOrCreate(array $attributes, array $values = [])
     * @method _IH_School_Year_QB withTrashed()
     * @method _IH_School_Year_QB onlyTrashed()
     * @method _IH_School_Year_QB withoutTrashed()
     * @method _IH_School_Year_QB restore()
     */
    class _IH_School_Year_QB extends _BaseBuilder {}

    /**
     * @method Section|null getOrPut($key, $value)
     * @method Section|$this shift(int $count = 1)
     * @method Section|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Section|$this pop(int $count = 1)
     * @method Section|null pull($key, \Closure $default = null)
     * @method Section|null last(callable $callback = null, \Closure $default = null)
     * @method Section|$this random(int|null $number = null)
     * @method Section|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Section|null get($key, \Closure $default = null)
     * @method Section|null first(callable $callback = null, \Closure $default = null)
     * @method Section|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Section|null find($key, $default = null)
     * @method Section[] all()
     */
    class _IH_Section_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Section[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Section_QB whereId($value)
     * @method _IH_Section_QB whereSectionName($value)
     * @method _IH_Section_QB whereDeletedAt($value)
     * @method _IH_Section_QB whereCreatedAt($value)
     * @method _IH_Section_QB whereUpdatedAt($value)
     * @method Section baseSole(array|string $columns = ['*'])
     * @method Section create(array $attributes = [])
     * @method _IH_Section_C|Section[] cursor()
     * @method Section|null|_IH_Section_C|Section[] find($id, array|string $columns = ['*'])
     * @method _IH_Section_C|Section[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Section|_IH_Section_C|Section[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Section|_IH_Section_C|Section[] findOrFail($id, array|string $columns = ['*'])
     * @method Section|_IH_Section_C|Section[] findOrNew($id, array|string $columns = ['*'])
     * @method Section first(array|string $columns = ['*'])
     * @method Section firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Section firstOrCreate(array $attributes = [], array $values = [])
     * @method Section firstOrFail(array|string $columns = ['*'])
     * @method Section firstOrNew(array $attributes = [], array $values = [])
     * @method Section firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Section forceCreate(array $attributes)
     * @method _IH_Section_C|Section[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Section_C|Section[] get(array|string $columns = ['*'])
     * @method Section getModel()
     * @method Section[] getModels(array|string $columns = ['*'])
     * @method _IH_Section_C|Section[] hydrate(array $items)
     * @method Section make(array $attributes = [])
     * @method Section newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Section[]|_IH_Section_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Section[]|_IH_Section_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Section sole(array|string $columns = ['*'])
     * @method Section updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Section_QB withTrashed()
     * @method _IH_Section_QB onlyTrashed()
     * @method _IH_Section_QB withoutTrashed()
     * @method _IH_Section_QB restore()
     */
    class _IH_Section_QB extends _BaseBuilder {}

    /**
     * @method Student|null getOrPut($key, $value)
     * @method Student|$this shift(int $count = 1)
     * @method Student|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Student|$this pop(int $count = 1)
     * @method Student|null pull($key, \Closure $default = null)
     * @method Student|null last(callable $callback = null, \Closure $default = null)
     * @method Student|$this random(int|null $number = null)
     * @method Student|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Student|null get($key, \Closure $default = null)
     * @method Student|null first(callable $callback = null, \Closure $default = null)
     * @method Student|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Student|null find($key, $default = null)
     * @method Student[] all()
     */
    class _IH_Student_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Student[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Student_QB whereId($value)
     * @method _IH_Student_QB whereUserId($value)
     * @method _IH_Student_QB whereDateOfBirth($value)
     * @method _IH_Student_QB wherePlaceOfBirth($value)
     * @method _IH_Student_QB whereGender($value)
     * @method _IH_Student_QB whereDenomination($value)
     * @method _IH_Student_QB whereNationality($value)
     * @method _IH_Student_QB wherePhoneNumber($value)
     * @method _IH_Student_QB whereStudentCategory($value)
     * @method _IH_Student_QB whereRegistrationDate($value)
     * @method _IH_Student_QB whereAddress($value)
     * @method _IH_Student_QB whereIsDismissed($value)
     * @method _IH_Student_QB whereStudentPhoto($value)
     * @method _IH_Student_QB whereDeletedAt($value)
     * @method _IH_Student_QB whereCreatedAt($value)
     * @method _IH_Student_QB whereUpdatedAt($value)
     * @method Student baseSole(array|string $columns = ['*'])
     * @method Student create(array $attributes = [])
     * @method _IH_Student_C|Student[] cursor()
     * @method Student|null|_IH_Student_C|Student[] find($id, array|string $columns = ['*'])
     * @method _IH_Student_C|Student[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Student|_IH_Student_C|Student[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Student|_IH_Student_C|Student[] findOrFail($id, array|string $columns = ['*'])
     * @method Student|_IH_Student_C|Student[] findOrNew($id, array|string $columns = ['*'])
     * @method Student first(array|string $columns = ['*'])
     * @method Student firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Student firstOrCreate(array $attributes = [], array $values = [])
     * @method Student firstOrFail(array|string $columns = ['*'])
     * @method Student firstOrNew(array $attributes = [], array $values = [])
     * @method Student firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Student forceCreate(array $attributes)
     * @method _IH_Student_C|Student[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Student_C|Student[] get(array|string $columns = ['*'])
     * @method Student getModel()
     * @method Student[] getModels(array|string $columns = ['*'])
     * @method _IH_Student_C|Student[] hydrate(array $items)
     * @method Student make(array $attributes = [])
     * @method Student newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Student[]|_IH_Student_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Student[]|_IH_Student_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Student sole(array|string $columns = ['*'])
     * @method Student updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Student_QB extends _BaseBuilder {}

    /**
     * @method Subject|null getOrPut($key, $value)
     * @method Subject|$this shift(int $count = 1)
     * @method Subject|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method Subject|$this pop(int $count = 1)
     * @method Subject|null pull($key, \Closure $default = null)
     * @method Subject|null last(callable $callback = null, \Closure $default = null)
     * @method Subject|$this random(int|null $number = null)
     * @method Subject|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method Subject|null get($key, \Closure $default = null)
     * @method Subject|null first(callable $callback = null, \Closure $default = null)
     * @method Subject|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method Subject|null find($key, $default = null)
     * @method Subject[] all()
     */
    class _IH_Subject_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Subject[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_Subject_QB whereId($value)
     * @method _IH_Subject_QB whereSubjectName($value)
     * @method _IH_Subject_QB whereSubjectCode($value)
     * @method _IH_Subject_QB whereDepartmentId($value)
     * @method _IH_Subject_QB whereDeletedAt($value)
     * @method _IH_Subject_QB whereCreatedAt($value)
     * @method _IH_Subject_QB whereUpdatedAt($value)
     * @method Subject baseSole(array|string $columns = ['*'])
     * @method Subject create(array $attributes = [])
     * @method _IH_Subject_C|Subject[] cursor()
     * @method Subject|null|_IH_Subject_C|Subject[] find($id, array|string $columns = ['*'])
     * @method _IH_Subject_C|Subject[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method Subject|_IH_Subject_C|Subject[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Subject|_IH_Subject_C|Subject[] findOrFail($id, array|string $columns = ['*'])
     * @method Subject|_IH_Subject_C|Subject[] findOrNew($id, array|string $columns = ['*'])
     * @method Subject first(array|string $columns = ['*'])
     * @method Subject firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method Subject firstOrCreate(array $attributes = [], array $values = [])
     * @method Subject firstOrFail(array|string $columns = ['*'])
     * @method Subject firstOrNew(array $attributes = [], array $values = [])
     * @method Subject firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Subject forceCreate(array $attributes)
     * @method _IH_Subject_C|Subject[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Subject_C|Subject[] get(array|string $columns = ['*'])
     * @method Subject getModel()
     * @method Subject[] getModels(array|string $columns = ['*'])
     * @method _IH_Subject_C|Subject[] hydrate(array $items)
     * @method Subject make(array $attributes = [])
     * @method Subject newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Subject[]|_IH_Subject_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Subject[]|_IH_Subject_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Subject sole(array|string $columns = ['*'])
     * @method Subject updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Subject_QB withTrashed()
     * @method _IH_Subject_QB onlyTrashed()
     * @method _IH_Subject_QB withoutTrashed()
     * @method _IH_Subject_QB restore()
     */
    class _IH_Subject_QB extends _BaseBuilder {}

    /**
     * @method User|null getOrPut($key, $value)
     * @method User|$this shift(int $count = 1)
     * @method User|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method User|$this pop(int $count = 1)
     * @method User|null pull($key, \Closure $default = null)
     * @method User|null last(callable $callback = null, \Closure $default = null)
     * @method User|$this random(int|null $number = null)
     * @method User|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method User|null get($key, \Closure $default = null)
     * @method User|null first(callable $callback = null, \Closure $default = null)
     * @method User|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method User|null find($key, $default = null)
     * @method User[] all()
     */
    class _IH_User_C extends _BaseCollection {
        /**
         * @param int $size
         * @return User[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method _IH_User_QB whereId($value)
     * @method _IH_User_QB whereRoleId($value)
     * @method _IH_User_QB whereName($value)
     * @method _IH_User_QB whereUserCode($value)
     * @method _IH_User_QB whereMatricule($value)
     * @method _IH_User_QB whereUserStatus($value)
     * @method _IH_User_QB whereEmail($value)
     * @method _IH_User_QB whereEmailVerifiedAt($value)
     * @method _IH_User_QB wherePassword($value)
     * @method _IH_User_QB whereDeletedAt($value)
     * @method _IH_User_QB whereRememberToken($value)
     * @method _IH_User_QB whereCreatedAt($value)
     * @method _IH_User_QB whereUpdatedAt($value)
     * @method User baseSole(array|string $columns = ['*'])
     * @method User create(array $attributes = [])
     * @method _IH_User_C|User[] cursor()
     * @method User|null|_IH_User_C|User[] find($id, array|string $columns = ['*'])
     * @method _IH_User_C|User[] findMany(array|Arrayable $ids, array|string $columns = ['*'])
     * @method User|_IH_User_C|User[] findOr($id, array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method User|_IH_User_C|User[] findOrFail($id, array|string $columns = ['*'])
     * @method User|_IH_User_C|User[] findOrNew($id, array|string $columns = ['*'])
     * @method User first(array|string $columns = ['*'])
     * @method User firstOr(array|\Closure|string $columns = ['*'], \Closure $callback = null)
     * @method User firstOrCreate(array $attributes = [], array $values = [])
     * @method User firstOrFail(array|string $columns = ['*'])
     * @method User firstOrNew(array $attributes = [], array $values = [])
     * @method User firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method User forceCreate(array $attributes)
     * @method _IH_User_C|User[] fromQuery(string $query, array $bindings = [])
     * @method _IH_User_C|User[] get(array|string $columns = ['*'])
     * @method User getModel()
     * @method User[] getModels(array|string $columns = ['*'])
     * @method _IH_User_C|User[] hydrate(array $items)
     * @method User make(array $attributes = [])
     * @method User newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|User[]|_IH_User_C paginate(\Closure|int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|User[]|_IH_User_C simplePaginate(int|null $perPage = null, array|string $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method User sole(array|string $columns = ['*'])
     * @method User updateOrCreate(array $attributes, array $values = [])
     * @method _IH_User_QB withTrashed()
     * @method _IH_User_QB onlyTrashed()
     * @method _IH_User_QB withoutTrashed()
     * @method _IH_User_QB restore()
     */
    class _IH_User_QB extends _BaseBuilder {}
}
