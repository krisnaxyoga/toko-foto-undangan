<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Theme;

use App\Models\UndanganOrder;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::now()->toDateString();

        $package = Package::select('*')
            ->paginate(3);

        // $package = Package::paginate(3);
        $theme = Theme::paginate(3);
        return view('app', compact('package', 'theme'));
    }

    /**
     * Display a listing of the resource.
     */
    public function detail()
    {
        return view('detail');
    }

    /**
     * Display a listing of the resource.
     */
    public function list_package()
    {
        // $package = Package::all();
        $today = Carbon::now()->toDateString();

        $package = Package::all();
        return view('package', compact('package'));
    }

    /**
     * Display a listing of the resource.
     */
    public function list_theme()
    {
        $theme = Theme::all();
        return view('theme', compact('theme'));
    }

    public function undangan($id)
    {
        $undangan = UndanganOrder::where('id', $id)->with('theme')->get();
        // return view('undangan',compact('undangan'));
        return view('diundang', compact('undangan'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sendundangan(Request $request,$id)
    {
        // dd($request->all());
        $phoneNumber = $request->wanomor;
        $message = "Om Swastyastu

        Atas asung kertha wara nugraha Ida Sang Hyang Widi Wasa
        /Tuhan Yang Maha Esa, kami akan melaksanakan
        Upacara Agama Manusa Yadnya
        Pawiwahan & Mepandes

        Tanpa mengurangi rasa hormat
        kami bermaksud mengundang Bapak/Ibu/Saudara/i
        pada Acara Resepsi Kami
        melalui link Undangan Online dibawah ini:

        " . route('customer.undangansend',$id) . "

        Atas perhatian dan kehadirannya
        kami sekeluarga mengucapkan Terima Kasih

        Om Santhi, Santhi, Santhi, Om";


        // Ubah nomor telepon jika diperlukan (misalnya, tambahkan kode negara atau hapus spasi)

        $whatsAppUrl = "https://wa.me/{$phoneNumber}?text=" . urlencode($message);

        return redirect()->away($whatsAppUrl);
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
