<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 80px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .logo {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
<div class="header">
    <img class="me-4" src="{{ public_path('images/sabibi.JPG') }}" style="width:100px; height:100px;">
    <h1>{{ $schoolName }}</h1>
    <h3>Student Attendance Report - From {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h3>
    <p>Class: {{ $class->class_name }} | Academic Year: {{ $academicYear }}</p>
</div>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('attendance.student_name') }}</th>
        @foreach($dates as $date)
            <th>{{ $date->format('d-m-Y') }}</th>
        @endforeach
        <th>{{ __('attendance.total_absences') }}</th> <!-- Add this column header -->
    </tr>
    </thead>
    <tbody>
    @foreach($attendanceData as $index => $data)
        <tr>
            <td style="width: 5%;">{{ $index + 1 }}</td>
            <td style="text-align: left;">{{ $data['student']->full_name }}</td>
            @foreach($dates as $date)
                <td>{{ $data['attendance'][$date->format('d-m-Y')] ?? 'N/A' }}</td>
            @endforeach
            <td>{{ $data['totalAbsences'] }}</td> <!-- Display total absences -->
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

