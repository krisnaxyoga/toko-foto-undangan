<?php

namespace App\Exports;

use App\Models\transaksis;
use Maatwebsite\Excel\Concerns\FromCollection;

class UndanganExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return transaksis::all();
    }
}
