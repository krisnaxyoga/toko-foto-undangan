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

    public function collection()
    {
        $transaksis = Transaksi::with('users')->get();
        $loggedInUserName = auth()->user()->name; // Ambil nama pengguna yang sedang login
    
        if ($this->filter->isEmpty()) {
            return $transaksis->map(function ($filter,$index) use ($loggedInUserName) {
                return [
                    'No' => $index + 1, // Nomor indeks dimulai dari 1
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
        } else {
            return $transaksis->map(function ($transaksi,$index) use ($loggedInUserName) {
                return [
                    'No' => $index + 1, // Nomor indeks dimulai dari 1
                    'Customer Name' => $transaksi->customers ? $transaksi->customers->name : '',
                    'Customer Phone' => $transaksi->customers ? $transaksi->customers->phone : '',
                    'Address' => $transaksi->customers ? $transaksi->customers->address : '',
                    'Order Type' => $transaksi->orders ? $transaksi->orders->type_order : '',
                    'Total' => $transaksi->total,
                    'Url Pembayaran' => $transaksi->url_pembayaran,
                    'Status' => $transaksi->status,
                    'Created' => $transaksi->created_at,
                ];
            })->push([
                'User Name' => 'Print By :',
                'Customer Name' => $loggedInUserName,
                'Customer Phone' => '',
                'Address' => '',
                'Order Type' => '',
                'Total' => '',
                'Url Pembayaran' => '',
                'Status' => '',
                'Created' => '',
            ]);
        }
    }
    

    public function headings(): array
    {
        return [
            'No',
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
