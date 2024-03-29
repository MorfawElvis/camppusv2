<div>
    @section('title', 'Create Scholarships')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Create Scholarships
        </div>
        <div class="card-body">
            <a wire:click.prevent="showScholarshipCategoryModal"  class="btn btn-outline-primary rounded-pill float-right mb-2"
            wire:ignore>
                <i class="fas fa-plus-circle mr-2"></i>
                Create Scholarship
                </a>
            <table class="table table-striped table-hover table-responsive-lg mt-4">
                <caption class="mt-2">{{ $scholarship_categories->links() }}</caption>
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Scholarship</th>
                    <th>Category</th>
                    <th>Coverage</th>
                    <th>Discount</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($scholarship_categories as $category )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->scholarship_name }}</td>
                    <td>{{ $category->scholarship_category }}</td>
                    <td>{{ $category->scholarship_coverage }}</td>
                    <td>{{ number_format($category->discount) }} <span class="ms-1">XAF</span></td>
                    <td class="text-center">
                        <span><a wire:click.prevent="editModal({{ $category }})" class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                        <span><a  wire:click.prevent="deleteScholarshipCategory({{ $category->id }})" class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                    </td>
                </tr>
                @empty
                <tr  class="text-center">
                    <td colspan="6><i class="fas fa-question-circle mr-2"></i>No record found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="scholarshipCategoryModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Scholarship' : 'Create Scholarship' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editCategory' : 'createCategory'}}">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="scholarship_name" class="form-control text-capitalize @error('scholarship_name') is-invalid @enderror"
                                   placeholder="Enter Level">
                            @error('scholarship_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Scholarship Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select @error('scholarship_category') is-invalid @enderror" wire:model.lazy="scholarship_category">
                                 @if ($editMode)
                                 <option value="{{ $scholarship_category }}" selected>{{ $scholarship_category }}</option>
                                 @else
                                  <option selected>Open this select menu</option>
                                 @endif
                                @foreach(\App\Models\ScholarshipCategory::SCHOLARSHIP_CATEGORIES as $key => $s_category)
                                    <option value="{{ $key }}">{{ $s_category }}</option>
                                @endforeach
                            </select>
                            @error('scholarship_category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Select Scholarship Category</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select @error('scholarship_coverage') is-invalid @enderror" wire:model.lazy="scholarship_coverage">
                                @if ($editMode)
                                     <option value="{{ $scholarship_coverage }}" selected>{{ $scholarship_coverage }}</option>
                                     @else
                                     <option selected>Open this select menu</option>
                                @endif
                                @foreach(\App\Models\ScholarshipCategory::SCHOLARSHIP_COVERAGE as $key => $s_coverage)
                                    <option value="{{ $s_coverage }}">{{ $s_coverage }}</option>
                                @endforeach
                            </select>
                            @error('scholarship_coverage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Select Scholarship Coverage</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" wire:model.lazy="scholarship_discount"  class="form-control  number-separator  @error('scholarship_discount') is-invalid @enderror">
                            @error('scholarship_discount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Amount</label>
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
        window.addEventListener('showScholarshipCategoryModal', event => {
            $('#scholarshipCategoryModal').modal('show');
        });
        window.addEventListener('hideScholarshipCategoryModal', event => {
            $('#scholarshipCategoryModal').modal('hide');
        });
    </script>
@endpush
