<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class TransaksisExport implements FromCollection, WithHeadings
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    // public function collection()
    // {

    //     return DB::table('transaksis')
    //         ->select('transaksis.*', 'users.name AS username', 'customers.phone AS custname', 'customers.address AS alamat', 'orders.type_order AS tipe_order')
    //         ->join('users', 'users.id', '=', 'transaksis.user_id')
    //         ->join('customers', 'customers.id', '=', 'transaksis.customer_id')
    //         ->leftjoin('orders', 'orders.id', '=', 'transaksis.order_id')
    //         ->orderBy('id', 'DESC')
    //         ->get();
    // }

    // public function map($transaksis): array
    // {
    //     return [
    //         //data yang dari kolom tabel database yang akan diambil
    //         $transaksis->username,
    //         $transaksis->custname,
    //         $transaksis->alamat,
    //         $transaksis->tipe_order,
    //         $transaksis->total,
    //         $transaksis->url_pembayaran,
    //         $transaksis->status,
    //         $transaksis->created_at,
    //         $transaksis->updated_at,
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         //pastikan urut dan jumlahnya sesuai dengan yang ada di mapping-data atau table di database
    //         'Nama Pengguna',
    //         'phone',
    //         'alamat',
    //         'Tipe Order',
    //         'Total',
    //         'Url Pembayaran',
    //         'Status',
    //         'Created at',
    //         'Updated at',
    //     ];
    // }

    public function collection()
    {
        return $this->filter->map(function ($filter) {
            return [
                'User Name' => $filter->users->name,
                'Customer Name' => $filter->customers->name,
                'Customer Phone' => $filter->customers->phone,
                'Address' => $filter->customers->address,
                'Order Type' => $filter->orders->type_order,
                'Total' => $filter->total,
                'Url Pembayaran' => $filter->url_pembayaran,
                'Status' => $filter->status,
                'Created' => $filter->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Customer Name',
            'Customer Phone',
            'Address',
            'Order Type',
            'Total',
            'Url Pembayaran',
            'Status',
            'Created',
        ];
    }
}
