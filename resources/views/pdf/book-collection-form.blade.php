<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header .school-details {
            margin-left: 20px;
        }
        .school-details h1, .school-details p {
            margin: 0;
            line-height: 1.2;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ public_path('storage/logo.png') }}" alt="School Logo">
    <div class="school-details">
        <h1>{{ $schoolName }}</h1>
        <p>Academic Year: {{ $academicYear }}</p>
        <p>Class: {{ $classRoom->class_name }}</p>
    </div>
</div>

<h2>Book Collection Form</h2>

<table class="table">
    <thead>
    <tr>
        <th>Book Title</th>
        <th>Author</th>
        <th>Price (FCFA)</th>
        <th>Qty</th>
        <th>Signature</th>
    </tr>
    </thead>
    <tbody>
    @foreach($classRoom->textbooks as $textbook)
        <tr>
            <td>{{ $textbook->title }}</td>
            <td>{{ $textbook->author }}</td>
            <td>{{ number_format($textbook->price, 2) }}</td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
