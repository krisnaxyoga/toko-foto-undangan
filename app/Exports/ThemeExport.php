<?php

namespace App\Exports;

use App\Models\theme;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ThemeExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return theme::all();
    }

    public function map($theme): array
    {
        return [
            //data yang dari kolom tabel database yang akan diambil
            $theme->name,
            $theme->background,
            $theme->price,
            $theme->img_mockup,
            $theme->sambutan,
            $theme->penutup,
            $theme->created_at,
            $theme->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            //pastikan urut dan jumlahnya sesuai dengan yang ada di mapping-data atau table di database
            'Nama Tema',
            'Gambar Background',
            'Harga',
            'Gambar Mockup',
            'Sambutan',
            'Penutup',
            'Created at',
            'Updated at',
        ];
    }
}
