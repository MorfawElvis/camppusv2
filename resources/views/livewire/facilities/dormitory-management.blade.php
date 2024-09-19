<div class="container">
    <button  class="btn btn-primary mb-3" wire:click="$emit('openAddDormitoryModal')">Add Dormitory</button>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Dormitory</th>
            <th>Capacity</th>
            <th>Dormitory Master</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dormitories as $dormitory)
            <tr>
                <td>{{ ucwords($dormitory->name) }}</td>
                <td>{{ $dormitory->capacity }}</td>
                <td>{{ $dormitory->employee->full_name ?? 'N/A' }}</td>
                <td class="d-flex justify-content-center gap-2">
                    <a href="" class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign Students">
                        <i class="fas fa-users fa-1x" wire:click.prevent="assignStudentsModal({{ $dormitory->id }})"></i></a>
                    <a href="" class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign Dormitory Captains">
                        <i class="fas fa-user-shield fa-1x" wire:click.prevent="assignCaptainsModal({{ $dormitory->id }})"></i></a>
                    <a href="" class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Dormitory">
                        <i class="fas fa-edit fa-1x" wire:click.prevent="editDormitory({{ $dormitory->id }})"></i></a>
                    <a href="" class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Dormitory" >
                        <i class="fas fa-trash-alt fa-1x text-danger" wire:click.prevent="deleteDormitory({{ $dormitory->id }})"></i></a>
                    <a href="" class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="View Dormitory Details">
                        <i class="fas fa-eye fa-1x text-blue" wire:click.prevent="viewDormitory({{ $dormitory->id }})"></i></a>
                    <a href="{{ route('dormitory.download', $dormitory->id) }}" class="cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Dormitory List">
                        <i class="fas fa-download fa-1x text-success"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- Dormitory Form Modal -->
    <div class="modal fade" id="dormitoryModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditMode ? 'Edit Dormitory' : 'Add Dormitory' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveDormitory">
                        <div class="form-group">
                            <label for="name">Dormitory Name</label>
                            <input type="text" class="form-control" id="name" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" class="form-control" id="capacity" wire:model="capacity">
                            @error('capacity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Dormitory Master</label>
                            <select class="form-control" id="teacher_id" wire:model="teacher_id">
                                <option value="">Select a Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <x-form-buttons method="saveDormitory"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Assign Dormitory Captains Modal -->
    <div class="modal fade" id="assignStudentsModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document"> <!-- Changed to modal-lg -->
            <div class="modal-content">
                <div class="modal-header">
                    @if($selectedDormitory)
                        <h5 class="modal-title">Assign Students to {{ ucwords($selectedDormitory->name)}} Dormitory</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Remaining Beds: {{ $remainingCapacity }}/{{ $dormitoryCapacity }}</h6>
                    <form wire:submit.prevent="assignStudents">
                        <!-- Class Selection -->
                        <div class="form-group">
                            <label for="class_id">Select Class</label>
                            <select class="form-control" id="class_id" wire:model="selectedClass">
                                <option value="">Select a Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Search Input -->
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Search students" wire:model.debounce.300ms="searchTerm">
                        </div>
                        @if($selectedClass)
                            <!-- Student Selection -->
                            <div class="form-group">
                                <label for="students">Select Students</label>
                                <div class="row">
                                    @foreach($filteredStudents->chunk(ceil($filteredStudents->count() / 2)) as $chunk)
                                        <div class="col-md-6">
                                            @foreach($chunk as $student)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{ $student->id }}" wire:model="selected_students">
                                                    <label class="form-check-label">
                                                        {{ $student->full_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($newStudentsSelected)
                            <x-form-buttons  method="assignStudents"/>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="assignCaptainsModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if($selectedDormitory)
                        <h5 class="modal-title">Assign Dormitory Captains to {{ ucwords($selectedDormitory->name)}} Dormitory</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="assignCaptains">
                        <div>
                            @foreach($assignedStudentsByClass as $classId => $students)
                                <h5>{{ $classes->find($classId)->class_name }}</h5>
                                <div class="row">
                                    <hr>
                                    @foreach($students as $student)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $student->id }}" wire:model="selected_captains">
                                                <label class="form-check-label">
                                                    {{ $student->full_name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <x-form-buttons method="assignCaptains"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- View Dormitory Details Modal -->
    <div class="modal fade" id="viewDormitoryModal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Dormitory Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <h5>Name of Dormitory</h5>
                        <p>{{ ucwords($viewedDorm) }}</p>
                    </div>
                    <div>
                        <h5>Current Number of Students Assigned / Capacity</h5>
                        <p>{{ $totalStudentsAssigned }} / {{ $dormitory->capacity }}</p>
                    </div>
                    <div>
                        <h5>Name of Dormitory Master</h5>
                        <p>{{ $dormitoryMaster }}</p>
                    </div>
                    <div>
                        <h5>Name of Dormitory Captains and Their Class</h5>
                        <ul>
                            @foreach($dormitoryCaptains as $captain)
                                <li>{{ $captain['name'] }} - <small class="italic">{{ $captain['class'] }}</small></li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h5>Number of Students by Class</h5>
                        <ul>
                            @foreach($studentsByClass as $classId => $count)
                                <li>{{ $classes->find($classId)->class_name ?? 'Unknown Class' }}: {{ $count }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('page-scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('openAddDormitoryModal', () => {
                $('#dormitoryModal').modal('show');
            });
            Livewire.on('openAssignStudentsModal', () => {
                $('#assignStudentsModal').modal('show');
            });
            Livewire.on('openAssignCaptainsModal', () => {
                $('#assignCaptainsModal').modal('show');
            });
            Livewire.on('showDormitoryDetailsModal', () => {
                $('#viewDormitoryModal').modal('show');
            });
            Livewire.on('closeModals', () => {
                $('#dormitoryModal').modal('hide');
                $('#assignStudentsModal').modal('hide');
                $('#assignCaptainsModal').modal('hide');
            });
        });
    </script>
@endpush
