<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\TransaksisExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class TransaksisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = Carbon::parse($request->startdate)->format('Y-m-d');
        $end = Carbon::parse($request->enddate)->format('Y-m-d');
        if ($start && $end) {
            $data = Transaksi::whereBetween(DB::raw('DATE(created_at)'), [$start, $end])->where('status', 'berhasil')->get();
        } else {
            // $data = Transaksi::where('status', 'berhasil')->get();
            $data = Transaksi::latest()->get();
        }
        $data = $data;
        // $data = Transaksi::latest()->get();
        return view('admin.transaksis.index', compact('data'));
    }

    public function dataTransaksisExcel(Request $request)
    {
        // $start = Carbon::parse($request->exstartdate)->format('Y-m-d');
        // $end = Carbon::parse($request->exenddate)->format('Y-m-d');
        $start = $request->exstartdate;
        $end = $request->exenddate;
        if ($start && $end) {
            $data = Transaksi::whereBetween(DB::raw('DATE(created_at)'), [$start, $end])->where('status', 'berhasil')->get();
        } else {
            // $data = Transaksi::where('status', 'berhasil')->get();
            $data = Transaksi::latest()->get();
        }
        $data = $data;
        // Lakukan filter berdasarkan permintaan Anda
        // $filteredData = User::where('status', $request->status)->get();

        // Panggil class UserExport untuk membuat file Excel
        return Excel::download(new TransaksisExport($data), 'transaksi_admin.xlsx');

        // return Excel::download(new TransaksisExport, 'laporan.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
