<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Order;
use App\Models\UndanganOrder;
use App\Models\Theme;
use App\Models\Transaksi;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

        return view('customer.transaksi.index', compact('data'));
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

    public function ipaymu($id)
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
        // dd($request->total);
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
            'type' => "undangan-online"
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
