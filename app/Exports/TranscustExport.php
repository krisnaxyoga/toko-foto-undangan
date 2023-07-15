<?php

namespace App\Exports;

use App\Models\transaksis;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TranscustExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $iduser = auth()->user()->id;
        return DB::table('transaksis')
            ->select('transaksis.*', 'undangan_orders.*', 'users.name AS username', 'customers.name AS custname', 'orders.type_order AS tipe_order')
            ->join('users', 'users.id', '=', 'transaksis.user_id')
            ->join('customers', 'customers.id', '=', 'transaksis.customer_id')
            ->leftjoin('orders', 'orders.id', '=', 'transaksis.order_id')
            ->leftjoin('undangan_orders', 'undangan_orders.id', '=', 'transaksis.order_id')
            ->where('transaksis.user_id', $iduser)
            ->orderBy('transaksis.id', 'DESC')
            ->get();
    }

    public function map($transaksis): array
    {
        return [
            //data yang dari kolom tabel database yang akan diambil
            $transaksis->username,
            $transaksis->custname,
            $transaksis->tipe_order,
            $transaksis->title,
            $transaksis->nama_pria,
            $transaksis->nama_wanita,
            $transaksis->tgl_mulai,
            $transaksis->tgl_selesai,
            $transaksis->tempat_acara,
            $transaksis->waktu_mulai,
            $transaksis->waktu_selesai,
            $transaksis->maps,
            $transaksis->total,
            $transaksis->url_pembayaran,
            $transaksis->status,
            $transaksis->created_at,
            $transaksis->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            //pastikan urut dan jumlahnya sesuai dengan yang ada di mapping-data atau table di database
            'Nama Pengguna',
            'Nama Customer',
            'Tipe Order',
            'Judul Undangan',
            'Nama Pria',
            'Nama Wanita',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Tempat Acara',
            'Waktu Mulai',
            'Waktu Selesai',
            'Maps',
            'Total',
            'Url Pembayaran',
            'Status',
            'Created at',
            'Updated at',
        ];
    }
}
