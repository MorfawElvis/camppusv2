<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;

class FeeItems extends Component
{
    public $editMode = false;
    
    public function render()
    {
        return view('livewire.finance.fee-items');
    }
}
