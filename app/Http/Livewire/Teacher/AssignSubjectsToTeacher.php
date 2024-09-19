<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Employee;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class AssignSubjectsToTeacher extends Component
{
    public $subjects;
    public $selected_teacher;
    public $selected_subjects = [];
    public $showModal = false;

    public function mount()
    {
        $this->subjects = Subject::all();
    }

    public function openModal($teacherId)
    {
        $this->selected_teacher = Employee::with('subjects')->find($teacherId);
        $this->selected_subjects = $this->selected_teacher->subjects->pluck('id')->toArray();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['selected_teacher', 'selected_subjects']);
    }

    public function assignSubjects()
    {
        $this->validate([
            'selected_subjects' => 'required|array',
        ]);

        $this->selected_teacher->subjects()->sync($this->selected_subjects);

        session()->flash('message', 'Subjects assigned successfully.');
        $this->closeModal();
        $this->mount(); // Refresh the data
    }

    public function render()
    {
        return view('livewire.teacher.assign-subjects-to-teacher',[
            'teachers' => Employee::with('subjects')->orderBy('full_name', 'ASC')->paginate()
        ]);
    }
}
