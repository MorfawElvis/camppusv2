<div>
    <div>
        @section('title', 'Timetable Setting')
        <div class="row">
            <div class="col-md-3">
                <x-card.card>
                    <x-slot:header>Class Subjects</x-slot:header>
                    <x-slot:body>
                        <div class="nav flex-column nav-pills text-start">
                            <div wire:ignore>
                                <button class="nav-link active"  data-bs-toggle="tab" data-bs-target="#assignClassSubjects">
                                    <i class="fas fa-money-bill me-2"></i>Assign Class Subjects</button>
                                <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#classSubjects">
                                    <i class="fas fa-money-check me-2"></i>Manage Class Subjects</button>
                                <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#assignTeachers">
                                    <i class="fas fa-money-check me-2"></i>Assign Teachers</button>
                            </div>
                        </div>
                    </x-slot:body>
                </x-card.card>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="assignClassSubjects" wire:ignore.self>
                        <x-card.card>
                            <x-slot:header>Assign Class Subjects</x-slot:header>
                            <x-slot:body>
                                <!-- Form for Assigning Subjects -->
                                    <form wire:submit.prevent="assignSubjects" class="row gx-4 gy-4">
                                        <div class="form-group">
                                            <label for="level_id">Filter by Level</label>
                                            <select id="level_id" wire:model="selected_level" class="form-control">
                                                <option value="">Select a level</option>
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('selected_level') <span class="text-danger">{{ $message }}</span> @enderror
                                            <hr>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="class_rooms">Select Class Rooms</label>
                                            <div class="row">
                                                @foreach ($classRooms->chunk(2) as $chunk)
                                                    <div class="col-md-4">
                                                        @foreach ($chunk as $classRoom)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" wire:model="selected_class_rooms" value="{{ $classRoom->id }}" id="class_room_{{ $classRoom->id }}">
                                                                <label class="form-check-label" for="class_room_{{ $classRoom->id }}">
                                                                    {{ $classRoom->class_name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('selected_class_rooms') <span class="text-danger">{{ $message }}</span> @enderror
                                            <hr>
                                        </div>
                                        @if(!Empty($selected_class_rooms))
                                            <div class="form-group mt-3">
                                                <label for="subjects">Select Subjects</label>
                                                <div class="row">
                                                    @foreach ($subjects->chunk(6) as $chunk)
                                                        <div class="col-md-4">
                                                            @foreach ($chunk as $subject)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" wire:model="selected_subjects" value="{{ $subject->id }}" id="subject_{{ $subject->id }}">
                                                                    <label class="form-check-label" for="subject_{{ $subject->id }}">
                                                                        {{ $subject->subject_name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('selected_subjects') <span class="text-danger">{{ $message }}</span> @enderror
                                                <hr>
                                            </div>
                                        @endif
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="assignSubjects">Assign Subjects</button>
                                            <div wire:loading wire:target="assignSubjects" class="ml-2 spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </form>
                            </x-slot:body>
                        </x-card.card>
                    </div>
                    <div class="tab-pane fade" id="classSubjects" wire:ignore.self>
                        <x-card.card>
                            <x-slot:header>Manage Class Subjects</x-slot:header>
                            <x-slot:body>
                                <div class="row d-flex justify-content-center gy-3 gx-3 mx-3">
                                    <div class="col">
                                        <label for="level_id">Filter by Level</label>
                                        <select id="level_id" wire:model="filter_level_id" class="form-control">
                                            <option value="">Select a level</option>
                                            @foreach ($filter_level as $level)
                                                <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_level') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                   <div class="col mb-4">
                                           <label for="filter_class_room">Filter by Class Room</label>
                                           <select id="filter_class_room" wire:model="filter_classroom_id" class="form-control">
                                               <option value="">Select a class room</option>
                                               @foreach ($filter_classroom as $classRoom)
                                                   <option value="{{ $classRoom->id }}">{{ $classRoom->class_name }}</option>
                                               @endforeach
                                           </select>
                                   </div>
                                    <hr>
                                </div>
                                <!-- Table of Assigned Subjects -->
                                @if ($assignedSubjects->isNotEmpty())
                                   @if($filter_classroom_id)
                                        <x-table.table :headers="['Class','Subject','Subject Code','#Teaching Periods','Actions']">
                                            <caption>{{ $assignments->links() }}</caption>
                                            @forelse($assignments as $assignment)
                                                <tr>
                                                    <td>{{ $assignment->classRoom->class_name}}</td>
                                                    <td>{{ $assignment->subject->subject_name }}</td>
                                                    <td>{{ $assignment->subject->subject_code }}</td>
                                                    <td>
                                                        <input type="number"
                                                               value="{{ $assignment->teaching_periods_per_week }}"
                                                               wire:change="updateTeachingPeriod({{ $assignment->id }}, $event.target.value)"
                                                               onkeydown="goToNextInput(event, {{ $loop->index }}, {{ $loop->last ? 'true' : 'false' }})"
                                                               onclick="selectInputValue(event)"
                                                               id="input-{{ $loop->index }}">
                                                    </td>
                                                    <td>
                                                        <button wire:click="removeAssignment({{ $assignment->id }})" class="btn btn-danger btn-sm">Remove</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-table.record-not-found></x-table.record-not-found>
                                            @endforelse
                                        </x-table.table>
                                   @endif
                                    <div id="outside-focus" tabindex="-1"></div>
                                @endif
                            </x-slot:body>
                        </x-card.card>
                    </div>
                    <div class="tab-pane fade" id="assignTeachers" wire:ignore.self>
                        <x-card.card>
                            <x-slot:header>Assign Teachers</x-slot:header>
                            <x-slot:body>
                                <div class="row d-flex justify-content-center gy-3 gx-3 mx-3">
                                    <div class="col">
                                        <label for="level_id">Filter by Level</label>
                                        <select id="level_id" wire:model="filter_level_id" class="form-control">
                                            <option value="">Select a level</option>
                                            @foreach ($filter_level as $level)
                                                <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_level') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col mb-4">
                                        <label for="filter_class_room">Filter by Class Room</label>
                                        <select id="filter_class_room" wire:model="filter_classroom_id" class="form-control">
                                            <option value="">Select a class room</option>
                                            @foreach ($filter_classroom as $classRoom)
                                                <option value="{{ $classRoom->id }}">{{ $classRoom->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Table of Assigned Subjects -->
                                @if ($assignedSubjects->isNotEmpty())
                                   @if($filter_classroom_id)
                                        <x-table.table :headers="['Subjects','Teachers','Assign Teacher']">
                                            <caption>{{ $assignments->links() }}</caption>
                                            @forelse($assignments as $assignment)
                                                <tr>
                                                    <td>{{ $assignment->subject->subject_name }}</td>
                                                    <td>
                                                        @forelse($assignment->employees as $teacher)
                                                            <span class="badge badge-secondary">{{ $teacher->full_name }}</span>
                                                        @empty
                                                            <p>No Teacher Assigned</p>
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary" wire:click="openTeacherModal({{ $assignment->id }})">Assign Teachers</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-table.record-not-found></x-table.record-not-found>
                                            @endforelse
                                        </x-table.table>
                                   @endif
                                @endif
                            </x-slot:body>
                        </x-card.card>
                    </div>
                </div>
            </div>
        </div>
        @if ($showTeacherModal)
            <div class="modal d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Assign Teachers</h5>
                            <button type="button" class="close" wire:click="closeTeacherModal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @foreach ($teachers as $teacher)
                                    <div class="form-check mb-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value="{{ $teacher->id }}"
                                            id="teacher{{ $teacher->id }}"
                                            wire:model.defer="selected_teacher_subjects"
                                        >
                                        <label class="form-check-label" for="teacher{{ $teacher->id }}">
                                            {{ $teacher->full_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" wire:click="assignTeachers">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
                @endif
    </div>
</div>
<script>
    function goToNextInput(event, index, isLast) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (isLast) {
                document.getElementById('outside-focus').focus();
            } else {
                let nextIndex = index + 1;
                let nextInput = document.getElementById('input-' + nextIndex);
                if (nextInput) {
                    nextInput.focus();
                    nextInput.select();
                }
            }
        }
    }
    function selectInputValue(event) {
        event.target.select();
    }
</script>

