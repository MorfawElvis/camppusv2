<?php

namespace App\Http\Livewire\Scholarship;

use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Scholarship;
use App\Models\ScholarshipCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageScholarships extends Component
{
    use WithPagination,LivewireAlert, WithFileUploads;
    
    public $students, $section_id, $class_rooms,$class_id, $student_id, $scholarship_id;
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
            'student_id'    => 'unique:scholarships,student_id',
        ],
        [
         'student_id.unique' => 'Sorry, this student is already on scholarship'
         ]
        );
        Scholarship::create([
              'student_id'            => $this->student_id,
              "school_year_id"        => current_school_year()->id,
              'scholarship_category_id'  => $this->scholarship_id,
              'renewable'             =>  0,
              'is_approved'           =>  1,
        ]);
        $this->dispatchBrowserEvent('hideSholarshipModal');
        $this->alert('success' ,'Record has been added successfully');
    }

    public function deleteScholarship($student_id)
    {
        Scholarship::where('student_id', $student_id)->delete();
        $this->alert('success','Record has been deleted successfully');
    }
    public function render()
    {
        $sections = Section::all();
        $scholarships = ScholarshipCategory::all();
        $students_with_scholarships =  Scholarship::with('student.class_room', 'scholarship_category')->get();
        return view('livewire.scholarship.manage-scholarships', compact('sections', 'scholarships', 'students_with_scholarships'));
    }
}
