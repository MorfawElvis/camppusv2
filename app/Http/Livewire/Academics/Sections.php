<?php

namespace App\Http\Livewire\Academics;

use App\Models\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Sections extends Component
{
    use LivewireAlert;

    public $sectionName;

    public $sectionDeleted;

    public $sectionEditedId;

    public $editMode = false;

    protected $listeners = [
        'deleteSection',
    ];

    public function showSectionModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showSectionModal');
    }

    public function createSection()
    {
        $this->validate([
            'sectionName' => 'required|string|unique:sections,section_name',
        ]);
        Section::create([
            'section_name' => $this->sectionName,
        ]);
        $this->dispatchBrowserEvent('hideSectionModal');
        $this->alert('success', 'Record has been added successfully');
    }

    public function editModal($section)
    {
        $this->reset();
        $this->sectionName = $section['section_name'];
        $this->sectionEditedId = $section['id'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showSectionModal');
    }

    public function editSection()
    {
        $this->validate([
            'sectionName' => 'required|string|unique:sections,section_name,'.$this->sectionEditedId,
        ]);
        Section::findOrFail($this->sectionEditedId)->update([
            'section_name' => $this->sectionName,
        ]);
        $this->dispatchBrowserEvent('hideSectionModal');
        $this->alert('success', 'Record has been updated successfully');
    }

    public function confirmDelete($section_id)
    {
        $this->sectionDeleted = $section_id;
        $this->confirm('Are you sure you want to delete this record?', [
            'onConfirmed' => 'deleteSection',
        ]);
    }

    public function deleteSection()
    {
        Section::destroy($this->sectionDeleted);
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function render()
    {
        $sections = Section::all();

        return view('livewire.academics.sections', [
            'sections' => $sections,
        ]);
    }
}
