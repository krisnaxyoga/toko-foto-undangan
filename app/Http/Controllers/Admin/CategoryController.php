<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorypackage;
use App\Models\Package;

use Illuminate\Support\Facades\Validator;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Categorypackage::all();
        return view('admin.category.index', compact('data'));
    }

    public function dataCategoryExcel()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Categorypackage;

        return view('admin.category.form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new Categorypackage();
            $data->name = $request->name;
            $data->save();

            return redirect()
                ->route('category.index')
                ->with('message', 'Data berhasil disimpan.');
        }
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
        $model = Categorypackage::query()->findOrFail($id);

        return view('admin.category.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = Categorypackage::query()->findOrFail($id);
            $data->name = $request->name;
            $data->save();

            return redirect()
                ->route('category.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus semua baris di tabel "packages" yang memiliki "category_id" sama dengan $id
        Package::where('category_id', $id)->delete();

        // Cari dan hapus baris di tabel "categorypackages" berdasarkan "id"
        $categorypackage = Categorypackage::find($id);
        if ($categorypackage) {
            $categorypackage->delete();
            return redirect()->back()->with('message', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('message', 'Data tidak ditemukan');
        }
    }
}
