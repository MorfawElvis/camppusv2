@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Timetable for {{ $classRoom->class_name }}</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>Day / Period</th>
                    @foreach($periods as $period)

                            <th>{{ $period->start_time }} - {{ $period->end_time }}</th>

                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($weekdays as $weekday)
                    <tr>
                        <th>{{ $weekday->name }}</th>
                        @foreach($periods as $period)
                                                           <td>
                                    @php
                                        $timetable = $timetables->firstWhere(function ($item) use ($weekday, $period) {
                                            return $item->day_of_week == $weekday->id && $item->period_number == $period->id;
                                        });
                                    @endphp
                                    @if($timetable)
                                        <div>{{ $timetable->subject->subject_code }}</div>
                                        <div><small>{{ $timetable->employee->full_name ?? '' }}</small></div>
                                    @endif
                                </td>
                                                  @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
