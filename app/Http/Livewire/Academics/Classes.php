<?php

namespace App\Http\Livewire\Academics;

use App\Models\ClassMaster;
use App\Models\ClassRoom;
use App\Models\Employee;
use App\Models\EmployeeSubject;
use App\Models\Level;
use App\Models\SchoolYear;
use App\Models\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class Classes extends Component
{
    use WithPagination, LivewireAlert;

    public $editMode = false;
    protected $paginationTheme = 'bootstrap';

    public $className;
    public $level_id;
    public $deletedClass;
    public $section_id;
    public $editedSection;
    public $classEditedId;
    public $selectedTeacherId = [];

    public $selectedClassRoomId;
    public $showTeacherModal = false;
    public $teachers = [];

    protected $listeners = [
        'deleteLevel',
    ];

    private $deletedLevel;

    public function showClassModal()
    {
        $this->resetExcept('teachers');
        $this->dispatchBrowserEvent('showClassModal');
    }

    public function createClass()
    {
        $this->validate([
            'className' => 'required|string',
            'section_id' => 'required',
            'level_id' => 'required',
        ], [
            'className.required' => 'The :attribute cannot be empty',
            'section_id.required' => 'The :attribute cannot be empty',
            'level_id.required' => 'The :attribute cannot be empty',
        ]);
        try {
            ClassRoom::create([
                'class_name' => $this->className,
                'section_id' => $this->section_id,
                'level_id' => $this->level_id,
                'academic_year_id' => current_school_year()->id,
            ]);
            $this->alert('success', 'The record has been added successfully');
            $this->dispatchBrowserEvent('hideClassModal');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function editModal($class)
    {
        $this->resetExcept('teachers');
        $this->className = $class['class_name'];
        $this->classEditedId = $class['id'];
        $this->section_id = $class['section']['id'];
        $this->editedSection = $class['section']['section_name'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showClassModal');
    }

    public function editClass()
    {
        $this->validate([
            'className' => 'required|string',
            'section_id' => 'required',
        ], [
            'className.required' => 'The :attribute cannot be empty',
            'section_id.required' => 'The :attribute cannot be empty',
        ]);
        ClassRoom::findOrFail($this->classEditedId)->update([
            'class_name' => $this->className,
            'section_id' => $this->section_id,
        ]);
        $this->dispatchBrowserEvent('hideClassModal');
        $this->alert('success', 'Record has been updated successfully');
    }

    public function confirmDeleteLevel($level_id)
    {
        $this->deletedLevel = $level_id;
        $this->confirm('Are you sure you want to delete this record', [
            'onConfirmed' => 'deleteLevel',
        ]);
    }

    public function deleteClass()
    {
        Level::destroy($this->deletedLevel);
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function openTeacherModal($classRoomId)
    {
        $this->selectedClassRoomId = $classRoomId;
        $classSubjects = ClassRoom::findOrFail($classRoomId)->classSubjects;
        $assignedTeacherIds = EmployeeSubject::whereIn('subject_id', $classSubjects->pluck('subject_id'))->pluck('employee_id')->unique();
        $this->teachers = Employee::with('classMaster')->whereIn('id', $assignedTeacherIds)->get();
        $this->showTeacherModal = true;
    }

    public function assignClassMaster()
    {
        // Ensure that selectedTeacherId is a single value
        $teacherId = $this->selectedTeacherId;
        if (is_array($teacherId)) {
            $teacherId = $teacherId[0] ?? null; // Handle the case where the array might be empty
        }

        // Validate teacherId
        if (!$teacherId) {
            $this->alert('error', 'Please select a teacher.');
            return;
        }

        // Ensure that the selected teacher is not already a class master for another class
        $existingMaster = ClassMaster::where('employee_id', $teacherId)->first();
        if ($existingMaster) {
            $this->alert('error', 'The selected teacher is already a class master for another class.');
            return;
        }

        ClassMaster::updateOrCreate(
            ['class_room_id' => $this->selectedClassRoomId],
            ['employee_id' => $teacherId]
        );

        $this->alert('success', 'Class master assigned successfully.');
        $this->showTeacherModal = false;
        $this->reset(['selectedClassRoomId', 'selectedTeacherId']);
    }

    public function removeClassMaster($classRoomId)
    {
        $classMaster = ClassMaster::where('class_room_id', $classRoomId)->first();
        if ($classMaster) {
            $classMaster->delete();
            session()->flash('message', 'Class master unassigned successfully.');
        } else {
            session()->flash('error', 'No class master assigned to this class.');
        }
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $class_rooms = ClassRoom::with(['section', 'level', 'classMaster.employee'])
            ->where('academic_year_id', current_school_year()->id ?? '')
            ->withCount('students')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $levels = Level::orderBy('id', 'asc')->get();
        $sections = Section::select(['id', 'section_name'])->get();

        return view('livewire.academics.classes', [
            'levels' => $levels,
            'class_rooms' => $class_rooms,
            'sections' => $sections,
        ]);
    }
}
