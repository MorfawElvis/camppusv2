<?php

namespace App\Http\Livewire\Finance;

use App\Models\ClassRoom;
use App\Models\ExtraFee;
use App\Models\FeeItem;
use App\Models\Student;
use Livewire\Component;

class StudentFeeItems extends Component
{
    public $editMode = false;

    public $class_rooms;

    public $class_id;

    public $students;

    public $student_name;

    public $student_class;

    public $student_id;

    public $extra_fee_id;

    public $extra_fees;

    public $student_withXFees;

    public $extra_fee_amount;

    protected $listeners = [
        'reloadModal' => 'refreshModal'
    ];

    public function mount()
    {
        $this->class_rooms = ClassRoom::all();
    }

    public function loadClassList()
    {
        $this->students =  Student::with('class_room')
            ->whereHas('class_room' , function ($query) {
                $query->where('id', $this->class_id);
            })
            ->get();
    }

    public function createExtraFeeItem()
    {
          Student::find($this->student_id)->extra_fees()->syncWithoutDetaching([
              $this->extra_fee_id => [
                  'amount' => $this->extra_fee_amount
              ]
          ]);
          $this->reset('extra_fee_id', 'extra_fee_amount');
          $this->emit('reloadModal');
    }

    public function deleteExtraFeeItem($extra_fee_id)
    {
        Student::find($this->student_id)->extra_fees()->detach([$extra_fee_id]);
        $this->emit('reloadModal');
    }

    public function showStudentFeeModal($student)
    {
        $this->student_name  = $student['full_name'];
        $this->student_class = $student['class_room']['class_name'];
        $this->student_id    = $student['id'];
        $this->student_withXFees = Student::find($this->student_id)->extra_fees()->get();
        $this->dispatchBrowserEvent('showStudentFeeModal');
    }

    public function refreshModal()
    {
        $this->student_withXFees = Student::find($this->student_id)->extra_fees()->get();
    }

    public function loadExtraFeeComponent()
    {
        $this->emit('loadFeeItems');
    }

    public function render()
    {
        $extra_fee_items = ExtraFee::get();

        return view('livewire.finance.student-fee-items', compact('extra_fee_items'));
    }

}
