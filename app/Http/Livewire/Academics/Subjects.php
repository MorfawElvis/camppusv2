<?php

namespace App\Http\Livewire\Academics;

use App\Models\Department;
use App\Models\Subject;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Subjects extends Component
{
    use WithPagination,LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $subjectName;

    public $subjectCode;

    public $department;

    public $subjectDeleted;

    public $subjectEditedId;

    public $editMode = false;

    protected $listeners = [
        'deleteSubject',
    ];

    public function showSubjectModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showSubjectModal');
    }

    public function createSubject()
    {
        $this->validate([
            'subjectName' => 'required|string|unique:subjects,subject_name',
        ]);

        Subject::create([
            'subject_name' => $this->subjectName,
            'subject_code' => $this->subjectCode,
            'department_id' => $this->department,
        ]);
        $this->dispatchBrowserEvent('hideSubjectModal');
        $this->alert('success', 'Record has been saved successfully');
        $this->emitSelf('updateTable');
    }

    public function editModal($subject)
    {
        $this->reset();
        $this->subjectName = $subject['subject_name'];
        $this->subjectCode = $subject['subject_code'];
        $this->subjectEditedId = $subject['id'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showSubjectModal');
    }

    public function editSubject()
    {
        $this->validate([
            'subjectName' => 'required|string|unique:subjects,subject_name,'.$this->subjectEditedId,
        ]);
        Subject::findOrFail($this->subjectEditedId)->update([
            'subject_name' => $this->subjectName,
            'subject_code' => $this->subjectCode,
            'department_id' => $this->department,
        ]);
        $this->dispatchBrowserEvent('hideSubjectModal');
        $this->alert('success', 'Record has been updated successfully');
    }

    public function confirmDelete($subject_id)
    {
        $this->subjectDeleted = $subject_id;
        $this->confirm('Are you sure you want to delete this record?', [
            'onConfirmed' => 'deleteSubject',
        ]);
    }

    public function deleteSubject()
    {
        Subject::destroy($this->subjectDeleted);
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function render()
    {
        $subjects = Subject::with('department')->paginate(10);

        //       $subjects = DB::table('subjects')
        //              ->rightJoin('departments', 'department_id', '=' , 'departments.id')
        //              ->get();

        $departments = Department::all();

        return view('livewire.academics.subjects', [
            'departments' => $departments,
            'subjects' => $subjects,
        ]);
    }
}
