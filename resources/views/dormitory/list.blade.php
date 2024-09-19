<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dormitory List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        @page {
            margin: 20px;
            @bottom-right {
                content: "Page " counter(page) " of " counter(pages);
                font-size: 12px;
                color: #000;
            }
        }
        .header, .footer {
            text-align: center;
        }
        .header img {
            max-width: 100px;
        }
        .content {
            margin-top: 20px;
        }
        .page-break {
            page-break-after: always;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            text-align: left;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ public_path('path_to_school_logo.png') }}" alt="School Logo">
    <h1>{{ $schoolName }}</h1>
    <p>Academic Year: {{ $academicYear }}</p>
    <h2>Dormitory: {{ ucwords($dormitory->name) }}</h2>
    <p>Dormitory Master: {{ $dormitoryMasterName }}</p>
    <p>Capacity: {{ $dormitory->capacity }} | Students Assigned: {{ $dormitory->students->count() }} | Remaining Capacity: {{ $dormitory->capacity - $dormitory->students->count() }}</p>
</div>

<div class="content">
    <h3>Dormitory Captain(s)</h3>
    <ul>
        @foreach($captains as $captain)
            <li>{{ $captain->full_name }} ({{ $captain->class_room->class_name }})</li>
        @endforeach
    </ul>
    <table class="table">
        <thead>
        <tr>
            <th colspan="2" style="text-align: center; padding: 5px 0;">
                <h3 style="margin: 0; font-size: 1.5rem;">Dormitory Statistics</h3>
            </th>
        </tr>
        <tr>
            <th>Class</th>
            <th>Number of Students</th>
        </tr>
        </thead>
        <tbody>
        @foreach($studentsByClass as $className => $students)
            <tr>
                <td>{{ $className }}</td>
                <td>{{ $students->count() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="table">
        <thead>
        <tr>
            <th colspan="3" style="text-align: center; padding: 5px 0;">
                <h3 style="margin: 0; font-size: 1.5rem;">Dormitory Members</h3>
            </th>
        </tr>
        <tr>
            <th style="width: 5%;">#</th>
            <th>Student Name</th>
            <th>Class</th>
        </tr>
        </thead>
        <tbody>
        @php $serialNumber = 1; @endphp
        @foreach($studentsByClass as $className => $students)
            @foreach($students as $student)
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $className }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
