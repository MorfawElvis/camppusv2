<div>
    @section('title', 'Manage Classes')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-1"></i>Manage Classes
        </div>
        <div class="card-body">
            <div class="callout callout-warning text-warning fw-bold">
                <i class="fas fa-info-circle"></i> Create a Level before creating a Class.
            </div>
            <a wire:click="showClassModal" class="btn btn-outline-primary rounded-pill float-right mb-2 {{ $academic_year_id ? 'enabled' : 'disabled' }} " wire:ignore>
                <i class="fas fa-plus-circle mr-2"></i>Create Class</a>
            <table class="table table-striped table-hover table-responsive-lg mt-4 text-center">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Class Name</th>
                    <th>Level</th>
                    <th>Section</th>
                    <th>Enrollment</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($class_rooms as $class )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $class->class_name }}</td>
                    <td>{{ $class->level->level_name }}</td>
                    <td>{{ $class->section->section_name }}</td>
                    <td>{{ $class->students_count }}</td>
                    <td class="text-center">
                        <span><button class="btn btn-xs btn-outline-primary"><i class="fas fa-tasks mr-1"></i>Manage Subjects</button></span>
                        <span><a href="{{ route('admin.upload.students', $class->id) }}" class="btn btn-xs btn-primary" ><i class="fas fa-file-import mr-1"></i>Import Students</a></span>
                        <span><a class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
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
        </div>
        <div class="card-footer">

        </div>
    {{-- class modal--}}
    <div class="modal fade" id="classModal"  tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Class' : 'Create Class' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editClass' : 'createClass'}}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="className" class="form-control @error('className') is-invalid @enderror"
                                   placeholder="Enter Level">
                            @error('className')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Class Name</label>
                            <small>For example Form 4A</small>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select @error('section_id') is-invalid @enderror" wire:model.lazy="section_id">
                                <option value="" selected>Open this select menu</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                            @error('section_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Select section</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select @error('level_id') is-invalid @enderror" wire:model.lazy="level_id">
                                <option value="" selected>Open this select menu</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Select level</label>
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
        window.addEventListener('showClassModal', event => {
            $('#classModal').modal('show')
        })
        window.addEventListener('hideClassModal', event => {
            $('#classModal').modal('hide')
        })
    </script>
@endpush
