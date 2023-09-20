<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\NewStaffRequest;
use App\Models\Employee;
use App\Models\GeneralSetting;
use App\Models\Role;
use App\Services\Employee\EmployeeService;
use App\Services\UserRegistration;
use Picqer\Barcode\BarcodeGeneratorPNG;

class StaffRegistrationController extends Controller
{
    protected array $countries;

    protected array $genders;

    protected array $denominations;

    public function __construct(
        UserRegistration $userRegistration,
        protected EmployeeService $employee_service,
    )

    {
        $this->countries = $userRegistration->setCountry();
        $this->genders = $userRegistration->setGender();
        $this->denominations = $userRegistration->setDenomination();
    }

    public function create()
    {
        $countries = $this->countries;
        $genders = $this->genders;
        $denominations = $this->denominations;
        $roles = Role::all();

        return view('staffRegistration.create', compact('countries', 'genders', 'denominations', 'roles'));
    }
    public function store(NewStaffRequest $request)
    {
       $this->employee_service->createEmployee($request);
        return back()->with('alert-success', 'Record has been successfully created');
    }
    public function edit($staff_id, int $current_page)
    {
        $countries = $this->countries;
        $genders = $this->genders;
        $denominations = $this->denominations;
        $roles = Role::all();
        $employee = Employee::where('user_id', $staff_id)->first();
        return view('staffRegistration.edit',  compact('countries', 'genders', 'denominations', 'roles', 'employee','current_page'));
    }

    public function update(NewStaffRequest $request, $id)
    {
        $this->employee_service->updateEmployee($request,$id);
        return redirect('staff-list?page='.$request->input('current_page'))->with('alert-success', 'Record has been updated successfully');
    }

    public function employeeCards()
    {
        return view('cards.employee_cards');
    }

    public function generateEmployeeCards()
    {
        $employees = Employee::all();
        $generator = new BarcodeGeneratorPNG();
        $setting = GeneralSetting::first();

        return view('prints.employee_id_cards', compact('employees', 'generator', 'setting'));
    }
}
