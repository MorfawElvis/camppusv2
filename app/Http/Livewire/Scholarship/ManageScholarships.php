<?php

namespace App\Http\Livewire\Scholarship;

use App\Models\ClassRoom;
use App\Models\Scholarship;
use App\Models\ScholarshipCategory;
use App\Models\Section;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageScholarships extends Component
{
    use WithPagination,LivewireAlert, WithFileUploads;

    public $students;

    public $records;

    public $section_id;

    public $class_rooms;

    public $class_id;

    public $student_id;

    public $scholarship_id;

    public $selected = [];

    public $selectAll = false;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->records = Scholarship::with('student.class_room', 'scholarship_category')->get();
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selected = $this->records->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->selected = [];
        }
    }
    public function deleteSelected()
    {
        Scholarship::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function showScholarshipModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showScholarshipModal');
    }

    public function updatedSectionId($section_id)
    {
        $this->class_rooms = ClassRoom::where('section_id', $section_id)->get();
    }

    public function updatedClassId($class_id)
    {
        $this->students = Student::where('class_room_id', $class_id)->get();
    }

    public function newScholarship()
    {
        $this->validate([
            'student_id' => 'unique:scholarships,student_id',
        ],
            [
                'student_id.unique' => 'Sorry, this student is already on scholarship',
            ]
        );
        Scholarship::create([
            'student_id' => $this->student_id,
            'school_year_id' => current_school_year()->id,
            'scholarship_category_id' => $this->scholarship_id,
            'renewable' => 0,
            'is_approved' => 1,
        ]);
        $this->dispatchBrowserEvent('hideSholarshipModal');
        $this->alert('success', 'Record has been added successfully');
    }

    public function deleteScholarship($student_id)
    {
        $this->selectAll = false;
        Scholarship::where('student_id', $student_id)->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function render()
    {
        $sections = Section::all();
        $scholarships = ScholarshipCategory::all();
        $students_with_scholarships = Scholarship::with('student.class_room', 'scholarship_category')->paginate(10);

        return view('livewire.scholarship.manage-scholarships', compact('sections', 'scholarships', 'students_with_scholarships'));
    }
}
