<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer/Index');
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
    public function edit_profile(string $id)
    {
        $model = User::query()->findOrFail($id);

        return view('customer.profile.index', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_profile(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $post = User::findorfail($id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
        }
        $iduser = auth()->user()->id;
        $data = User::find($id);
        $data->name = $request->name;

        $data->save();

        return redirect()
            ->route('customer.profile', $iduser)
            ->with('message', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
