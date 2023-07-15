<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\categorypackage;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return categorypackage::all();
    }

    public function map($categorypackage): array
    {
        return [
            //data yang dari kolom tabel database yang akan diambil
            $categorypackage->name,
            $categorypackage->created_at,
            $categorypackage->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            //pastikan urut dan jumlahnya sesuai dengan yang ada di mapping-data atau table di database
            'Nama',
            'Created at',
            'Updated at',
        ];
    }
}
