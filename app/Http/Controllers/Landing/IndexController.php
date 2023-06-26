<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Theme;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $package = Package::paginate(3);
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
