<div>
    @section('title', 'Add Expense Category')
    <x-card.card>
        <x-slot:header>Add Expense Category</x-slot:header>
        <x-slot:body>
            <x-table.table :headers="['S/N','Category Name','Actions']">
                <x-card.button-create event="showExpenseCategoryModal">Create Category</x-card.button-create>
                <x-slot:caption></x-slot:caption>
                @forelse($expense_categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <span><a class="btn btn-xs btn-primary" wire:click.prevent="editModal({{ $category }})" ><i class="fas fa-edit mr-2"></i>Edit</a></span>
                            <span><a class="btn btn-xs btn-danger " wire:click.prevent="deleteCategory({{ $category->id }})" ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                        </td>
                    </tr>
                @empty
                    <x-table.record-not-found/>
                @endforelse
                <caption>{{ $expense_categories->links() }}</caption>
            </x-table.table>
        </x-slot:body>
    </x-card.card>
    {{-- Subject Modal --}}
    <div class="modal fade" id="expenseCategoryModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Expense Category' : 'Create Expense Category' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editCategory' : 'createCategory'}}" class="form-floating">
                    <div class="form-floating mb-3">
                        <input type="text" wire:model.debounce.500ms="category_name" class="form-control text-capitalize @error('category_name') is-invalid @enderror"
                               placeholder="Enter category name">
                        @error('category_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <label class="required">Category Name</label>
                        <small>e.g Stationery</small>
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
        window.addEventListener('showExpenseCategoryModal', event => {
            $('#expenseCategoryModal').modal('show');
        });
        window.addEventListener('hideExpenseCategoryModal', event => {
            $('#expenseCategoryModal').modal('hide');
        });
    </script>
@endpush
