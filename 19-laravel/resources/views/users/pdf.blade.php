<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #222; background: #fff; }
        h1 { text-align: center; font-size: 18px; margin-bottom: 4px; color: #1a1a2e; }
        p.subtitle { text-align: center; font-size: 10px; color: #666; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background-color: #1a1a2e; color: #fff; }
        thead th { padding: 7px 6px; text-align: left; font-size: 10px; letter-spacing: 0.5px; }
        tbody tr:nth-child(even) { background-color: #f0f4ff; }
        tbody td { padding: 6px 6px; border-bottom: 1px solid #ddd; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; }
        .badge-admin { background: #d1fae5; color: #065f46; }
        .badge-customer { background: #dbeafe; color: #1e40af; }
        .badge-active { background: #d1fae5; color: #065f46; }
        .badge-inactive { background: #fee2e2; color: #991b1b; }
        .footer { margin-top: 20px; text-align: right; font-size: 9px; color: #999; }
    </style>
</head>
<body>
    <h1>LaraPets — Users Report</h1>
    <p class="subtitle">Generated on {{ now()->format('F d, Y — H:i') }} &nbsp;|&nbsp; Total: {{ $users->count() }} users</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Document</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->document }}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ \Carbon\Carbon::parse($user->birthdate)->age }} yrs</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->role == 'Admin')
                        <span class="badge badge-admin">Admin</span>
                    @else
                        <span class="badge badge-customer">Customer</span>
                    @endif
                </td>
                <td>
                    @if ($user->active)
                        <span class="badge badge-active">Active</span>
                    @else
                        <span class="badge badge-inactive">Inactive</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer">LaraPets &copy; {{ now()->year }}</p>
</body>
</html>
