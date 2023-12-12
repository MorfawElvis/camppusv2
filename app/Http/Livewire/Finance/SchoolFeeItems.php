<?php

namespace App\Http\Livewire\Finance;

use App\Models\ClassRoom;
use App\Models\FeeItem;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolFeeItems extends Component
{
    use WithPagination;

    public $class_name;

    public $class_fee;

    public $class_id;

    public $feeItem_id;

    public $name;

    public $amount;

    public $class_fee_items = [];

    public $editMode = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'amount' => 'required',
        'name'   => 'required'
    ];

    protected $listeners = [
        'reloadModal' => 'refreshModal',
        'refreshComponent' => '$refresh'
    ];

    public function showFeeItemModal($class_room)
    {
        $this->class_name = $class_room['class_name'];
        $this->class_id = $class_room['id'];
        $this->class_fee = $class_room['fee_items_sum_amount'];
        $this->class_fee_items = FeeItem::where('class_room_id', $class_room['id'])->get();
        $this->dispatchBrowserEvent('showFeeItemModal');
        $this->emit('reloadModal');
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
        $this->emit('reloadModal');
    }

    public function deleteFeeItem($itemId)
    {
        FeeItem::findOrFail($itemId)->delete();
        $this->emit('reloadModal');

    }

    public function editFeeItem($fee_item)
    {
        $this->editMode = true;
        $this->name = $fee_item['name'];
        $this->amount = $fee_item['amount'];
        $this->feeItem_id = $fee_item['id'];
    }

    public function updateFeeItem()
    {
        FeeItem::findOrFail($this->feeItem_id)->update([
            'name' => $this->name,
            'amount' => $this->amount
        ]);
        $this->emit('reloadModal');
        $this->reset('name', 'amount');
        $this->editMode = false;
    }

    public function refreshModal()
    {
        $this->class_fee_items = FeeItem::where('class_room_id', $this->class_id)->get();
    }

    public function render()
    {
        $class_rooms = ClassRoom::with('feeItems')
            ->where('academic_year_id', current_school_year()->id)
            ->withSum('feeItems', 'amount')
            ->paginate(10);

        return view('livewire.finance.school-fee-items', compact('class_rooms'));
    }
}
