<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Document', 'FullName', 'Gender', 'Age', 'Phone', 'Email', 'Role', 'Active', 'Created At'];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->document,
            $user->fullname,
            $user->gender,
            Carbon::parse($user->birthdate)->age . ' years',
            $user->phone,
            $user->email,
            $user->role,
            $user->active ? 'Active' : 'Inactive',
            $user->created_at->format('Y-m-d'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
