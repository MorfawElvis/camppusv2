<?php

namespace App\Http\Livewire\Academics;

use App\Models\Level;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Levels extends Component
{
    use WithPagination,LivewireAlert;

    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    public $levelName;

    public $levelRank;

    public $deletedLevel;

    public $levelEditedId;

    protected $listeners = [
        'deleteLevel',
    ];

    public $level_ranks = [
        1, 2, 3, 4, 5, 6, 7,
    ];

    public function showLevelsModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showLevelsModal');
    }

    public function createLevel()
    {
        $this->validate([
            'levelName' => 'required|string',
            'levelRank' => 'required',
        ], [
            'levelName.required' => 'The :attribute cannot be empty',
            'levelRank.required' => 'The :attribute cannot be empty',
            'levelRank.unique' => 'The :attribute is already assigned to another level',
        ]);
        Level::create([
            'level_name' => $this->levelName,
            'level_rank' => $this->levelRank,
        ]);
        $this->dispatchBrowserEvent('hideLevelsModal');
        $this->alert('success', 'The record has been added successfully');
    }

    public function editModal($level)
    {
        $this->reset();
        $this->levelName = $level['level_name'];
        $this->levelEditedId = $level['id'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showLevelsModal');
    }

     public function editLevel()
     {
         $this->validate([
             'levelName' => 'required|string',
         ], [
             'levelName.required' => 'The :attribute cannot be empty',
         ]);

         Level::findOrFail($this->levelEditedId)->update([
             'level_name' => $this->levelName,
         ]);
         $this->dispatchBrowserEvent('hideLevelsModal');
         $this->alert('success', 'Record has been updated successfully');
     }

    public function confirmDeleteLevel($level_id)
    {
        $this->deletedLevel = $level_id;
        $this->confirm('Are you sure you want to delete this record', [
            'onConfirmed' => 'deleteLevel',
        ]);
    }

    public function deleteLevel()
    {
        Level::destroy($this->deletedLevel);
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /* filter existing level rank from database and exclude from rank options */
        $levels_rank_db = Level::pluck('level_rank')->toArray();
        $rank_options = array_diff($this->level_ranks, $levels_rank_db);
        $levels = Level::orderBy('id', 'asc')->paginate(7);

        return view('livewire.academics.levels', [
            'levels' => $levels,
            'rank_options' => $rank_options,
        ]);
    }
}
