<div>
    @section('title', 'Manage Subjects')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Manage Subjects
        </div>
        <div class="card-body">
            <a wire:click.prevent="showSubjectModal" class="btn btn-outline-primary rounded-pill float-right mb-2" id="add-button">
                <i class="fas fa-plus-circle mr-2"></i>Create Subject</a>
            <table class="table table-striped table-hover table-responsive-lg">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Subject Name</th>
                    <th class="text-center">Subject Code</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        @if($subject->subject_code)
                        <td class="text-center">{{ $subject->subject_code}}</td>
                        @else
                            <td class="text-center">{{'--'}}</td>
                        @endif
                        <td class="text-center">{{ $subject->department->department_name ?? '--' }}</td>
                        <td class="text-center">
                            <span><a class="btn btn-xs btn-primary" wire:click.prevent="editModal({{ $subject }})" ><i class="fas fa-edit mr-2"></i>Edit</a></span>
                            <span><a class="btn btn-xs btn-danger " wire:click.prevent="confirmDelete({{ $subject->id }})" ><i class="fas fa-trash mr-1"></i>Delete</a></span>
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
            <div class="links">
                {{$subjects->links()}}
            </div>
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="subjectModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Subject' : 'Create Subject' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editSubject' : 'createSubject'}}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="subjectName" class="form-control @error('subjectName') is-invalid @enderror"
                                   placeholder="Enter subject name">
                            @error('subjectName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="subject-name" class="required">Subject Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="subjectCode" class="form-control @error('subjectCode') is-invalid @enderror"
                                   placeholder="Enter subject code">
                            @error('subjectCode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="subject-code">Subject Code</label>
                            <small>For example BIO-710</small>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" wire:model.lazy="department" id="floatingSelect" aria-label="Floating label select hod">
                                <option value="" selected>Open this select menu</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Select Department</label>
                        </div>
                        <x-modal-buttons>{{$editMode ? 'Save Changes' : 'Save Record'}}</x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--/ Subject--}}
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showSubjectModal', event => {
            $('#subjectModal').modal('show');
        });
        window.addEventListener('hideSubjectModal', event => {
            $('#subjectModal').modal('hide');
        });
    </script>
@endpush
