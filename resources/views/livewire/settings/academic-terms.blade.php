<div>
    @section('title', 'Academic Terms')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-calendar-alt mr-2"></i>Academic Terms
        </div>
        <div class="card-body">
            <x-error></x-error>
            <a wire:click="createTermModal" class="btn btn-outline-primary rounded-pill float-right mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Create Term</a>
            <table class="table table table-striped table-hover table-responsive-lg text-center">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Term Name</th>
                    <th>Status</th>
                    <th>Academic Year</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($academic_terms as $academic_term)
                    <tr>
                        <td>{{ $academic_terms->firstItem() + $loop->index }}</td>
                        <td>{{ $academic_term->term_name}}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input wire:click="termStatusChange({{ $academic_term->id }}, '{{ $academic_term->term_status }}')" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                       @if($academic_term->term_status == 'opened') checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </td>
                        <td>{{ $academic_term->school_year->year_name ?? ''}}</td>
                        <td>
                            <span><a class="btn btn-xs btn-primary" wire:click.prevent="editModal({{ $academic_term}})"><i class="fas fa-edit me-2"></i>Edit</a></span>
                            <span><a class="btn btn-xs btn-danger" wire:click.prevent="confirmTermDelete({{$academic_term->id}})"><i class="fas fa-trash me-2"></i>Delete</a></span>
                        </td>
                    </tr>
                @empty
                    <tr  class="text-center">
                        <td colspan="5"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $academic_terms->links() }}
        </div>
    </div>
    {{-- Academic Term Modal Form--}}
    <div class="modal fade" id="termModalForm" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="academicTermLabel"><i class="fas fa-plus-circle mr-2"></i>{{$editMode ? 'Edit Term' : 'Add Term'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $editMode ? 'editTerm' : 'createTerm' }}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.defer="termName" class="form-control @error('termName') is-invalid @enderror" id="academicTerm"
                                   placeholder="Enter Academic Term">
                            @error('termName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <small>For example First Term or Term 1</small>
                            <label for="academicTerm" class="required">Term Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select @error('academicYear') is-invalid @enderror" wire:model.defer="academicYear">
                                @if($editMode)
                                    <option value="{{ $editedYearId }}">{{ $editedYearName}}</option>
                                @else
                                    <option value="" selected>Open this select menu</option>
                                    <option value="{{ $academic_year->id ?? '' }}">{{ $academic_year->year_name ?? '' }}</option>
                                @endif
                            </select>
                            @error('academicYear')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="floatingSelect" class="required">Select academic year</label>
                        </div>
                        <x-modal-buttons :edit-mode="$editMode"></x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script>
            window.addEventListener('showTermModal', event => {
                $('#termModalForm').modal('show');
            });
            window.addEventListener('hideTermModal', event => {
                $('#termModalForm').modal('hide');
            });
        </script>
        @endpush
</div>
