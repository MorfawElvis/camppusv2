<?php

namespace App\Http\Livewire\Finance;

use App\Models\ExtraFee;
use Livewire\Component;

class ExtraFeeItems extends Component
{
    public $editMode = false;

    public $fee_item;

    public $fee_item_id;

    public $extra_fee_items;

    protected $listeners = [
       'refreshFeeItem' => 'reloadFeeItem',
        'loadExtraFeeComponent'  => 'mount'
    ];

    public function mount()
    {
        $this->extra_fee_items = ExtraFee::all();
    }

    public function createFeeItem()
    {
        $this->validate([
            'fee_item' => 'required|string|unique:extra_fees,name'
        ]);

        ExtraFee::create([
            'name' => $this->fee_item
        ]);
        $this->reset('fee_item');
        $this->reloadFeeItem();
    }

    public function editFeeItem($fee_item)
    {
        $this->editMode = true;
        $this->fee_item_id = $fee_item['id'];
        $this->fee_item    = $fee_item['name'];

    }

    public function updateFeeItem()
    {
        $this->validate([
            'fee_item' => 'required|string|unique:extra_fees,name,'.$this->fee_item_id
        ]);
        ExtraFee::findOrFail($this->fee_item_id)->update([
            'name' => $this->fee_item
        ]);
        $this->reset('fee_item');
        $this->editMode = false;
        $this->reloadFeeItem();
    }

    public function deleteFeeItem($fee_item_id)
    {
        ExtraFee::findOrFail($fee_item_id)->delete();
        $this->reloadFeeItem();
    }

    public function reloadFeeItem()
    {
        $this->extra_fee_items = ExtraFee::all();
    }

    public function render()
    {
        return view('livewire.finance.extra-fee-items');
    }
}
