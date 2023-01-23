<?php

namespace App\Http\Controllers\Student;

use DB;
use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Employee;
use App\Models\ClassRoom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Repositories\StudentRepo;
use App\Services\UserRegistration;
use App\Repositories\ClassRoomRepo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Intervention\Image\ImageManagerStatic;
use App\Http\Requests\Student\NewStudentRequest;
use phpDocumentor\Reflection\Types\Null_;

class StudentRegistrationController extends Controller
{
    protected array $countries,$genders,$denominations;

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

    //Get the class rooms based on filtered section 
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
              
              if($request->hasFile('photo')){
                $profile_image = $this->storeImage($request->file('photo'));
              }           
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
                   'phone_number' => $request->input('phone_number'),
                   'profile_image' => $profile_image ?? Null
               ]);

          });

        return back()->with('alert-success','New record created successfully!');
    }
    protected function storeImage($file)
    {
        $img   = ImageManagerStatic::make($file)->resize(400, 400,)->sharpen(10)->encode('jpg');
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put('public/students_photos/'.$name,$img);
        return $name;
    }

    public function studentCards()
    {
         $sections = (new ClassRoomRepo)->get_school_sections();
         return view('cards.student_cards', compact('sections'));
    }
    
    public function generateCards(Request $request)
    {
        $generator = new BarcodeGeneratorPNG();;
        $setting = GeneralSetting::first();
        $students =  (new StudentRepo)->get_students($request->input('class_id'));
        return view('prints.student_id_cards', compact('students', 'generator','setting'));
    }

}
