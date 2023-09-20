<?php

namespace App\Http\Livewire\Finance;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AddExpense extends Component
{
    use WithPagination, LivewireAlert;

    public $editMode = false;

    public $expense_category_id;

    public $expense_amount;

    public $entry_date;

    public $expense_description;

    public $editedExpenseId;

    public $deletedExpenseId;

    public $expense_item;

    protected $listeners = [
        'deleteConfirmed',
    ];

    protected $rules = [
        'expense_category_id' => 'required',
        'expense_amount' => 'required',
        'expense_item' => 'required',
        'entry_date' => 'required',
    ];

    protected $messages = [
        'expense_category_id.required' => 'The Exepense category is not selected',
        'expense_item.required' => 'The Expense item cannot be empty',
        'expense_amount.required' => 'The Expense ammount cannot be empty',
        'entry_date' => 'The Entry date cannot be empty',
    ];

    public function render()
    {
        $expense_categories = ExpenseCategory::select('id', 'category_name')->get();
        $expenses = Expense::with('expense_category')->paginate(10);

        return view('livewire.finance.add-expense', compact('expense_categories', 'expenses'));
    }

    public function showAddExpenseModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showAddExpenseModal');
    }

    public function addExpense()
    {
        $this->validate();
        Expense::create([
            'expense_category_id' => $this->expense_category_id,
            'expense_item' => $this->expense_item,
            'expense_amount' => $this->expense_amount,
            'entry_date' => $this->entry_date,
            'enteredBy_id' => auth()->user()->id,
            'expense_description' => $this->expense_description,
        ]);
        $this->dispatchBrowserEvent('hideAddExpenseModal');
        $this->alert('success', 'Record has been saved successfully');
    }

    public function editModal($expense)
    {
        $this->reset();
        $this->editMode = true;
        $this->editedExpenseId = $expense['id'];
        $this->expense_category_id = $expense['expense_category']['id'] ?? '';
        $this->expense_item = $expense['expense_item'];
        $this->expense_amount = $expense['expense_amount'];
        $this->entry_date = $expense['entry_date'];
        $this->expense_description = $expense['expense_description'];
        $this->dispatchBrowserEvent('showAddExpenseModal');
    }

    public function editExpense()
    {
        $this->validate();
        Expense::findOrFail($this->editedExpenseId)->update([
            'expense_category_id' => $this->expense_category_id,
            'expense_item' => $this->expense_item,
            'expense_amount' => $this->expense_amount,
            'entry_date' => $this->entry_date,
            'enteredBy_id' => auth()->user()->id,
            'expense_description' => $this->expense_description,
        ]);
        $this->dispatchBrowserEvent('hideAddExpenseModal');
        $this->alert('success', 'Record has been updated successfully');
    }

    public function deleteExpense($expense_id)
    {
        $this->deletedExpenseId = $expense_id;
        $this->confirm('', [
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }

    public function deleteConfirmed()
    {
        Expense::destroy($this->deletedExpenseId);
        $this->alert('success', 'Record has been deleted successfully');
    }
}
