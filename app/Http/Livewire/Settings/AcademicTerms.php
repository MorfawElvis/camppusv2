<?php

namespace App\Http\Livewire\Settings;

use App\Models\SchoolYear;
use App\Models\SchoolTerm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AcademicTerms extends Component
{
    use WithPagination,LivewireAlert;

    public $termName;
    public $academicYear;
    public $termDeleted;
    public $editedTermId;
    public $editedYearName;
    public $editedYearId;
    public $termStatus;
    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteTerm',
    ];
    protected $rules = [
        'termName' => 'required|string',
        'academicYear' => 'required',
    ];
    public function createTermModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showTermModal');
    }
    public function createTerm()
    {
        $this->validate();
        SchoolTerm::create([
            'term_name' => $this->termName,
            'school_year_id' => $this->academicYear
        ]);
        $this->dispatchBrowserEvent('hideTermModal');
        $this->alert('success', 'Record has been added successfully');
    }
    public function confirmTermDelete($term_id)
    {
        $this->termDeleted = $term_id;
        $this->confirm('Are you sure you want to delete this record?', [
            'onConfirmed' => 'deleteTerm',
        ]);
    }
    public function deleteTerm()
    {
        SchoolTerm::findOrFail($this->termDeleted)->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }
    public function editModal($academic_term)
    {
        $this->reset();
        $this->termName       = $academic_term['term_name'];
        $this->editedTermId   = $academic_term['id'];
        $this->editedYearName = $academic_term['school_year']['year_name'];
        $this->editedYearId   = $academic_term['school_year_id'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showTermModal');
    }
    public function editTerm()
    {
        $this->validate([
            'termName' => 'required|string'
        ]);
        SchoolTerm::findOrFail($this->editedTermId)->update([
            'term_name' => $this->termName
        ]);
        $this->dispatchBrowserEvent('hideTermModal');
        $this->alert('success', 'Record has been successfully updated');
    }
    public function termStatusChange($term_id, $term_status)
    {
        $active_term = SchoolTerm::where('term_status', 'opened')->count();

        if($term_status == 'closed' && $active_term == 0){
            SchoolTerm::findOrFail($term_id)->update([
                'term_status' => 'opened'
            ]);
            $this->alert('success', 'Term has been opened successfully');
            return redirect()->route('admin.academic.terms');
        }
        elseif($term_status == 'opened' && $active_term >= 1){
            SchoolTerm::findOrFail($term_id)->update([
                'term_status' => 'closed'
            ]);
            $this->alert('success', 'Term has been closed successfully');
            return redirect()->route('admin.academic.terms');
        }
        else{
            session()->flash('message', 'Current school term is already set, disable active term to change');
            $this->redirect('/academic-terms');
        }
    }
    public function render()
    {
        $academic_terms = SchoolTerm::with('school_year')->latest()->paginate(5);
        $academic_year = SchoolYear::where('year_status', 'opened')->first();
        return view('livewire.settings.academic-terms', [
            'academic_terms' => $academic_terms,
            'academic_year' => $academic_year
        ]);
    }
}
