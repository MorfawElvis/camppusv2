<?php

namespace App\Http\Livewire\Payroll;

use App\Models\Allowance;
use App\Models\Deduction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PayrollConfigurations extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $allowance_name;
    public $allowance_type;
    public $allowance_percentage;
    public $deduction_name;
    public $deduction_type;
    public $deduction_percentage;
    public $edited_allowance;
    public $deleted_allowance;
    public $edited_deduction;
    public $deleted_deduction;
    public $editMode = false;

    protected $listeners = [
        'deleteAllowance', 'deleteDeduction'
    ];
    public function showAllowanceModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatchBrowserEvent("showAllowanceModal");
    }
    public function createAllowance()
    {
       $this->validateAllowancesFields();
        Allowance::create([
            'allowance_name' => $this->allowance_name,
            'allowance_type' => $this->allowance_type,
            'percentage'     => $this->allowance_type == 'percentage' ? $this->allowance_percentage : Null,
        ]);
        $this->dispatchBrowserEvent("hideAllowanceModal");
        $this->alert('success', 'Record has been saved successfully');

    }
    public function editAllowanceModal($allowance)
    {
        $this->reset();
        $this->resetValidation();
        $this->editMode = true;
        $this->edited_allowance = $allowance['id'];
        $this->allowance_name = $allowance['allowance_name'];
        $this->allowance_type = $allowance['allowance_type'];
        $this->allowance_percentage = $allowance['percentage'];
        $this->dispatchBrowserEvent("showAllowanceModal");
    }
    public function updateAllowance()
    {
        Allowance::findOrFail($this->edited_allowance)->update([
            'allowance_name' => $this->allowance_name,
            'allowance_type' => $this->allowance_type,
            'percentage'     => $this->allowance_type == 'percentage' ? $this->allowance_percentage : Null,
        ]);
        $this->alert('success', 'Record has been updated successfully');
        $this->dispatchBrowserEvent('hideAllowanceModal');
    }

    public function deleteAllowanceModal($allowance_id)
    {
        $this->deleted_allowance =  $allowance_id;
        $this->confirm('',[
            'onConfirmed' => 'deleteAllowance'
        ]);
    }
    public function deleteAllowance()
    {
        Allowance::findOrFail($this->deleted_allowance)->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function showDeductionModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatchBrowserEvent("showDeductionModal");
    }

    public function createDeduction()
    {
        $this->validateDeductionsFields();
        Deduction::create([
            'deduction_name' => $this->deduction_name,
            'deduction_type' => $this->deduction_type,
            'percentage'     => $this->deduction_type == 'percentage' ? $this->deduction_percentage : Null,
        ]);
        $this->alert('success', 'Record has been saved successfully');
        $this->dispatchBrowserEvent('hideDeductionModal');
    }
    public function editDeductionModal($deduction)
    {
        $this->reset();
        $this->resetValidation();
        $this->editMode = true;
        $this->edited_deduction = $deduction['id'];
        $this->deduction_name = $deduction['deduction_name'];
        $this->deduction_type = $deduction['deduction_type'];
        $this->deduction_percentage = $deduction['percentage'];
        $this->dispatchBrowserEvent("showDeductionModal");
    }
    public function updateDeduction()
    {
        $this->validateDeductionsFields();
        Deduction::findOrFail($this->edited_deduction)->update([
            'deduction_name' => $this->deduction_name,
            'deduction_type' => $this->deduction_type,
            'percentage'     => $this->deduction_type == 'percentage' ? $this->deduction_percentage : Null,
        ]);
        $this->alert('success', 'Record has been updated successfully');
        $this->dispatchBrowserEvent('hideDeductionModal');
    }
    //Method is fired by delete button in the deductions table
    public function deleteDeductionModal($deduction_id)
    {
        $this->deleted_deduction =  $deduction_id;
        $this->confirm('',[
            'onConfirmed' => 'deleteDeduction'
        ]);
    }
    public function deleteDeduction()
    {
        Deduction::findOrFail($this->deleted_deduction)->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }
    public function validateDeductionsFields()
    {
        $this->validate([
            'deduction_name' => 'required|unique:deductions,deduction_name,'.$this->edited_deduction,
            'deduction_type' => 'required',
        ]);
        if($this->deduction_type == 'percentage'){
            $this->validate([
                'deduction_percentage' => 'required'
            ]);
        }
    }
    public function validateAllowancesFields()
    {
        $this->validate([
            'allowance_name' => 'required|unique:allowances,allowance_name,'.$this->edited_allowance,
            'allowance_type' => 'required',
        ]);
        if($this->allowance_type == 'percentage'){
            $this->validate([
                'allowance_percentage' => 'required'
            ]);
        }
    }
    public function render()
    {
        $allowances = Allowance::paginate(10);
        $deductions = Deduction::paginate(10);
        return view('livewire.payroll.payroll-configurations', compact('allowances', 'deductions'));
    }

}
