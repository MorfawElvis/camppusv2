<?php

namespace App\Http\Livewire\Scholarship;

use App\Models\Scholarship;
use App\Models\ScholarshipCategory;
use Closure;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use View;

class CreateScholarships extends Component
{
    use LivewireAlert, WithPagination;

    public $editMode = false;

    public $scholarship_name;

    public $scholarship_category;

    public $scholarship_coverage;

    public $scholarship_discount;

    public $deletedCategoryId;

    public $editedCategory;

    protected $listeners = [
        'deleteConfirmed',
    ];

    protected $rules = [
        'scholarship_name' => 'required',
        'scholarship_category' => 'required',
        'scholarship_coverage' => 'required',
        'scholarship_discount' => 'required',
    ];

    protected $messages = [
        'scholarship_name.required' => 'Scholarship name cannot be empty',
        'scholarship_category.required' => 'Scholarship category not selected',
        'scholarship_coverage.required' => 'Scholarship coverage not selected',
        'scholarship_discount.required' => 'Scholarship discount not entered',
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
        $this->editedCategory = $category['id'];
        $this->scholarship_name = $category['scholarship_name'];
        $this->scholarship_category = $category['scholarship_category'];
        $this->scholarship_coverage = $category['scholarship_coverage'];
        $this->scholarship_discount = $category['discount'];
        $this->dispatchBrowserEvent('showScholarshipCategoryModal');
    }

    public function createCategory()
    {
        $this->validate();
        ScholarshipCategory::create([
            'scholarship_name' => $this->scholarship_name,
            'scholarship_category' => $this->scholarship_category,
            'scholarship_coverage' => $this->scholarship_coverage,
            'discount' => $this->scholarship_discount,
        ]);
        $this->alert('success', 'Record has been saved successfully');
        $this->dispatchBrowserEvent('hideScholarshipCategoryModal');
    }

    public function editCategory()
    {
        $this->validate();
        ScholarshipCategory::findOrFail($this->editedCategory)->update([
            'scholarship_name' => $this->scholarship_name,
            'scholarship_category' => $this->scholarship_category,
            'scholarship_coverage' => $this->scholarship_coverage,
            'discount' => $this->scholarship_discount,
        ]);
        $this->alert('success', 'Record has been updated successfully');
        $this->dispatchBrowserEvent('hideScholarshipCategoryModal');
    }

    public function deleteScholarshipCategory($category)
    {
        $this->deletedCategoryId = $category;
        $this->confirm('', [
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }

    public function deleteConfirmed()
    {
        ScholarshipCategory::find($this->deletedCategoryId)->delete();
        Scholarship::where('scholarship_category_id', $this->deletedCategoryId)->delete();

        $this->alert('success', 'Record has been deleted successfully');
        $this->dispatchBrowserEvent('hideScholarshipCategoryModal');
    }
}
