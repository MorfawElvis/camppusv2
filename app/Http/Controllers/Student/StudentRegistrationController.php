<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\NewStudentRequest;
use App\Models\ClassRoom;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Services\UserRegistration;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Str;


class StudentRegistrationController extends Controller
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
        $sections = Section::select(['id','section_name'])->get();
        return view('studentRegistration.create', compact('countries', 'genders', 'denominations', 'sections'));
    }

    public function get_class_rooms(Request $request){
          if($request->has('section_id')){
            return DB::table('class_rooms')->where('section_id', $request->input('section_id'))->get();
          }
    }

    /**
     * @throws \Exception
     */
    public function store(NewStudentRequest $request)
    {
          DB::transaction(function () use ($request){
               $user = User::create([
                   'role_id' => 7,
                   'user_code' => (rand(100,1000) . Str::upper(Str::random(3))),
                   'email' => $request->input('email'),
                   'password' => $request->input('password'),
              ]);
              Student::create([
                   'full_name' => $request->input('full_name'),
                   'user_id' => $user->id,
                   'class_room_id' => $request->input('class_id'),
                   'date_of_birth' => $request->input('date_of_birth'),
                   'place_of_birth' => $request->input('place_of_birth'),
                   'gender' => $request->input('gender'),
                   'nationality' => $request->input('nationality'),
                   'denomination' => $request->input('denomination'),
                   'date_of_admission' => $request->input('date_of_admission'),
                   'address' => $request->input('address'),
                   'phone_number' => $request->input('phone_number')
               ]);

          });

        return back()->with('success','New record created successfully!');
    }
    public function show($id)
    {

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
