<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable PDF</title>
    <style>
        /* Add your PDF styles here */
    </style>
</head>
<body>
<h1>{{ $schoolName }}</h1>
<h2>Academic Year: {{ $academicYear }}</h2>
<h3>Classroom: {{ $classRoom->class_name }}</h3>

<table>
    <thead>
    <tr>
        <th>DAY</th>
        @foreach($periods as $period)
            @if($period->type == 'teaching')
                <th>{{ \Carbon\Carbon::parse($period->start_time)->format('h:i') }} - {{ \Carbon\Carbon::parse($period->end_time)->format('h:i A') }}</th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($weekdays as $weekday)
        <tr>
            <td>{{ $weekday }}</td>
            @foreach($periods as $period)
                @if($period->type == 'teaching')
                    <td>
                        @php
                            $subject = $timetable->get($weekday, collect())->firstWhere('teaching_period_id', $period->id);
                        @endphp
                        @if($subject)
                            {{ $subject->subject->name }}
                        @else
                            N/A
                        @endif
                    </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
