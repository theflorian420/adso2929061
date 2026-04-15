<?php

namespace App\Exports;

use App\Models\Pet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PetsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Pet::orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Kind', 'Breed', 'Age (yrs)', 'Weight (kg)', 'Location', 'Active', 'Status', 'Created At'];
    }

    public function map($pet): array
    {
        return [
            $pet->id,
            $pet->name,
            $pet->kind,
            $pet->breed,
            $pet->age,
            $pet->weight,
            $pet->location,
            $pet->active ? 'Active' : 'Inactive',
            $pet->status ? 'Adopted' : 'Available',
            $pet->created_at->format('Y-m-d'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
