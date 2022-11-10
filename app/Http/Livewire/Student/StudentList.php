<?php

namespace App\Http\Livewire\Student;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentList extends Component
{
    use WithPagination,LivewireAlert;

    public $deletedStudent, $search, $perPage;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
           'deleteConfirmed'
    ];

    public function render()
    {
        $students = Student::search($this->search)
                     ->with('user', 'class_room')
                     ->whereHas('user', function($query){
                        $query->where('user_status', '=', '1');
                       })
                     ->simplePaginate($this->perPage);
        return view('livewire.student.student-list', compact('students'));
    }

    public function deleteStudent($user_id)
    {
        $this->deletedStudent = $user_id;
        $this->confirm('',[
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }
    public function deleteConfirmed(){
          User::destroy($this->deletedStudent);
          Student::where('user_id', $this->deletedStudent)->delete();
          $this->alert('success' ,'Record has been deleted successfully');
    }
}
