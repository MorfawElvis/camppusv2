<?php

namespace App\Http\Livewire\Student;

use App\Models\User;
use App\Models\Student;
use App\Repositories\ClassRoomRepo;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentList extends Component
{
    use WithPagination,LivewireAlert, WithFileUploads;

    public $deletedStudent, $search, $perPage, $full_name, $place_of_birth, 
    $date_of_birth, $profile_image, $photo, $editedStudentId;

    public int $isBoarding = 0; 

    public $class_id = null;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
           'deleteConfirmed'
    ];

    protected $rules = [
        'full_name'          => 'required',
        'date_of_birth'      => 'required',
    ];
    
    public function render()
    {   
        $class_rooms =  (new ClassRoomRepo)->get_all_class_rooms();
        $students = Student::search($this->search)
                     ->with('user', 'class_room.section', 'class_room')
                     ->whereHas('user', function($query){
                        $query->where('user_status', '=', '1');
                       })
                     ->where('class_room_id', '=', $this->class_id)
                     ->orderBy('full_name', 'asc')
                     ->paginate(10);
        return view('livewire.student.student-list', compact('class_rooms', 'students'));
    }

    public function deleteStudent($user_id)
    {
        $this->deletedStudent = $user_id;
        $this->confirm('',[                                                                                                         
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }
    public function editStudentModal($student)
    {
        $this->reset();
        $this->editedStudentId = $student['id'];
        $this->full_name = $student['full_name'];
        $this->place_of_birth = $student['place_of_birth'];
        $this->profile_image = $student['profile_image'];
        $this->date_of_birth = $student['date_of_birth'];

        $this->dispatchBrowserEvent('showEditStudentModal');
    }

    public function updatingClassId()
    {
        $this->gotoPage(1);
    }

    public function updateStudent()
    {
         $this->validate();
        if ($this->photo){
            Storage::disk('public')->delete('public/students_photos/'.$this->profile_image);
            $new_photo = $this->storeImage();
        }
        Student::findOrFail($this->editedStudentId)->update([
            'full_name'  => $this->full_name,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth'  => $this->date_of_birth,
            'profile_image'  => $new_photo ?? $this->profile_image
        ]);
        $this->dispatchBrowserEvent('hideEditStudentModal');
        $this->alert('success', 'Record has been updated successfully');

    }
    protected function storeImage()
    {
        if (!$this->photo) {
            return null;
        }
        $img   = ImageManagerStatic::make($this->photo)->resize(400, 400,)->sharpen(10)->encode('jpg');
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put('public/students_photos/'.$name,$img);
        return $name;
    }  
    public function deleteConfirmed(){
          User::destroy($this->deletedStudent);
          Student::where('user_id', $this->deletedStudent)->delete();
          $this->alert('success' ,'Record has been deleted successfully');
    }

}
