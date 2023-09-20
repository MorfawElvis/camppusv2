<?php

namespace App\Http\Livewire\Finance;

use App\Models\FeeItem;
use Livewire\Component;

class FeeItems extends Component
{
    public $class_name;

    public $class_fee;

    public $class_id;

    public $name;

    public $amount;

    public $class_fee_items = [];

    protected $rules = [
        'amount' => 'required',
        'name'   => 'required'
    ];

    protected $listeners = [
            'feeItemDetails',
            'recordCreated' => 'refreshModal'
    ];

    public function feeItemDetails($id)
    {
        $this->class_id = $id;
        $this->class_fee_items = FeeItem::where('class_room_id', $id)->get();
    }

    public function createFeeItem()
    {
        $this->validate();
        FeeItem::create([
            'class_room_id' => $this->class_id,
            'name'          => $this->name,
            'amount'        => $this->amount
        ]);
        $this->reset('name', 'amount');
        $this->emit('recordCreated');
    }

    public function deleteFeeItem($itemId)
    {
        FeeItem::findOrFail($itemId)->delete();
        $this->emitSelf('refreshModal');

    }

    public function refreshModal()
    {
        $this->class_fee_items = FeeItem::where('class_room_id', $this->class_id)->get();
    }
    public function render()
    {
        return view('livewire.finance.fee-items');
    }
}
