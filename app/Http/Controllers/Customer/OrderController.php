<?php

namespace App\Http\Controllers\Customer;

use App\Exports\TranscustExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Order;
use App\Models\UndanganOrder;
use App\Models\Theme;
use App\Models\Transaksi;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $iduser = auth()->user()->id;
        $customer = Customer::where('user_id', $iduser)->get();
        $paket = Package::where('id', $id)->get();
        return view('order', compact('customer', 'paket'));
    }

    public function undangan($id)
    {
        $iduser = auth()->user()->id;
        $customer = Customer::where('user_id', $iduser)->get();
        $theme = Theme::where('id', $id)->get();

        return view('orderundangan', compact('customer', 'theme'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function transaksi()
    {
        $iduser = auth()->user()->id;
        $data = Order::where('user_id', $iduser)->with('package')->get();
        $undangan = UndanganOrder::where('user_id', $iduser)->get();

        return view('customer.transaksi.index', compact('data', 'undangan'));
    }

    public function dataTransaksisExcel()
    {
        return Excel::download(new TranscustExport, 'riwayat_transaksi.xlsx');
    }

    //Update Transaksi Pelanggan
    /**
     * Update the specified resource in storage.
     */
    public function update_transaksi(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'nama_pria' => 'required',
            'nama_wanita' => 'required',
            'tgl_mulai' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tempat_acara' => 'required',
            'ortupria' => 'required',
            'ortuwanita' => 'required',
            'asalpria' => 'required',
            'asalwanita' => 'required',
            'fotopria' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
            'fotowanita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
        ]);
        $post = UndanganOrder::findorfail($id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->file('fotopria') != null && $request->file('fotowanita') != null) {
                if ($request->hasFile('fotopria') && $request->hasFile('fotowanita')) {
                    $fotopria = $request->file('fotopria');
                    $fotowanita = $request->file('fotowanita');

                    if (File::exists(public_path($post->image_url))) {
                        File::delete(public_path($post->image_url));
                    }
                    $filenamepria = time() . '.' . $fotopria->getClientOriginalExtension();
                    $filenamewanita = time() . '.' . $fotowanita->getClientOriginalExtension();
                    $fotopria->move(public_path('foto_pria'), $filenamepria);
                    $fotowanita->move(public_path('foto_wanita'), $filenamewanita);

                    // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
                }
                $fotopria = "/foto_pria/" . $filenamepria;
                $fotowanita = "/foto_wanita/" . $filenamewanita;
            } else {
                // $image = $post->image_url;
                $filenamepria = $post->fotopria;
                $filenamewanita = $post->fotowanita;
            }
        }

        // $gallery = $request->file('gallery'); // Mendapatkan file gambar yang diunggah
        // $paths = []; // Array untuk menyimpan path gambar yang disimpan
        // foreach ($gallery as $image) {
        //     $path = $image->store('/gallery');
        //     $paths[] = $path;
        // }
        // $galleryPaths = [];

        // if($request->hasFile('gallery')){
        //     foreach ($request->file('gallery') as $gallery) {
        //         $filename = uniqid().'.'.$gallery->getClientOriginalExtension();
        //         $gallery->move(public_path('gallery'), $filename);

        //         $galleryPaths[] = "/gallery/".$filename;
        //     }
        // }else{
        //     $galleryPaths = [];
        // }
        // Lakukan tindakan lain, misalnya menyimpan path gambar ke database
        // return response()->json(['message' => 'Gambar berhasil disimpan', 'paths' => $paths], 200);

        $data = UndanganOrder::find($id);
        $data->title = $request->title;
        $data->nama_pria = $request->nama_pria;
        $data->nama_wanita = $request->nama_wanita;
        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;
        $data->waktu_mulai = $request->waktu_mulai;
        $data->waktu_selesai = $request->waktu_selesai;
        $data->tempat_acara = $request->tempat_acara;
        $data->maps = $request->maps;
        $data->ortupria = $request->ortupria;
        $data->ortuwanita = $request->ortuwanita;
        $data->asalpria = $request->asalpria;
        $data->asalwanita = $request->asalwanita;
        $data->fotopria = $filenamepria;
        $data->fotowanita = $filenamewanita;
        // $data->gallery = $galleryPaths;

        $data->save();

        return redirect()
            ->route('payment.transaksi')
            ->with('message', 'Data berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_transaksi(string $id)
    {
        $model = UndanganOrder::query()->findOrFail($id);

        return view('customer.transaksi.edit', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function send_undangan(string $id)
    {
        $model = UndanganOrder::query()->findOrFail($id);

        return view('customer.transaksi.wa', compact('model','id'));
    }

    public function ipaymu($id, Request $request)
    {
        $iduser = auth()->user()->id;
        $paket = Package::where('id', $id)->get();
        $customer = Customer::where('user_id', $iduser)->get();
        $data['url'] = 'https://sandbox.ipaymu.com/api/v2/payment';

        // dd($total);
        $jml = [
            'total' => $paket[0]->price,
            'type' => "paket-foto"
        ];

        $data['body'] = [
            'name' => array(auth()->user()->name), //array($request->name),
            'email' => array(auth()->user()->email), //array($request->email),
            'product' => array($paket[0]->name), //array($pacakage),
            'price' => array($paket[0]->price),
            'qty' => array(1), //array($request->qty),
            'returnUrl' => route('payment.success', $jml),
            'notifyUrl' => route('payment.notify'),
            'comments' => 'order produk',
            'referenceId' => '1234',
            'vistreason' => 'chest hurting bad'
        ];
        $data['method'] = 'POST';

        $result = $this->callApiIpaymuBtb($data);
        // dd($result);
        if ($result['status'] == 200) {
            // DB::beginTransaction();
            try {
                $response = json_decode($result['res']);
                // dd($response);
                $data['title']  = 'Pembayaran Ticket';
                $data['trxData'] = $response->Data;
                $data['url'] = $response->Data->Url;
                // dd($data);
                $trans = new Order;
                $trans->total = $paket[0]->price;
                $trans->package_id = $paket[0]->id;
                $trans->customer_id = $customer[0]->id;
                $trans->user_id = $iduser;
                $trans->status = 'pembayaran di proses';
                $trans->type_order = 'paket-foto';
                $trans->tgl_foto = $request->tgl_mulai;
                $trans->save();


                $topup = new Transaksi;
                $topup->user_id = $iduser;
                $topup->total = $paket[0]->price;
                $topup->order_id = $trans->id;
                $topup->customer_id = $customer[0]->id;
                $topup->status = 'pembayaran di proses';
                $topup->url_pembayaran = $response->Data->Url;
                $topup->save();

                return redirect()->to($response->Data->Url);
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('Gagal membuat pembayaran');
            }
        } else {
            return back()->with('Gagal membuat pembayaran');
        }
    }
    public function callApiIpaymuBtb($data)
    {
        $body = json_encode($data['body'], JSON_UNESCAPED_SLASHES);

        $requestBody  = strtolower(hash('sha256', $body));

        $secret       = 'SANDBOX30C3DCD3-EA90-4DB6-B98A-2F17B6AF6FDA';
        $va           = '0000002413132123';
        $stringToSign = 'POST:' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');

        $headers = [
            'Content-Type'  => 'application/json',
            'va'            => $va,
            'signature'     => $signature,
            'timestamp'     => $timestamp,
            // 'allow'=>'Access-Control-Allow-Origin: http://127.0.0.1:8000'
        ];

        \Log::info('HIT-IPAYMU-REQUEST' . $va, $data);

        $filename    = storage_path() . '/log/hit-ipaymu/callapi/' . date('Y-m-d') . '.log';
        $directory   = dirname($filename);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        $clog       = "TIME: " . date('Y-m-d H:i:s') . " \n";
        $clog      .= 'IP: ' . request()->ip() ?? 'CRON' . "\n";
        $clog      .= "HEADER :" . " \n";
        $clog      .= json_encode($headers) . " \n";
        $clog      .= "REQUEST :" . " \n";
        $clog      .= json_encode($data) . " \n";
        $h           = file_put_contents($filename, $clog, FILE_APPEND);

        $client = new Client([
            'headers' => $headers
        ]);

        try {
            $response = $client->request($data['method'], $data['url'], [
                'body' => $body
            ]);

            $data['res'] = $response->getBody()->getContents();
            $data['status'] = 200;

            \Log::info('HIT-IPAYMU-RESPONSE' . $va, $data);

            $clog      .= "STATUS: " . $data['status'] . "\n";
            $clog      .= "RESPONSE: " . json_encode($data['res']) . "\n";
            $clog      .= "-----------------------------------------\n\n";
            $h           = file_put_contents($filename, $clog, FILE_APPEND);

            return $data;
        } catch (ClientException $e) {
            $data['req'] = $e->getRequest();
            $data['resp'] = $e->getResponse();
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;

            \Log::error('HIT-IPAYMU-ERROR' . $va, $data);

            $clog      .= "STATUS: " . $data['status'] . "\n";
            $clog      .= "RESPONSE: " . json_encode($data['resp']) . "\n";
            $clog      .= "ERROR: " . json_encode($data['msg']) . "\n";
            $clog      .= "-----------------------------------------\n\n";
            $h           = file_put_contents($filename, $clog, FILE_APPEND);

            return $data;
        }
    }
    public function paymentsuccess(Request $request)
    {
        // dd($request->all());
        $id = auth()->user()->id;
        $order = Order::where('user_id', $id)->where('status', 'pembayaran di proses')->where('type_order', $request->type)->get();
        $transaksi = Transaksi::where('user_id', $id)->where('order_id', $order[0]->id)->where('status', 'pembayaran di proses')->get();

        if ($request->status == 'berhasil') {

            foreach ($order as $is) {
                $trans = Order::find($is->id);
                $trans->status = $request->status;
                $trans->save();
            }
            foreach ($transaksi as $item) {
                $topup = Transaksi::find($item->id);
                $topup->status = $request->status;
                $topup->save();
            }

            // if($request->type == 'undangan-online'){
            //     $undangan = new UndanganOrder();
            //     $undangan->title = $request->title;
            //     $undangan->pria = $request->pria;
            //     $undangan->wanita = $request->wanita;
            //     $undangan->tempat = $request->tempat;
            //     $undangan->tglmulai = $request->tglmulai;
            //     $undangan->tglselesai = $request->tglselesai;
            //     $undangan->waktumulai = $request->waktumulai;
            //     $undangan->waktuselesai = $request->waktuselesai;
            //     $undangan->save();
            // }

            return redirect()->route('payment.transaksi')->with('success', 'Top up berhasil');
        } else {
            return abort(404);
        }

        // return view('ipaymu.success');
    }
    public function notify(Request $request)
    {
        $id = auth()->user()->id;
        $order = Order::where('user_id', $id)->where('status', 'pembayaran di proses')->where('type_order', $request->type)->get();
        $transaksi = Transaksi::where('user_id', $id)->where('order_id', $order[0]->id)->where('status', 'pembayaran di proses')->get();

        if ($request->status == 'berhasil') {

            foreach ($order as $is) {
                $trans = Order::find($id->id);
                $trans->status = $request->status;
                $trans->save();
            }
            foreach ($transaksi as $item) {
                $topup = Transaksi::find($item->id);
                $topup->status = $request->status;
                $topup->save();
            }

            return redirect()->route('payment.transaksi')->with('success', 'bayar berhasil');
        } else {
            return abort(404);
        }
    }

    public function ipaymuundangan(Request $request)
    {
        // dd($request->all());
        $iduser = auth()->user()->id;
        $paket = Theme::where('id', $request->theme)->get();
        $customer = Customer::where('user_id', $iduser)->get();

        $data['url'] = 'https://sandbox.ipaymu.com/api/v2/payment';

        // dd($total);
        $jml = [
            'total' => $paket[0]->price,
            'type' => "undangan-online",
            // "title" => $request->title,
            // "pria" => $request->pria,
            // "wanita" => $request->wanita,
            // "tempat" => $request->tempat,
            // "tglmulai" => $request->tglmulai,
            // "tglselesai" => $request->tglselesai,
            // "waktumulai" => $request->waktumulai,
            // "waktuselesai" => $request->waktuselesai
        ];

        $data['body'] = [
            'name' => array(auth()->user()->name), //array($request->name),
            'email' => array(auth()->user()->email), //array($request->email),
            'product' => array($paket[0]->name), //array($pacakage),
            'price' => array($paket[0]->price),
            'qty' => array(1), //array($request->qty),
            'returnUrl' => route('payment.success', $jml),
            'notifyUrl' => route('payment.notify'),
            'comments' => 'order produk',
            'referenceId' => '1234',
            'vistreason' => 'chest hurting bad'
        ];
        $data['method'] = 'POST';

        $result = $this->callApiIpaymuBtb($data);
        // dd($result);
        if ($result['status'] == 200) {
            // DB::beginTransaction();
            try {
                $response = json_decode($result['res']);
                // dd($response);
                $data['title']  = 'Pembayaran Ticket';
                $data['trxData'] = $response->Data;
                $data['url'] = $response->Data->Url;
                // dd($data);
                $ou = new UndanganOrder;
                $ou->title = $request->title;
                $ou->theme_id = $paket[0]->id;
                $ou->customer_id = $customer[0]->id;
                $ou->user_id = $iduser;
                $ou->nama_pria = $request->pria;
                $ou->nama_wanita = $request->wanita;
                $ou->tgl_mulai = $request->tglmulai;
                $ou->tgl_selesai = $request->tglselesai;
                $ou->tempat_acara = $request->tempat;
                $ou->maps = $request->maps;
                $ou->waktu_mulai = $request->waktumulai;
                $ou->waktu_selesai = $request->waktuselesai;
                $ou->save();

                $trans = new Order;
                $trans->total = $paket[0]->price;
                $trans->package_id = $paket[0]->id;
                $trans->customer_id = $customer[0]->id;
                $trans->user_id = $iduser;
                $trans->status = 'pembayaran di proses';
                $trans->type_order = 'undangan-online';
                $trans->save();

                $topup = new Transaksi;
                $topup->user_id = $iduser;
                $topup->total = $paket[0]->price;
                $topup->order_id = $trans->id;
                $topup->customer_id = $customer[0]->id;
                $topup->status = 'pembayaran di proses';
                $topup->url_pembayaran = $response->Data->Url;
                $topup->save();

                return redirect()->to($response->Data->Url);
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('Gagal membuat pembayaran');
            }
        } else {
            return back()->with('Gagal membuat pembayaran');
        }
    }
}
