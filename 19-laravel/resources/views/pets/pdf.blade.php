<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pets Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #222; background: #fff; }
        h1 { text-align: center; font-size: 18px; margin-bottom: 4px; color: #064e3b; }
        p.subtitle { text-align: center; font-size: 10px; color: #666; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background-color: #064e3b; color: #fff; }
        thead th { padding: 7px 6px; text-align: left; font-size: 10px; letter-spacing: 0.5px; }
        tbody tr:nth-child(even) { background-color: #f0fdf4; }
        tbody td { padding: 6px 6px; border-bottom: 1px solid #ddd; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; }
        .badge-available { background: #d1fae5; color: #065f46; }
        .badge-adopted   { background: #fef3c7; color: #92400e; }
        .badge-active    { background: #d1fae5; color: #065f46; }
        .badge-inactive  { background: #fee2e2; color: #991b1b; }
        .footer { margin-top: 20px; text-align: right; font-size: 9px; color: #999; }
    </style>
</head>
<body>
    <h1>LaraPets — Pets Report</h1>
    <p class="subtitle">Generated on {{ now()->format('F d, Y — H:i') }} &nbsp;|&nbsp; Total: {{ $pets->count() }} pets</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Kind</th>
                <th>Breed</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Location</th>
                <th>Active</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
            <tr>
                <td>{{ $pet->id }}</td>
                <td>{{ $pet->name }}</td>
                <td>{{ $pet->kind }}</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ $pet->age }} yrs</td>
                <td>{{ $pet->weight }} kg</td>
                <td>{{ $pet->location }}</td>
                <td>
                    @if ($pet->active)
                        <span class="badge badge-active">Active</span>
                    @else
                        <span class="badge badge-inactive">Inactive</span>
                    @endif
                </td>
                <td>
                    @if ($pet->status)
                        <span class="badge badge-adopted">Adopted</span>
                    @else
                        <span class="badge badge-available">Available</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer">LaraPets &copy; {{ now()->year }}</p>
</body>
</html>
