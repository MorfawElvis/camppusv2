<div class="container">
    @section('title', 'Manage Student Attendance')
    <div class="card mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-cogs mr-2"></i>
            Manage Student Attendance
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ $selectedTab === 'take-attendance' ? 'active' : '' }}" wire:click="switchTab('take-attendance')">Take Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $selectedTab === 'attendance-report' ? 'active' : '' }}" wire:click="switchTab('attendance-report')">Attendance Report</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Take Attendance Tab -->
                <div class="tab-pane mt-3 {{ $selectedTab === 'take-attendance' ? 'active' : '' }}">
                    <h5 class="mb-3">{{ __('attendance.attendance_for_date') }} - {{ \Carbon\Carbon::parse($selectedDate)->format('d-m-Y') }}</h5>
                    <form wire:submit.prevent="saveAttendance">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="dateSelect" class="form-label">{{ __('attendance.select_date') }}</label>
                                <input type="text" wire:model="selectedDate" id="dateSelect" class="form-control" placeholder="dd-mm-yyyy" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                            <div class="col-md-3">
                                <label for="sectionSelect" class="form-label">{{ __('attendance.select_section') }}</label>
                                <select wire:model="selectedSection" id="sectionSelect" class="form-select">
                                    <option value="">{{ __('attendance.select_section') }}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="classSelect" class="form-label">{{ __('attendance.select_class') }}</label>
                                <select wire:model="selectedClass" id="classSelect" class="form-select" {{ is_null($selectedSection) ? 'disabled' : '' }}>
                                    <option value="">Select a class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="button" wire:click="loadAttendance" class="btn btn-secondary">
                                    <span wire:loading.remove wire:target="loadAttendance">{{ __('attendance.load_attendance') }}</span>
                                    <span wire:loading wire:target="loadAttendance">{{ __('attendance.processing') }}</span>
                                </button>
                            </div>
                        </div>

                        @if (!empty($students))
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('attendance.student_name') }}</th>
                                    <th>
                                        {{ __('attendance.attendance_status') }}
                                        <button type="button" class="btn btn-sm btn-success ms-4" wire:click="markAll('present')">{{ __('attendance.mark_all_present') }}</button>
                                        <button type="button" class="btn btn-sm btn-danger" wire:click="markAll('absent')">{{ __('attendance.mark_all_absent') }}</button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $student->full_name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-evenly">
                                                <div>
                                                    <input type="radio" id="present-{{ $student->id }}" name="attendance[{{ $student->id }}]"
                                                           value="present" wire:model="attendances.{{ $student->id }}.status" {{ $attendances[$student->id]['status'] === 'present' ? 'checked' : '' }}>
                                                    <label for="present-{{ $student->id }}">Present</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="absent-{{ $student->id }}" name="attendance[{{ $student->id }}]" value="absent" wire:model="attendances.{{ $student->id }}.status">
                                                    <label for="absent-{{ $student->id }}">Absent</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="late-{{ $student->id }}" name="attendance[{{ $student->id }}]" value="late" wire:model="attendances.{{ $student->id }}.status">
                                                    <label for="late-{{ $student->id }}">Late</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if($attendanceLoaded)
                            <button type="submit" class="btn btn-primary rounded-pill float-right">
                                <span wire:loading.remove wire:target="saveAttendance">Save Attendance</span>
                                <span wire:loading wire:target="saveAttendance">Processing...</span>
                            </button>
                        @endif
                    </form>
                </div>

                <!-- Attendance Report Tab -->
                <div class="tab-pane mt-3 {{ $selectedTab === 'attendance-report' ? 'active' : '' }}">
                    <h5 class="mb-3">Generate Attendance Report</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3 d-flex flex-column align-items-center">
                            <label for="sectionSelect" class="form-label">{{ __('attendance.select_section') }}</label>
                            <select wire:model="selectedSectionForReport" id="sectionSelect" class="form-select">
                                <option value="">Select a section</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3 d-flex flex-column align-items-center">
                            <label for="classSelectReport" class="form-label">Select Class</label>
                            <select id="classSelectReport" class="form-select" wire:model="selectedClassForReport">
                                <option value="">Select Class</option>
                                @foreach($selectedClassesForReport as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3 d-flex flex-column align-items-center">
                            <label for="reportStartDate" class="form-label">Start Date</label>
                            <input type="date" id="reportStartDate" class="form-control" wire:model="reportStartDate">
                        </div>

                        <div class="col-md-3 mb-3 d-flex flex-column align-items-center">
                            <label for="reportEndDate" class="form-label">End Date</label>
                            <input type="date" id="reportEndDate" class="form-control" wire:model="reportEndDate">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            @if($selectedClassForReport && $reportStartDate && $reportEndDate)
                                <a href="{{ route('attendance.report', ['classId' => $selectedClassForReport, 'startDate' => $reportStartDate, 'endDate' => $reportEndDate]) }}" target="_blank" class="btn btn-primary mt-3">
                                    <span wire:loading.remove>Print Report</span>
                                    <span wire:loading>Processing...</span>
                                </a>
                            @else
                                <button class="btn btn-primary mt-3" disabled>
                                    Print Report
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>

