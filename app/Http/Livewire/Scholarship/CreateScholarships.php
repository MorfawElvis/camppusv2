<?php

namespace App\Http\Livewire\Scholarship;

use Livewire\Component;

class CreateScholarships extends Component
{
    public $editMode = false;

    public function render()
    {
        return view('livewire.scholarship.create-scholarships');
    }
}
