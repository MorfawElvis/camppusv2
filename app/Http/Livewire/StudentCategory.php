<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StudentCategory as S_Category;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentCategory extends Component
{
    use LivewireAlert, WithPagination;
    public $category_type, $category_fee, $deletedCategoryId, $editedCategoryId;
    public $editMode = false;

    protected $listeners = [
        'deleteConfirmed'
    ];

    public function showStudentCategoryModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showStudentCategoryModal');
    }

    public function createCategory()
    {
        $this->validate([
            'category_type'    => 'required|unique:student_categories,category_type',
            'category_fee'      => 'required'
        ],
        ['category_type.required' => 'Please select category',
         'category_fee.required' => 'Please enter category fee',
         'category_type.unique' => 'Sorry, this category already exist',
         ]
        );
        S_Category::create([
             'category_type'             => $this->category_type,
             'category_fee'              => $this->category_fee,
        ]);
        $this->alert('success' ,'Record has been added successfully');
        $this->dispatchBrowserEvent('hideStudentCategoryModal');
    }
    
    public function editModal($category)
    {
        $this->reset();
        $this->editMode = true;
        $this->editedCategoryId      = $category['id'];
        $this->category_type         = $category['category_type'];
        $this->category_fee           = $category['category_fee'];
        $this->dispatchBrowserEvent('showStudentCategoryModal');
    }

    public function editCategory()
    {
        $this->validate([
            'category_type'    => 'required|unique:student_categories,category_type,'.$this->editedCategoryId,
            'category_fee'      => 'required'
        ],
        ['category_type.required' => 'Please select category',
         'category_fee.required' => 'Please enter category fee',
         'category_type.unique' => 'Sorry, the fee type already exist',
         ]
        );
        S_Category::findOrFail($this->editedCategoryId)->update([
            'category_type'  => $this->category_type,
            'category_fee'    => $this->category_fee
        ]);
        $this->dispatchBrowserEvent('hideStudentCategoryModal');
        $this->alert('success', 'Record has been updated successfully');

    }

    public function deleteCategory($category_id)
    {  
        $this->deletedCategoryId = $category_id;
        $this->confirm('',[
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }
    public function deleteConfirmed(){
        S_Category::destroy($this->deletedCategoryId);
        $this->alert('success' ,'Record has been deleted successfully');
    }
    
    public function render()
    {
        $student_categories =  S_Category::all();
        return view('livewire.student-category', compact('student_categories'));
    }
}
