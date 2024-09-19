<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\NewStudentRequest;
use App\Models\GeneralSetting;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Repositories\ClassRoomRepo;
use App\Repositories\StudentRepo;
use App\Services\UserRegistration;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Void_;
use Picqer\Barcode\BarcodeGeneratorPNG;

class StudentRegistrationController extends Controller
{
    protected array $countries;

    protected array $genders;

    protected array $denominations;

    public function __construct(UserRegistration $userRegistration)
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
        $sections = (new ClassRoomRepo)->get_school_sections();

        return view('studentRegistration.create', compact('countries', 'genders', 'denominations', 'sections'));
    }

    //Get the classrooms based on filtered section
    public function get_class_rooms(Request $request)
    {
        if ($request->has('section_id')) {
            return DB::table('class_rooms')
                ->where('academic_year_id', current_school_year()->id)
                ->where('section_id', $request->input('section_id'))->get();
        }
    }

    public function store(NewStudentRequest $request)
    {
        DB::transaction(function () use ($request) {

            if ($request->hasFile('photo')) {
                $profile_image = $this->storeImage($request->file('photo'));
            }
            $user = User::create([
                'user_code' => (rand(100, 1000).Str::upper(Str::random(3))),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            $user->assignRole('student');
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
                'phone_number' => $request->input('phone_number'),
                'profile_image' => $profile_image ?? null,
            ]);
        });

        return back()->with('alert-success', 'New record created successfully!');
    }

    protected function storeImage($file)
    {
        $img = ImageManagerStatic::make($file)->resize(400, 400)->sharpen(10)->encode('jpg');
        $name = Str::random().'.jpg';
        Storage::disk('public')->put('public/students_photos/'.$name, $img);

        return $name;
    }

    public function studentCards()
    {
        $sections = (new ClassRoomRepo)->get_school_sections();

        return view('cards.student_cards', compact('sections'));
    }

    public function generateCards(Request $request)
    {
        $generator = new BarcodeGeneratorPNG();
        $setting = GeneralSetting::first();
        $students = (new StudentRepo)->get_students($request->input('class_id'));

        return view('prints.student_id_cards', compact('students', 'generator', 'setting'));
    }
}
