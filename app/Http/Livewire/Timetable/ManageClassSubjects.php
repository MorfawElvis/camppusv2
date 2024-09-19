<?php

namespace App\Http\Livewire\Timetable;

use App\Models\ClassRoom;
use App\Models\ClassSubjectAssignment;
use App\Models\Employee;
use App\Models\EmployeeSubject;
use App\Models\Level;
use App\Models\Subject;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ManageClassSubjects extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $levels;
    public $classRooms;
    public $subjects;
    public $selected_level;
    public $selected_class_rooms = [];
    public $selected_subjects = [];
    public $assignedSubjects;
    public $filter_level;
    public $filter_classroom_id;
    public $filter_level_id;
    public $filter_classroom;
    public $teachers;
    public $selected_class_subject;
    public $selected_teacher_subjects = [];
    public $showTeacherModal = false;

    public function mount()
    {
        $this->levels = Level::all();
        $this->subjects = Subject::all();
        $this->assignedSubjects = ClassSubjectAssignment::with(['classRoom', 'subject', 'employees'])->get();
        $this->teachers = Employee::all();
    }

    public function updatedSelectedLevel($levelId)
    {
        $this->classRooms = ClassRoom::where('level_id', $levelId)->get();
        $this->selected_class_rooms = [];
        $this->subjects = collect();
    }

    public function updatedSelectedClassRooms()
    {
        if (!empty($this->selected_class_rooms)) {
            $this->subjects = Subject::all();
        } else {
            $this->subjects = collect();
        }
    }

    public function assignSubjects()
    {
        $this->validate([
            'selected_level' => 'required|exists:levels,id',
            'selected_class_rooms' => 'required|array',
            'selected_subjects' => 'array',
        ]);

        foreach ($this->selected_class_rooms as $classRoomId) {
            // Clear existing assignments
//            ClassSubjectAssignment::where('class_room_id', $classRoomId)->delete();

            // Assign new subjects
            foreach ($this->selected_subjects as $subjectId) {
                ClassSubjectAssignment::updateOrCreate([
                    'class_room_id' => $classRoomId,
                    'subject_id' => $subjectId,
                ]);
            }
        }
        $this->alert('success', 'Subjects assigned successfully');
//        session()->flash('message', 'Subjects assigned successfully.');
        $this->assignedSubjects = ClassSubjectAssignment::with(['classRoom', 'subject'])->get();
        $this->reset(['selected_level','selected_class_rooms', 'selected_subjects']);
    }

    public function removeAssignment($assignmentId)
    {
        ClassSubjectAssignment::find($assignmentId)->delete();
        $this->alert('success', 'Assigned Subject removed successfully');
//        session()->flash('message', 'Assignment removed successfully.');
        $this->assignedSubjects = ClassSubjectAssignment::with(['classRoom', 'subject'])->get();
    }

    public function updateTeachingPeriod($assignmentId, $periods)
    {
        $assignment = ClassSubjectAssignment::find($assignmentId);
        $assignment->teaching_periods_per_week = $periods;
        $assignment->save();

    }

    public function openTeacherModal($classSubjectId)
    {
        $this->selected_class_subject = ClassSubjectAssignment::find($classSubjectId);
        $subjectId = $this->selected_class_subject->subject_id;

        // Get teacher IDs that match the subject ID
        $employeeIds = EmployeeSubject::where('subject_id', $subjectId)
            ->pluck('employee_id')
            ->toArray();
        // Filter teachers to include only those who teach the subject
        $this->teachers = Employee::whereIn('id', $employeeIds)->get();

        if ($this->teachers->isEmpty()) {
            $this->alert('warning', 'Please ensure that at least one teacher is assigned to this subject first.');
            return;
        }
        $this->selected_teacher_subjects = $this->selected_class_subject->employees->pluck('id')->toArray();
        $this->showTeacherModal = true;
    }

    public function closeTeacherModal()
    {
        $this->showTeacherModal = false;
        $this->reset(['selected_teacher_subjects', 'selected_class_subject']);
    }

    public function assignTeachers()
    {
        $this->validate([
            'selected_teacher_subjects' => 'required|array',
        ]);

        $this->selected_class_subject->employees()->sync($this->selected_teacher_subjects);
        $this->alert('success', 'Teachers assigned successfully');
        $this->closeTeacherModal();
        $this->assignedSubjects = ClassSubjectAssignment::with(['classRoom', 'subject', 'employees'])->get();
    }


    public function render()
    {
        $assignments= ClassSubjectAssignment::with('subject', 'classRoom', 'employees')
            ->when($this->filter_classroom_id, function ($query) {
                $query->where('class_room_id', $this->filter_classroom_id);
            })
            ->paginate(15);
        return view('livewire.timetable.manage-class-subjects', [
            $this->classRooms = ClassRoom::where('level_id', $this->selected_level)->get(),
            $this->filter_level = Level::all(),
            $this->filter_classroom = ClassRoom::where('level_id', $this->filter_level_id)->get(),
            'assignments' => $assignments
        ]);
    }
}
