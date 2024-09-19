<?php

namespace App\Http\Livewire\Facilities;

use App\Models\ClassRoom;
use App\Models\Dormitory;
use App\Models\Employee;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DormitoryManagement extends Component
{
    use WithPagination, LivewireAlert;

    public $dormitories;
    public $remainingCapacity;
    public $selectedDormitory;
    public $students = [];
    public $teachers = [];
    public $searchTerm = '';
    public $selectedClass;
    public $selectedDormitoryId;
    public $selected_students = [];
    public $selected_captains = [];
    public $filteredStudents = [];
    public $dormitoryCapacity = 0;
    public $currentAssignedCount = 0;
    public $isEditMode = false;
    public $classes;
    public $newStudentsSelected = false;

    public $viewedDorm;
    public $totalStudentsAssigned;
    public $studentsByClass = [];
    public $dormitoryCaptains = [];
    public $dormitoryMaster;


    public $viewDormitoryId;
    public $dormitoryDetails;

    public $name;
    public $capacity;
    public $teacher_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
        'teacher_id' => 'nullable|exists:employees,id',
    ];

    public function mount()
    {
        $this->dormitories = Dormitory::with('employee')->get();
        $this->students = Student::all();
        $this->teachers = Employee::all();
        $this->classes = ClassRoom::all();
        $this->filteredStudents = $this->students;
    }

    public function updatedSearchTerm()
    {
        $this->filterStudents();
    }

    public function updatedSelectedClass($classId)
    {
        $this->filterStudents();
    }

    private function filterStudents()
    {
        $query = Student::query();

        if ($this->selectedClass) {
            $query->where('class_room_id', $this->selectedClass);
        }

        if ($this->searchTerm) {
            $query->where('full_name', 'like', '%' . $this->searchTerm . '%');
        }

        $this->filteredStudents = $query->get();
    }

    public function render()
    {
        return view('livewire.facilities.dormitory-management', [
            'dormitories' => $this->dormitories,
            'students' => $this->students,
            'teachers' => $this->teachers,
            'classes' => $this->classes,
            'filteredStudents' => $this->filteredStudents,
            'assignedStudentsByClass' => $this->getAssignedStudentsByClass(),
        ]);
    }

    public function assignStudentsModal($dormitoryId)
    {
        $this->selectedDormitoryId = $dormitoryId;
        $dormitory = Dormitory::findOrFail($dormitoryId);
        $this->dormitoryCapacity = $dormitory->capacity;
        $this->remainingCapacity = $this->dormitoryCapacity - $dormitory->students()->count();
        $this->loadDormitoryData();
        $this->emit('openAssignStudentsModal');
    }

    public function assignCaptainsModal($dormitoryId)
    {
        $this->selectedDormitoryId = $dormitoryId;
        $this->loadDormitoryData();
        $this->emit('openAssignCaptainsModal');
    }

    public function loadDormitoryData()
    {
        $dormitory = Dormitory::findOrFail($this->selectedDormitoryId);
        $this->selectedDormitory = $dormitory;
        $this->selected_students = $dormitory->students->pluck('id')->toArray();
        $this->selected_captains = $dormitory->captains->pluck('id')->toArray();
    }

    public function saveDormitory()
    {
        $this->validate();

        Dormitory::updateOrCreate(['id' => $this->selectedDormitoryId], [
            'name' => $this->name,
            'capacity' => $this->capacity,
            'employee_id' => $this->teacher_id,
        ]);

        $this->alert('success', $this->isEditMode ? 'Dormitory updated successfully!' : 'Dormitory added successfully!');

        $this->emit('closeModals');
        $this->resetInputFields();
        $this->mount();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->capacity = '';
        $this->teacher_id = '';
        $this->selected_students = [];
        $this->selected_captains = [];
        $this->selectedDormitoryId = null;
    }

    public function editDormitory($id)
    {
        $this->isEditMode = true;
        $dormitory = Dormitory::findOrFail($id);
        $this->selectedDormitoryId = $id;
        $this->name = $dormitory->name;
        $this->capacity = $dormitory->capacity;
        $this->teacher_id = $dormitory->teacher_id;

        $this->emit('openAddDormitoryModal');
    }

    public function deleteDormitory($id)
    {
        Dormitory::findOrFail($id)->delete();
        $this->alert('success','Dormitory deleted successfully!' );
        $this->mount();
    }

    public function updatedSelectedDormitoryId($value)
    {
        $dormitory = Dormitory::find($value);
        $this->dormitoryCapacity = $dormitory->capacity;
        $this->currentAssignedCount = $dormitory->students()->count();
    }

    public function updatedSelectedStudents()
    {
        $selectedCount = count($this->selected_students);
        if ($selectedCount > $this->dormitoryCapacity) {
            session()->flash('error', 'You cannot select more students than the remaining capacity.');
            array_pop($this->selected_students); // Remove the last selected student
        } else {
            $this->remainingCapacity = $this->dormitoryCapacity - $selectedCount;
        }
        $dormitory = Dormitory::find($this->selectedDormitoryId);
        $currentlyAssigned = $dormitory->students->pluck('id')->toArray();
        $this->newStudentsSelected = count(array_diff($this->selected_students, $currentlyAssigned)) > 0;
    }

    public function assignStudents()
    {
        $dormitory = Dormitory::find($this->selectedDormitoryId);

        // Calculate current number of students assigned to the dormitory
        $currentAssignedCount = $dormitory->students()->count();
        // Determine the remaining capacity
        $remainingCapacity = $dormitory->capacity - $currentAssignedCount;

        // Filter and validate selected students
        $invalidStudentIds = [];
        $validStudentIds = array_filter($this->selected_students, function ($id) use (&$invalidStudentIds, $dormitory) {
            $student = Student::find($id);
            if ($student) {
                // Check if the student is assigned to another dormitory
                $currentDormitoryId = $student->dormitories()->pluck('dormitory_id')->first();
                if (!$currentDormitoryId || $currentDormitoryId == $dormitory->id) {
                    return true; // Valid if not assigned to any dormitory or assigned to the current dormitory
                } else {
                    $invalidStudentIds[] = $id; // Invalid if assigned to a different dormitory
                }
            }
            return false;
        });

        // Check if there are any invalid student IDs
        if (count($invalidStudentIds) > 0) {
            $invalidStudentNames = Student::whereIn('id', $invalidStudentIds)->pluck('full_name')->toArray();
            $this->alert('error', 'The following students are already assigned to another dormitory: ' . implode(', ', $invalidStudentNames));
            return;
        }

        // Calculate the number of new students to be assigned
        $newStudentsCount = count($validStudentIds);
        // Check if assigning the new students would exceed the dormitory's capacity
        if ($newStudentsCount > $remainingCapacity) {
            $this->alert('error', 'Cannot assign more students than the remaining capacity of the dormitory.');
            return;
        }
        // Sync valid students to the dormitory
        $dormitory->students()->sync($validStudentIds);

        $this->emit('closeModals');
        $this->alert('success', 'Students assigned successfully.');
        $this->reset(['selectedDormitoryId', 'selected_students']);
    }

    public function assignCaptains()
    {
        $dormitory = Dormitory::find($this->selectedDormitoryId);

        if (count($this->selected_captains) > count($this->selected_students)) {
            $this->alert('error', 'Cannot assign more captains than the number of assigned students.');
            return;
        }

        $dormitory->students()->update([
            'is_captain' => 0
        ]);

        foreach ($this->selected_captains as $captainId) {
            $dormitory->students()->updateExistingPivot($captainId, ['is_captain' => true]);
        }

        $this->emit('closeModals');
        $this->alert('success','Captains assigned successfully.' );
        $this->reset(['selectedDormitoryId', 'selected_captains']);
    }

    private function getAssignedStudentsByClass()
    {
        $dormitory = Dormitory::find($this->selectedDormitoryId);
        if (!$dormitory) {
            session()->flash('error', 'Dormitory not found.');
            return collect();
        }

        $assignedStudents = $dormitory->students()->orderBy('full_name', 'asc')->get();
        return $assignedStudents->groupBy('class_room_id');
    }

    public function viewDormitory($id)
    {
        $this->selectedDormitoryId = $id;

        // Get the dormitory details
        $dormitory = Dormitory::with('students', 'employee', 'students.class_room')->findOrFail($id);
        if (!empty($dormitory->name)) {
            $this->viewedDorm = $dormitory->name;
        }
        // Total number of students assigned to the dormitory
        $this->totalStudentsAssigned = $dormitory->students->count();

        // Count students by class
        $this->studentsByClass = $dormitory->students->groupBy('class_room_id')->map(function ($students) {
            return $students->count();
        });

        // Get captains and their classes
        $this->dormitoryCaptains = $dormitory->students->where('pivot.is_captain', true)->map(function ($student) {
            return [
                'name' => $student->full_name,
                'class' => $student->class_room->class_name ?? 'N/A',
            ];
        });

        // Set the employee (dormitory master)
        $this->dormitoryMaster = $dormitory->employee->full_name ?? 'N/A';

        $this->emit('showDormitoryDetailsModal');
    }
}
