<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use App\Models\ExtraFee as ModelsExtraFee;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class ExtraFee extends Component
{
    use LivewireAlert, WithPagination;
    public $fee_type, $amount, $deletedFeeId, $editedFeeId;
    public $editMode = false;

    protected $listeners = [
        'deleteConfirmed'
    ];

    public function showExtraFeeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showExtraFeeModal');
    }

    public function createFee()
    {
        $this->validate([
            'fee_type'    => 'required|unique:extra_fees,fee_type',
            'amount'      => 'required'
        ],
        ['amount.required' => 'Please enter amount',
         'fee_type.required' => 'Please select fee type',
         'fee_type.unique' => 'Sorry, this fee type already exist',
         ]
        );
        ModelsExtraFee::create([
             'fee_type'            => $this->fee_type,
             'amount'              => $this->amount,
        ]);
        $this->alert('success' ,'Record has been added successfully');
        $this->dispatchBrowserEvent('hideExtraFeeModal');
    }
    
    public function editModal($extra_fee)
    {
        $this->reset();
        $this->editMode = true;
        $this->editedFeeId      = $extra_fee['id'];
        $this->fee_type         = $extra_fee['fee_type'];
        $this->amount           = $extra_fee['amount'];
        $this->dispatchBrowserEvent('showExtraFeeModal');
    }

    public function editFee()
    {
        $this->validate([
            'fee_type'    => 'required|unique:extra_fees,fee_type,'.$this->editedFeeId,
            'amount'      => 'required'
        ],
        ['amount.required' => 'Please enter amount',
         'fee_type.required' => 'Please select fee type',
         'fee_type.unique' => 'Sorry, the fee type already exist',
         ]
        );
        ModelsExtraFee::findOrFail($this->editedFeeId)->update([
            'fee_type'  => $this->fee_type,
            'amount'    => $this->amount
        ]);
        $this->dispatchBrowserEvent('hideExtraFeeModal');
        $this->alert('success', 'Record has been updated successfully');

    }

    public function deleteFee($fee_id)
    {  
        $this->deletedFeeId = $fee_id;
        $this->confirm('',[
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }
    public function deleteConfirmed(){
        ModelsExtraFee::destroy($this->deletedFeeId);
        $this->alert('success' ,'Record has been deleted successfully');
    }
    public function render()
    {
        $extra_fees = ModelsExtraFee::all();
        return view('livewire.finance.extra-fee', compact('extra_fees'));
    }
}
