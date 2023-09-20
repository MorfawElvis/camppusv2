<?php

namespace App\Http\Livewire\Settings;

use App\Models\GeneralSetting;
use App\Traits\DataFetch;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class SchoolSettings extends Component
{
    use WithFileUploads, DataFetch, LivewireAlert;

    public $form = [];

    public $schoolSettings;

    public $school_logo;

    protected $rules = [
        'form.school_name' => 'required|string',
        'form.school_address' => 'required|string|max:30',
        'form.school_email' => 'required|email',
        'form.school_phone_number' => 'required|digits_between:9,9',
    ];

    public function mount()
    {
        //TODO: Refactor and set $schoolSettings as global helper

        $this->schoolSettings = $this->getFirstData(new GeneralSetting());
        if ($this->schoolSettings) {
            $this->form = $this->schoolSettings->toArray();
        }
    }

    public function createSettings()
    {
        $schoolSettings = $this->getFirstData(new GeneralSetting());

        if ($schoolSettings) {
            $this->updateImage();
            $schoolSettings->update($this->form);
            $this->alert('success', 'Settings updated successfully');

            return redirect()->route('admin.general.settings');
        } else {
            $this->validate();
            $logo = $this->storeImage();
            $this->form['school_logo'] = $logo;
            GeneralSetting::create($this->form);
            $this->alert('success', 'Settings saved successfully');

            return redirect()->route('admin.general.settings');
        }
    }

    public function storeImage()
    {
        if (! $this->school_logo) {
            return null;
        }
        $img = ImageManagerStatic::make($this->school_logo)->resize(80, 80)->encode('jpg');
        $name = 'school_logo.jpg';
        Storage::disk('public')->put('public/logo/'.$name, $img);

        return $name;
    }

    public function updateImage()
    {
        $schoolSettings = $this->getFirstData(new GeneralSetting());
        if ($this->school_logo) {
            Storage::disk('public')->delete('public/logo/'.$schoolSettings->school_logo);
            $logo = $this->storeImage();
            $this->form['school_logo'] = $logo;
        }
    }

    public function render()
    {
        return view('livewire.settings.school-settings');
    }
}
