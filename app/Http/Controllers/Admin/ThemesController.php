<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ThemeExport;
use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\UndanganOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Theme::all();
        return view('admin.themes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Theme();

        return view('admin.themes.form', compact('model'));
    }

    public function dataThemesExcel()
    {
        return Excel::download(new ThemeExport, 'theme.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
            'price' => 'required',
            'img_mockup' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
            'sambutan' => 'required',
            'penutup' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->hasFile('background') && $request->hasFile('img_mockup')) {
                $background = $request->file('background');
                $img_mockup = $request->file('img_mockup');
                $filenamebg = time() . '.' . $background->getClientOriginalExtension();
                $filenamemc = time() . '.' . $img_mockup->getClientOriginalExtension();
                $background->move(public_path('background_img'), $filenamebg);
                $img_mockup->move(public_path('mockup_img'), $filenamemc);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }
            $iduser = auth()->user()->id;
            $background = "/background_img/" . $filenamebg;
            $img_mockup = "/mockup_img/" . $filenamemc;

            $data = new Theme();
            $data->name = $request->name;
            $data->background = $filenamebg;
            $data->price = $request->price;
            $data->img_mockup = $filenamemc;
            $data->sambutan = $request->sambutan;
            $data->penutup = $request->penutup;

            $data->save();

            return redirect()
                ->route('themes.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Theme::query()->findOrFail($id);

        return view('admin.themes.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
            'price' => 'required',
            'img_mockup' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
            'sambutan' => 'required',
            'penutup' => 'required',
        ]);
        $post = Theme::findorfail($id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->file('background') != null && $request->file('img_mockup') != null) {
                if ($request->hasFile('background') && $request->hasFile('img_mockup')) {
                    $background = $request->file('background');
                    $img_mockup = $request->file('img_mockup');

                    if (File::exists(public_path($post->image_url))) {
                        File::delete(public_path($post->image_url));
                    }
                    $filenamebg = time() . '.' . $background->getClientOriginalExtension();
                    $filenamemc = time() . '.' . $img_mockup->getClientOriginalExtension();
                    $background->move(public_path('background_img'), $filenamebg);
                    $img_mockup->move(public_path('mockup_img'), $filenamemc);

                    // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
                }
                $background = "/background_img/" . $filenamebg;
                $img_mockup = "/mockup_img/" . $filenamemc;
            } else {
                $image = $post->image_url;
                $filenamebg = $post->background_image_name;
                $filenamemc = $post->mockup_image_name;
            }
        }
        $iduser = auth()->user()->id;

        $data = Theme::find($id);
        $data->name = $request->name;
        $data->background = $filenamebg;
        $data->price = $request->price;
        $data->img_mockup = $filenamemc;
        $data->sambutan = $request->sambutan;
        $data->penutup = $request->penutup;

        $data->save();

        return redirect()
            ->route('themes.index')
            ->with('message', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Hapus semua baris di tabel "UndanganOrder" dengan "theme_id" yang sama dengan $id
    UndanganOrder::where('theme_id', $id)->delete();

    // Cari dan hapus baris di tabel "Theme" berdasarkan "id"
    $theme = Theme::find($id);
    if ($theme) {
        if (File::exists(public_path($theme->image_url))) {
            File::delete(public_path($theme->image_url));
        }
        $theme->delete();
        return redirect()->back()->with('message', 'Data berhasil dihapus');
    } else {
        return redirect()->back()->with('message', 'Data tidak ditemukan');
    }
    }
}
