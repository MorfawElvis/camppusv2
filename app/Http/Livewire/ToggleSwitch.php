<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ToggleSwitch extends Component
{
    public Model $model;

    public string $field;

    public bool $isBoarding;

    public function mount()
    {
        $this->isBoarding = (bool) $this->model->getAttribute($this->field);
    }

    public function render()
    {
        return view('livewire.toggle-switch');
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
    }
}
