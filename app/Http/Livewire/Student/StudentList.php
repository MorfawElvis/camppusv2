<?php

namespace App\Http\Livewire\Student;

use App\Models\ClassRoom;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class StudentList extends Component
{
    use WithPagination,LivewireAlert, WithFileUploads;

    public $editMode = false;

    public $deletedStudent;

    public $search;

    public $perPage;

    public $full_name;

    public $place_of_birth;

    public $date_of_birth;

    public $profile_image;

    public $photo;

    public $editedStudentId;

    public int $isBoarding = 0;

    public $class_id;

    public $class_name;

    public $editedClass;


    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteConfirmed',
    ];
    protected $rules = [
        'full_name' => 'required',
        'date_of_birth' => 'required',
    ];
    public function render()
    {
        $class_rooms = ClassRoom::where('academic_year_id', current_school_year()->id ?? '')->orderBy('class_name', 'asc')->get();
        $students = Student::with('user', 'class_room.section')
            ->whereHas('user', function ($query) {
                $query->where('user_status', '=', '1');
            })
            ->whereHas('class_room', function ($query) {
                $query->withSum('feeItems', 'amount');
            })
            ->where('class_room_id', '=', $this->class_id)
            ->orderBy('full_name', 'asc')
            ->paginate(10);

        return view('livewire.student.student-list', compact('class_rooms', 'students'));
    }

    public function deleteStudent($user_id)
    {
        $this->deletedStudent = $user_id;
        $this->confirm('', [
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }

    public function editStudentModal($student, $current_page)
    {
        $this->reset();
        $this->gotoPage($current_page);

        $this->editedStudentId = $student['id'];
        $this->full_name = $student['full_name'];
        $this->place_of_birth = $student['place_of_birth'];
        $this->profile_image = $student['profile_image'];
        $this->date_of_birth = $student['date_of_birth'];
        $this->class_id = $student['class_room_id'];
        $this->editedClass = $student['class_room']['class_name'];

        $this->editMode = true;

        $this->dispatchBrowserEvent('showEditStudentModal');
    }

    public function updatingClassId()
    {
        $this->gotoPage(1);
    }

    public function updateStudent()
    {
        $this->validate();
        if ($this->photo) {
            Storage::disk('public')->delete('public/students_photos/'.$this->profile_image);
            $new_photo = $this->storeImage();
        }
        Student::findOrFail($this->editedStudentId)->update([
            'full_name' => $this->full_name,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth,
            'class_room_id' => $this->class_id,
            'profile_image' => $new_photo ?? $this->profile_image,
        ]);
        $this->dispatchBrowserEvent('hideEditStudentModal');
        $this->alert('success', 'Record has been updated successfully');

    }

    protected function storeImage()
    {
        if (! $this->photo) {
            return null;
        }
        $img = ImageManagerStatic::make($this->photo)->resize(400, 400)->sharpen(10)->encode('jpg');
        $name = Str::random().'.jpg';
        Storage::disk('public')->put('public/students_photos/'.$name, $img);

        return $name;
    }

    public function deleteConfirmed()
    {
        User::destroy($this->deletedStudent);
        Student::where('user_id', $this->deletedStudent)->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }
}
