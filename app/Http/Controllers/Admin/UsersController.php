<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use App\Models\Customer;
use App\Models\UndanganOrder;
use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new User();
        return view('admin.users.form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = md5($request->password);
            $data->role_id = $request->role_id;

            $data->save();

            return redirect()
                ->route('users.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = User::query()->findOrFail($id);

        return view('admin.users.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = User::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = md5($request->password);
            $data->role_id = $request->role_id;

            $data->save();

            return redirect()
                ->route('users.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UndanganOrder::where('user_id',$id)->delete();
        Transaksi::where('user_id',$id)->delete();
        Order::where('user_id',$id)->delete();
        Customer::where('user_id',$id)->delete();

        $post = User::find($id);
        if($post){
            $post->delete();

            return redirect()->back()->with('message', 'users berhasil dihapus');
        }else{
            return redirect()->back()->with('message', 'Data tidak ditemukan');
        }

    }
}
