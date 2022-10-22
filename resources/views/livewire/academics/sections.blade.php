<div>
    @section('title', 'Manage Sections')
    <div class="card mt-4  mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class=" fas fa-arrow-alt-circle-down mr-1"></i>Manage Sections
        </div>
        <div class="card-body">
            <a wire:click="showSectionModal" class="btn btn-outline-primary rounded-pill float-right mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Create Section</a>
            <table class="table table-striped table-hover table-responsive-lg">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Section Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sections as $section)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $section->section_name }}</td>
                        <td class="text-center">
                            <a  class="btn btn-xs btn-outline-primary"><i class="fas fa-info-circle mr-1"></i>View</a>
                            <a  wire:click="editModal({{ $section}})" class="btn btn-xs btn-success"><i class="fas fa-edit mr-1"></i>Edit</a>
                            <a  wire:click="confirmDelete({{ $section->id }})" class="btn btn-xs btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr  class="text-center">
                        <td colspan="3"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- section modal --}}
    <div class="modal fade" id="sectionModalForm" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Section' : 'Create Section' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editSection' : 'createSection'}}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.debounce.500ms="sectionName" class="form-control @error('sectionName') is-invalid @enderror" id="academicSection"
                                   placeholder="Enter section name">
                            @error('sectionName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <small>For example Commercial</small>
                            <label class="required">Section Name</label>
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
        window.addEventListener('showSectionModal', event=> {
            $('#sectionModalForm').modal('show');
        });
        window.addEventListener('hideSectionModal', event=> {
            $('#sectionModalForm').modal('hide');
        });
    </script>
@endpush
