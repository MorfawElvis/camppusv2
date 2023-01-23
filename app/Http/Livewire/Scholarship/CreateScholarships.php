<?php

namespace App\Http\Livewire\Scholarship;

use App\Models\ScholarshipCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CreateScholarships extends Component
{
    use LivewireAlert, WithPagination;
    public $editMode = false;

    public $scholarship_name, $scholarship_category, $scholarship_coverage, $scholarship_discount;

    protected $rules = [
           'scholarship_name'     => 'required',
           'scholarship_category' => 'required',
           'scholarship_coverage' => 'required',
    ];

    protected $messages = [
        'scholarship_name.required'     => 'Schorlaship name cannot be empty',
        'scholarship_category.required' => 'Scholarship category not selected',
        'scholarship_coverage.required' => 'Scholarship coverage not selected',
    ];
    public function render()
    {
        $scholarship_categories = ScholarshipCategory::paginate(10);
        return view('livewire.scholarship.create-scholarships', compact('scholarship_categories'));
    }

    public function showScholarshipCategoryModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showScholarshipCategoryModal');
    }

    public function editModal($category)
    {
        $this->reset();
        $this->editMode = true;
    }

    public function createCategory()
    {
        if($this->scholarship_coverage == 'partial'){
            $this->validate([
                'scholarship_discount' => 'required'
            ]);
        }
        $this->validate();
        ScholarshipCategory::create([
            'scholarship_name' => $this->scholarship_name,
            'scholarship_category' => $this->scholarship_category,
            'scholarship_coverage' => $this->scholarship_coverage,
            'discount' => $this->scholarship_discount ?? 100
        ]);
        $this->alert('success', 'Record has been saved successfully');
        $this->dispatchBrowserEvent('hideScholarshipCategoryModal');
    }

    public function editCategory()
    {
        
    }
}
