<div>
    @section('title', 'Student Category')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Student Category
        </div>
        <div class="card-body">
            <a wire:click.prevent="showStudentCategoryModal"  class="btn btn-outline-primary rounded-pill float-right mb-2" 
            wire:ignore>
                <i class="fas fa-plus-circle mr-2"></i>
                Create Student Category
            </a>
            <table class="table table-striped table-hover table-responsive-lg mt-4">
                <caption class="mt-2"></caption>
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Category</th>
                    <th>Category Fee</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                   @forelse ($student_categories as $category)
                       <tr>
                           <td>{{ $loop->index+1  }}</td>
                           <td>{{ $category->category_type }}</td>
                           <td>{{ number_format($category->category_fee) . ' XAF' }}</td>
                           <td class="text-center">
                                <span><a wire:click.prevent="editModal({{ $category }})" class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                                <span><a wire:click.prevent="deleteCategory({{ $category->id }})" class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                           </td>
                       </tr>
                   @empty
                     <td colspan="4"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                   @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="studentCategoryModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Student Category' : 'Create Student Category' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editCategory' : 'createCategory'}}" class="form-floating">
                        <div class="form-floating mb-4">
                            <select class="form-select @error('category_type') is-invalid @enderror" wire:model.lazy="category_type">
                                    <option value=" {{ $editMode ? $editedCategoryId : '' }}" selected>{{ $editMode ? $category_type : 'Open this select menu' }}</option>
                                @foreach(\App\Models\StudentCategory::STUDENT_CATEGORY_TYPE as $key => $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                            @error('category_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Select Category</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="category_fee" class="form-control number-separator @error('category_fee') is-invalid @enderror"
                                   placeholder="Enter Amount">
                            @error('category_fee')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Category Fee</label>
                        </div>
                        <x-modal-buttons>{{$editMode ? 'Save Changes' : 'Save Record'}}</x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showStudentCategoryModal', event => {
            $('#studentCategoryModal').modal('show');
        });
        window.addEventListener('hideStudentCategoryModal', event => {
            $('#studentCategoryModal').modal('hide');
        });
    </script>
@endpush

