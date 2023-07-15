<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class PackageExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('packages')
            ->select('packages.*', 'categorypackages.name AS catname')
            ->join('categorypackages', 'categorypackages.id', '=', 'packages.category_id')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function map($packages): array
    {
        return [
            //data yang dari kolom tabel database yang akan diambil
            $packages->catname,
            $packages->name,
            "http://127.0.0.1:8000/images/" . $packages->image,
            $packages->description,
            $packages->price,
            $packages->created_at,
            $packages->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            //pastikan urut dan jumlahnya sesuai dengan yang ada di mapping-data atau table di database
            'Nama Kategori',
            'Nama Paket',
            'Nama Gambar',
            'Deskripsi',
            'Harga',
            'Created at',
            'Updated at',
        ];
    }
}
