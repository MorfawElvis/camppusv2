<?php

namespace App\Http\Controllers\Staff;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserRegistration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\NewStaffRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StaffRegistrationController extends Controller
{

    protected array $countries,$genders,$denominations;
    
    public function __construct(UserRegistration $userRegistration)
    {
        $this->countries = $userRegistration->setCountry();
        $this->genders = $userRegistration->setGender();
        $this->denominations = $userRegistration->setDenomination();
    }
    public function index()
    {
        //
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
        DB::transaction(function () use ($request){
            $user = User::create([
                'role_id' => $request->input('role'),
                'user_code' => (rand(100,1000) . Str::upper(Str::random(3))),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
           ]);
           Employee::create([
                'full_name' => $request->input('full_name'),
                'user_id' => $user->id,
                'date_of_birth' => $request->input('date_of_birth'),
                'place_of_birth' => $request->input('place_of_birth'),
                'gender' => $request->input('gender'),
                'highest_qualification' => $request->input('highest_qualification'),
                'position' => $request->input('position'),
                'marital_status' => $request->input('marital_status'),
                'nationality' => $request->input('nationality'),
                'denomination' => $request->input('denomination'),
                'date_of_employment' => $request->input('employment_date'),
                'address' => $request->input('address'),
                'phone_number' => $request->input('phone_number'),
                'insurance_number' => $request->input('insurance_number')
            ]);

       });
       return back()->with('alert-success','New record created successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
