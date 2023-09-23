
<div>
    @section('title', 'Manage Scholarships')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Manage Scholarships
        </div>
        <div class="card-body">
             <div class="mb-3">
                 <div class="d-flex align-middle ms-4">
                     <label>Select All</label>
                     <input type="checkbox" class="form-check-input me-2" wire:model="selectAll" id="select-all" @if($selectAll) checked @endif>
                     <div class="ms-2">
                        @if($selectAll)
                             <button wire:click="deleteSelected" type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete selected"><i class="fas fa-trash-alt"></i></button>
                        @endif
                     </div>
                 </div>
                       <a wire:click.prevent="showScholarshipModal" class="btn btn-outline-primary rounded-pill float-end" id="add-button">
                           <i class="fas fa-plus-circle mr-2"></i>Award Scholarship</a>
              </div>
            <table class="table table-striped table-hover table-responsive-lg">
                <caption class="mt-2">{{ $students_with_scholarships->links() }}</caption>
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Student's Name</th>
                    <th>Class</th>
                    <th>Scholarship</th>
                    <th>Coverage</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                 @forelse ($students_with_scholarships as $student)
                     <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                            @if($selectAll)
                                <input type="checkbox" class="form-check-input me-3" wire:model="selected" value="{{ $student->id }}">
                            @endif
                            {{ $student->student->full_name ?? 'Student does not exist' }}
                        </td>
                        <td>{{ $student->student->class_room->class_name ?? '' }}</td>
                        <td>{{ $student->scholarship_category->scholarship_name ?? '' }}</td>
                        <td>{{ $student->scholarship_category->scholarship_coverage ?? '' }}</td>
                        <td>
                            <span><a  wire:click.prevent="deleteScholarship({{ $student->student_id }})"class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                        </td>
                     </tr>
                 @empty
                 <tr  class="text-center">
                     <td colspan="7"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                 </tr>
                 @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="scholarshipModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>Award Scholarship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="newScholarship" class="form-floating">
                        <div class="form-floating mb-3">
                            <select wire:model.lazy="section_id" class="form-select" required>
                              <option selected>Open this select menu</option>
                              @foreach ($sections as $section )
                              <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                              @endforeach
                            </select>
                            <label for="floatingSelect">Section</label>
                        </div>
                        @if (!is_null($class_rooms))
                            <div class="form-floating mb-3">
                                <select wire:model.lazy="class_id" class="form-select" required>
                                <option selected>Open this select menu</option>
                                @foreach ($class_rooms as $class_room )
                                   <option value="{{ $class_room->id }}">{{ $class_room->class_name }}</option>
                                @endforeach
                                </select>
                                <label for="floatingSelect">Class</label>
                            </div>
                        @endif
                        @if (!is_null($students))
                        <div class="form-floating mb-3">
                            <select class="form-select @error('student_id') is-invalid @enderror" id="floatingSelect" wire:model.lazy="student_id" required>
                              <option selected>Open this select menu</option>
                              @foreach ($students as $student)
                              <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                              @endforeach
                            </select>
                            @error('student_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label for="floatingSelect">Name of Student</label>
                        </div>
                        @endif
                        @if (!is_null($student_id))
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" wire:model.lazy="scholarship_id" required>
                              <option selected>Open this select menu</option>
                              @foreach ($scholarships as $scholarship)
                              <option value="{{ $scholarship->id }}">{{ $scholarship->scholarship_name }} | {{ $scholarship->scholarship_category }} | <span style="font-weight:
                                800 !important;">{{ $scholarship->discount}} XAF</span></option>
                              @endforeach
                            </select>
                            <label for="floatingSelect">Schorlaship</label>
                        </div>
                        @endif
                        <div wire:loading>
                            Please wait....
                        </div>
                        <div>
                            <div class="float-right">
                                @if (!is_null($student_id))
                                <button type="button" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit"  class="btn btn-primary rounded-pill">
                                    <div wire:loading.delay wire:target="submit" class="spinner-border spinner-border-sm text-white"></div>
                                    Save
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showScholarshipModal', event => {
            $('#scholarshipModal').modal('show');
        });
        window.addEventListener('hideSholarshipModal', event => {
            $('#scholarshipModal').modal('hide');
        });
    </script>
@endpush
