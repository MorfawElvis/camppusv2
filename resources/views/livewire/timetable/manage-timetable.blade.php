<div>
    <div class="container">
        <h1>Manage Timetable</h1>

        <div class="mb-3">
            <label for="classRoomId" class="form-label">Select Class</label>
            <select id="classRoomId" class="form-select" wire:model="classRoomId">
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>

        <button wire:click="generateTimetable" class="btn btn-primary">Generate Timetable</button>

        @if ($error)
            <div class="alert alert-danger mt-3">{{ $error }}</div>
        @endif

        @if ($timetables)
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>Day/Period</th>
                        @foreach($periods as $period)
                            <th>{{ $period->name }}<br>{{ $period->start_time }} - {{ $period->end_time }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($weekdays as $weekday)
                        <tr>
                            <td>{{ $weekday->name }}</td>
                            @foreach($periods as $period)
                                <td>
                                    @php
                                        $timetable = $timetables->firstWhere([
                                            ['day_of_week', $weekday->id],
                                            ['period_number', $period->id]
                                        ]);
                                    @endphp
                                    @if ($timetable)
                                        {{ $timetable->subject->subject_name }}<br>
                                        <small>{{ $timetable->employee->full_name }}</small>
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <h2 class="mt-5">Classes with Timetables</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>Class Name</th>
                    <th>View Timetable</th>
                    <th>Download Timetable</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classesWithTimetables as $class)
                    <tr>
                        <td>{{ $class->class_name }}</td>
                        <td>
                            <a href="{{ route('timetable.show', ['class' => $class->id]) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                        <td>
                            <a href="{{ route('timetable.download', ['class' => $class->id]) }}" class="btn btn-success btn-sm">Download</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
