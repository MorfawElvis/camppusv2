<?php

namespace App\Http\Livewire\Settings;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\SchoolYear;
use Livewire\WithPagination;

class AcademicYears extends Component
{
    use WithPagination, LivewireAlert;

    public $yearName, $yearDeleted, $editedYearId;
    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteYear',
    ];
    protected $rules = [
        'yearName'     => 'required|regex:/^[0-9-]*$/|unique:school_years,year_name',
    ];
    public function createYearModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showYearModal');
    }
    public function createYear()
    {
        $this->validate();
        SchoolYear::create([
            'year_name' => $this->yearName,
        ]);
        $this->dispatchBrowserEvent('hideYearModal');
        $this->alert('success', 'Record has been added successfully');
    }
    public function confirmDeleteYear($year_id)
    {
        $this->yearDeleted = $year_id;
        $this->confirm('Are you sure you want to delete this record?', [
            'onConfirmed' => 'deleteYear',
        ]);
    }
    public function deleteYear()
    {
        //TODO: Prevent delete of active school year
        SchoolYear::findOrFail($this->yearDeleted)->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }
    public function showEditModal($academic_year)
    {
        $this->reset();
        $this->editedYearId = $academic_year['id'];
        $this->yearName     = $academic_year['year_name'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showEditModal');
    }
    public function editYear()
    {
        $this->validate([
            'yearName'     => 'required|regex:/^[0-9-]*$/|unique:school__years,year_name,'.$this->editedYearId,
        ]);
        SchoolYear::findOrFail($this->editedYearId)->update([
            'year_name' => $this->yearName
        ]);
        $this->alert('success', 'Record has been updated successfully');
        $this->dispatchBrowserEvent('hideEditModal');
    }
    public function yearStatusChange($year_id, $year_status)
    {
        $active_year = SchoolYear::where('year_status', 'opened')->count();

        if($year_status == 'closed' && $active_year == 0){
            SchoolYear::findOrFail($year_id)->update([
                'year_status' => 'opened'
            ]);
            $this->alert('success', 'Year has been opened successfully');
            return redirect()->route('admin.academic.years');
        }
        elseif($year_status == 'opened' && $active_year >= 1){
            SchoolYear::findOrFail($year_id)->update([
                'year_status' => 'closed'
            ]);
            $this->alert('success', 'Year has been closed successfully');
            return redirect()->route('admin.academic.years');
        }
        else{
            session()->flash('message', 'Current school year is already set, disable active year to change');
            $this->redirect('/academic-years');
        }
    }
    public function render()
    {
        $academic_years = SchoolYear::latest()->paginate(5);
        return view('livewire.settings.academic-years', [
            'academic_years' => $academic_years
        ]);
    }
}
