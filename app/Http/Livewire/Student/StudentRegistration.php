<?php

namespace App\Http\Livewire\Student;

use Illuminate\View\View;
use Livewire\Component;

class StudentRegistration extends Component
{
    public function render():View
    {
        return view('livewire.student.student-registration');
    }
}
