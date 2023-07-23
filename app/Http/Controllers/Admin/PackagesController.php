<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PackageExport;
use App\Http\Controllers\Controller;
use App\Models\Categorypackage;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Package::all();
        return view('admin.packages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Package();
        $category = Categorypackage::all();

        return view('admin.packages.form', compact('model', 'category'));
    }

    public function dataPackagesExcel()
    {
        return Excel::download(new PackageExport, 'package.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }
            $iduser = auth()->user()->id;
            $image = "/images/" . $filename;

            $data = new Package();
            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->image = $filename;
            // $data->image_url = $image;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->is_active = 1;

            $data->save();

            return redirect()
                ->route('packages.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Package::query()->findOrFail($id);
        $category = Categorypackage::all();

        return view('admin.packages.form', compact('model', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
        ]);
        $post = Package::findorfail($id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->file('image') != null) {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');

                    if (File::exists(public_path($post->image_url))) {
                        File::delete(public_path($post->image_url));
                    }
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $filename);

                    // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
                }
                $image = "/images/" . $filename;
            } else {
                $image = $post->image_url;
                $filename = $post->image_name;
            }
        }
        $iduser = auth()->user()->id;

        $data = Package::find($id);
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->image = $filename;
        // $data->image_url = $image;
        $data->description = $request->description;
        $data->price = $request->price;

        $data->save();

        return redirect()
            ->route('packages.index')
            ->with('message', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Package::find($id);
        if (File::exists(public_path($post->image_url))) {
            File::delete(public_path($post->image_url));
        }
        $post->delete();
        return redirect()->back()->with('message', 'package berhasil dihapus');
    }

    public function fullbook($id){
        $post = Package::find($id);
        $post->is_active = 0;
        $post->save();
        return redirect()->back()->with('message', 'package fullbook');
    }

    public function activebook($id){
        $post = Package::find($id);
        $post->is_active = 1;
        $post->save();
        return redirect()->back()->with('message', 'package fullbook');
    }
}
