<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dean's List Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .deans-list {
            color: #2c7a2c;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Dean's List Report</h1>

    <div class="section">
        <div class="section-title">Passed Students (>= 75)</div>
        <p>Dean's List threshold: 92%</p>
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Program</th>
                    <th>Average</th>
                    <th>Dean's List</th>
                </tr>
            </thead>
            <tbody>
                @forelse($passed as $item)
                    <tr>
                        <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                        <td>{{ $item->student->program->program_name ?? 'N/A' }}</td>
                        <td>{{ $item->average !== null ? number_format($item->average, 2) : 'N/A' }}</td>
                        <td>{{ $item->isDeansList ? 'Yes' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">No passed students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Failed Students</div>
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Program</th>
                    <th>Average</th>
                </tr>
            </thead>
            <tbody>
                @forelse($failed as $item)
                    <tr>
                        <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                        <td>{{ $item->student->program->program_name ?? 'N/A' }}</td>
                        <td>{{ $item->average !== null ? number_format($item->average, 2) : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">No failed students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
      
    </div>
</body>
</html>