<?php

namespace App\Http\Livewire\Academics;

use App\Models\ClassRoom;
use App\Models\Level;
use App\Models\SchoolYear;
use App\Models\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;


class Classes extends Component
{
    use WithPagination,LivewireAlert;

    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    public $className;

    public $level_id;

    public $deletedClass;

    public $section_id;

    public $editedSection;

    public $classEditedId;

    protected $listeners = [
        'deleteLevel',
    ];
    private $deletedLevel;

    public function showClassModal()
    {
        $this->reset();
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
        }catch (\Exception $e)
        {
            $this->alert('error', $e->getMessage());
        }
    }

    public function editModal($class)
    {
        $this->reset();
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

    //TODO: Add delete functionality for class rooms
    public function deleteClass()
    {
        Level::destroy($this->deletedLevel);
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $class_rooms = ClassRoom::with(['section', 'level'])
            ->where('academic_year_id', current_school_year()->id ?? '')
            ->withCount('students')
            ->paginate(7);
        $levels = Level::orderBy('id', 'asc')->get();
        $sections = Section::select(['id', 'section_name'])->get();

        return view('livewire.academics.classes', [
            'levels' => $levels,
            'class_rooms' => $class_rooms,
            'sections' => $sections,
        ]);
    }
}
