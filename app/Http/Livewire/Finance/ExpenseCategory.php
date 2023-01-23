<?php

namespace App\Http\Livewire\Finance;

use App\Models\ExpenseCategory as ModelsExpenseCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseCategory extends Component
{
    use LivewireAlert, WithPagination;
    public $editMode = false;

    public $category_name,$editedCategoryId, $deletedCategoryId;

    protected $listeners = [
        'deleteConfirmed'
    ];

    public function render()
    {
        $expense_categories = ModelsExpenseCategory::select('id','category_name')->paginate(10);
        return view('livewire.finance.expense-category', compact('expense_categories'));
    }

    public function showExpenseCategoryModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showExpenseCategoryModal');
    }

    public function createCategory()
    {
        $this->validate([
            'category_name' => 'required|string|unique:expense_categories,category_name'
        ]);
        ModelsExpenseCategory::create([
            'category_name'  => $this->category_name,
        ]);
        $this->dispatchBrowserEvent('hideExpenseCategoryModal');
        $this->alert('success', 'Record has been saved successfully');
    }
    
    public function editModal($category)
    {
        $this->reset();
        $this->editMode = true;
        $this->editedCategoryId = $category['id'];
        $this->category_name    = $category['category_name'];
        $this->dispatchBrowserEvent('showExpenseCategoryModal');
    }
    public function editCategory()
    {
        $this->validate([
            'category_name' => 'required|string|unique:expense_categories,category_name,'.$this->editedCategoryId,
        ]);
        ModelsExpenseCategory::findOrFail($this->editedCategoryId)->update([
            'category_name'  => $this->category_name,
        ]);
        $this->dispatchBrowserEvent('hideExpenseCategoryModal');
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
          ModelsExpenseCategory::destroy($this->deletedCategoryId);
          $this->alert('success' ,'Record has been deleted successfully');
    }
}
