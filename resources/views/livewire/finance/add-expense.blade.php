<div>
    @section('title', 'Add Expense')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Add Expense
        </div>
        <div class="card-body">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        Create expense categories before adding new expenses!
                    </div>
                </div>
                <div>
                    <a wire:click.prevent="showAddExpenseModal" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-plus-circle mr-2"></i>Add Expense</a>
                </div>
            </div>
                <table class="table table-striped table-hover table-responsive-lg">
                    <caption></caption>
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Entry Date</th>
                        <th class="text-center">Remarks</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expenses->firstItem() + $loop->iteration }}</td>
                            <td>{{ $expense->expense_item }}</td>
                            <td>{{ number_format($expense->expense_amount)}} XAF</td>
                            <td>{{ \Carbon\Carbon::parse($expense->entry_date)->format('d M Y') }}</td>
                            <td class="text-center">{{ $expense->expense_description ?? '--' }}</td>
                            <td class="text-center">
                                <span><a class="btn btn-xs btn-primary" wire:click.prevent="editModal({{ $expense }})" ><i class="fas fa-edit mr-2"></i>Edit</a></span>
                                <span><a class="btn btn-xs btn-danger " wire:click.prevent="deleteExpense({{ $expense->id }})" ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                            </td>
                        </tr>
                    @empty
                        <tr  class="text-center">
                            <td colspan="6"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="addExpenseModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Expense' : 'Add Expense' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ !$editMode ? 'addExpense' : 'editExpense' }}" class="form-floating">
                        <div class="form-floating mb-3">
                            <select wire:model.lazy="expense_category_id" class="form-select @error('expense_category_id') is-invalid @enderror" required>
                              <option selected>Open this select menu</option>
                              @foreach ($expense_categories as $category )
                              <option value="{{ $category->id  }}">{{ $category->category_name }}</option>
                              @endforeach
                            </select>
                            @error('expense_category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="floatingSelect" class="required">Expense Category</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text"  wire:model.lazy="expense_item" class="form-control @error('expense_item') is-invalid @enderror">
                            @error('expense_item')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Expense Item</label>
                            <small>e.g Chalk</small>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text"  wire:model.lazy="expense_amount" class="form-control number-separator @error('expense_amount') is-invalid @enderror">
                            @error('expense_amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Amount</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" wire:model.lazy='entry_date' class="form-control @error('entry_date') is-invalid @enderror">
                            <small>Format: mm/dd/yyyy</small>
                            @error('entry_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required" for="floatingInput">Entry Date</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea wire:model.lazy="expense_description" class="form-control"  placeholder="Description" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Remarks</label>
                        </div>
                        <x-modal-buttons :edit-mode="$editMode"></x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
    <script>
       window.addEventListener('showAddExpenseModal', event => {
            $('#addExpenseModal').modal('show');
        });
        window.addEventListener('hideAddExpenseModal', event => {
            $('#addExpenseModal').modal('hide');
        });
        $(".date").datepicker({
        format: "dd-mm-yyyy",
        });
    </script>
@endpush
