<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teaching Periods Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        @page {
            margin: 10mm; /* Set narrow margins */
        }
        .container {
            width: 100%;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .school-name {
            margin-top: 0;
            font-size: 22px; /* Increased font size */
            font-weight: bold;
        }
        .academic-year {
            margin-top: 0;
            font-size: 18px; /* Increased font size */
        }
        .teacher-info {
            text-align: justify;
        }
        .teacher-info p {
            display: inline-block;
            width: 45%; /* Adjust width as needed */
            vertical-align: top; /* Align text vertically */
            margin: 0; /* Remove default margins */
            padding: 20px; /* Optional padding */
            font-weight: bold;
        }
        .table-container {
            flex: 1; /* Take up remaining space */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center the table */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px; /* Adjust spacing */
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 12px; /* Increased padding for better readability */
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .empty-cell {
            padding: 20px; /* Increased padding for empty cells */
            height: 50px; /* Increased height for empty cells */
        }
        .break-cell {
            writing-mode: vertical-rl;
            text-orientation: upright;
            font-weight: bold;
            background-color: #f9f9f9;
            height: 50px; /* Ensure height for break cells */
        }
        .merged-cell {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="school-name">{{ $schoolName }}</div>
        <div class="academic-year">Academic Year: {{ $academicYear }}</div>
    </div>
    <div class="teacher-info">
        <p>Name of Teacher: ____________________________</p>
        <p>Number of Periods: ______________________</p>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
            <tr>
                <th>DAY</th>
                @foreach($periods as $period)
                    <th>
                        @if($period['type'] == 'teaching')
                            {{ \Carbon\Carbon::parse($period['start_time'])->format('h:i') }} - {{ \Carbon\Carbon::parse($period['end_time'])->format('h:i A') }}
                        @endif
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php
                $breaks = [];
                foreach ($periods as $period) {
                    if ($period['type'] === 'break') {
                        $breaks[$period['start_time']] = $period['name'];
                    }
                }
            @endphp
            @foreach($weekdays as $weekday)
                <tr>
                    <td>{{ $weekday['name'] }}</td>
                    @foreach($periods as $period)
                        @if($period['type'] == 'teaching')
                            <td class="empty-cell"></td>
                        @elseif($period['type'] == 'break')
                            @if (isset($breaks[$period['start_time']]))
                                @if ($loop->first)
                                    <td class="break-cell" rowspan="{{ count($weekdays) }}">
                                        {{ $period['name'] }}
                                    </td>
                                @else
                                    <td class="merged-cell"></td>
                                @endif
                            @else
                                <td class="empty-cell"></td> <!-- Larger empty cells -->
                            @endif
                        @else
                            <td class="empty-cell"></td> <!-- Larger empty cells -->
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
