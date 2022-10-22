<div>
    @section('title', 'Academic Years')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-calendar-alt mr-2"></i>Academic Years
        </div>
        <div class="card-body" id="yearsTable">
            <x-error></x-error>
            <a wire:click="createYearModal" id="year" class="btn btn-outline-primary rounded-pill float-right mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Create Year</a>
            <table class="table table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Year Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($academic_years as $academic_year)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $academic_year->year_name }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input wire:click="yearStatusChange({{ $academic_year->id }}, '{{ $academic_year->year_status }}')" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                       @if($academic_year->year_status == 'opened') checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </td>
                        <td>
                            <span><a class="btn btn-xs btn-primary" wire:click.prevent="showEditModal({{ $academic_year}})"><i class="fas fa-edit me-2"></i>Edit</a></span>
                            <span><a class="btn btn-xs btn-danger" wire:click.prevent="confirmDeleteYear({{ $academic_year->id }})"><i class="fas fa-trash me-2"></i>Delete</a></span>
                        </td>
                    </tr>
                @empty
                    <tr  style="text-align: center !important;">
                        <td colspan="4"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $academic_years->links() }}
        </div>
    </div>
    {{--Academic Year Modal Form--}}
    <div class="modal fade" id="YearModalForm" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="academicYearLabel"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Year' : 'Create Year' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editYear' : 'createYear'}}" class="form-floating">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.debounce.500ms="yearName" class="form-control @error('yearName') is-invalid @enderror" id="academicYear"
                                   placeholder="Enter Academic Year">
                            @error('yearName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <small>For example 2019-2020</small>
                            <label for="academicYear" class="required">Year Name</label>
                        </div>
                        <x-modal-buttons>{{$editMode ? 'Save Changes' : 'Save'}}</x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- /. year modal form --}}
    @push('page-scripts')
        <script>
            window.addEventListener('showYearModal', event => {
                $('#YearModalForm').modal('show');
            });
            window.addEventListener('hideYearModal', event => {
                $('#YearModalForm').modal('hide');
            });
            window.addEventListener('showEditModal', event => {
                $('#YearModalForm').modal('show');
            });
            window.addEventListener('hideEditModal', event => {
                $('#YearModalForm').modal('hide');
            });
        </script>
    @endpush
</div>

