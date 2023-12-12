<div>
    @section('title', 'Manage Departments')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Manage Departments
        </div>
        <div class="card-body">
            <a wire:click.prevent="showDepartmentModal" class="btn btn-outline-primary rounded-pill float-right mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Create Department</a>
            <table class="table table-striped table-hover table-responsive-lg">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Department Name</th>
                    <th class="text-center">Head of Department (HOD)</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($departments as $department)
                    <tr>
                        <td>{{ $departments->firstItem() + $loop->index }}</td>
                        <td>{{ $department->department_name }}</td>
                        <td class="text-center">{{ $department->user->name ?? '--' }}</td>
                        <td class="text-center">
                            <span><a class="btn btn-xs btn-primary" wire:click.prevent="editModal({{ $department }})"><i class="fas fa-edit mr-2"></i>Edit</a></span>
                            <span><a class="btn btn-xs btn-danger" wire:click.prevent="confirmDelete({{ $department->id }})"><i class="fas fa-trash mr-2"></i>Delete</a></span>
                        </td>
                    </tr>
                    @empty
                    <tr  class="text-center">
                        <td colspan="4"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $departments->links() }}
        </div>
    </div>
    {{-- Department Modal --}}
    <div class="modal fade" id="departmentModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Department' : 'Create Department' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editDepartment' : 'createDepartment'}}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="departmentName" class="form-control @error('departmentName') is-invalid @enderror" id="department"
                                   placeholder="Enter Academic Department">
                            @error('departmentName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="department" class="required">Department Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" wire:model.lazy="department_head" id="floatingSelect" aria-label="Floating label select hod">
                                <option value="" selected>Open this select menu</option>
                                <option value="1">One</option>
                            </select>
                            <label for="floatingSelect">Select Head of Department</label>
                        </div>
                        <x-modal-buttons :edit-mode="$editMode"></x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--/ Department --}}
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showDepartmentModal', event => {
            $('#departmentModal').modal('show');
        });
        window.addEventListener('hideDepartmentModal', event => {
            $('#departmentModal').modal('hide');
        });
    </script>
@endpush
