<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Package;
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
        $customer = Customer::where('user_id',$iduser)->get();
        $paket = Package::where('id',$id)->get();
        return view('order',compact('customer','paket'));
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

    public function ipaymu($id){

            $data['url'] = 'https://sandbox.ipaymu.com/api/v2/payment';
            $jmltopup = $request->price;

            $codeunix = $this->generateRandomString(3);

            $total = intval($jmltopup) + intval($codeunix);

            // dd($total);
            $jml = [
                'total'=>$jmltopup,
                'pin' => $pin
            ];
            
            $data['body'] = [
                'name' => array(auth()->user()->name), //array($request->name),
                'email' => array(auth()->user()->email),//array($request->email),
                'product' =>array('subscribe'), //array($pacakage),
                'price' =>array($total),
                'qty' => array(1),//array($request->qty),
                'returnUrl' => route('payment.success',$jml),
                'notifyUrl' => route('payment.notify'),
                'comments' => 'order produk',
                'referenceId' => '1234',
                'vistreason' => 'chest hurting bad'
            ];
            $data['method'] = 'POST';

            $result = $this->callApiIpaymuBtb($data);
            // dd($result);
            if($result['status'] == 200){
                // DB::beginTransaction();
                try{
                    $response = json_decode($result['res']);
                    // dd($response);
                    $data['title']  = 'Pembayaran Ticket';
                    $data['trxData'] = $response->Data;
                    $data['url'] = $response->Data->Url;
                    // dd($data);
                    $trans = new Transaction;
                    $trans->price = $total;
                    $trans->id_user = auth()->user()->id;
                    $trans->totalsaldo = auth()->user()->saldo + $total;
                    $trans->status = 'top-up';
                    $trans->payment_category = '';
                    $trans->save();

                    $topup = new TopUp;
                    $topup->id_user = auth()->user()->id;
                    $topup->id_transaction = $trans->id;
                    $topup->price = $jmltopup;
                    $topup->code = $response->Data->SessionID;
                    $topup->url = $response->Data->Url;
                    $topup->save();

                    return redirect()->to($response->Data->Url);

                } catch (Exception $e){
                    DB::rollBack();
                    return back()->with('Gagal membuat pembayaran');
                }
            } else {
            return back()->with('Gagal membuat pembayaran');
            }
    }
    public function callApiIpaymuBtb($data)
    {
        $body = json_encode($data['body'],JSON_UNESCAPED_SLASHES);

        $requestBody  = strtolower(hash('sha256', $body));
        
        $secret       = 'SANDBOX30C3DCD3-EA90-4DB6-B98A-2F17B6AF6FDA';
        $va           = '0000002413132123';
        $stringToSign = 'POST:' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');

        $headers = [
            'Content-Type'  =>'application/json',
            'va'            => $va,
            'signature'     => $signature,
            'timestamp'     => $timestamp,
            // 'allow'=>'Access-Control-Allow-Origin: http://127.0.0.1:8000'
        ];

        \Log::info('HIT-IPAYMU-REQUEST'.$va, $data);

        $filename    = storage_path() . '/log/hit-ipaymu/callapi/' . date('Y-m-d') . '.log';
        $directory   = dirname($filename);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        $clog       = "TIME: ".date('Y-m-d H:i:s')." \n";
        $clog      .= 'IP: ' . request()->ip() ?? 'CRON' . "\n";
        $clog      .= "HEADER :". " \n";
        $clog      .= json_encode($headers) . " \n";
        $clog      .= "REQUEST :". " \n";
        $clog      .= json_encode($data) . " \n";
        $h           = file_put_contents($filename, $clog, FILE_APPEND);

        $client = new Client([
            'headers' => $headers
        ]);

        try {
            $response = $client->request($data['method'], $data['url'],[
                'body' => $body
            ]);

            $data['res'] = $response->getBody()->getContents();
            $data['status'] = 200;

            \Log::info('HIT-IPAYMU-RESPONSE'.$va, $data);

            $clog      .= "STATUS: ". $data['status'] . "\n";
            $clog      .= "RESPONSE: ". json_encode($data['res']) . "\n";
            $clog      .= "-----------------------------------------\n\n";
            $h           = file_put_contents($filename, $clog, FILE_APPEND);

            return $data;

        } catch (ClientException $e) {
            $data['req'] = $e->getRequest();
            $data['resp'] = $e->getResponse();
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;

            \Log::error('HIT-IPAYMU-ERROR'.$va, $data);

            $clog      .= "STATUS: ". $data['status'] . "\n";
            $clog      .= "RESPONSE: ". json_encode($data['resp']) . "\n";
            $clog      .= "ERROR: ". json_encode($data['msg']) . "\n";
            $clog      .= "-----------------------------------------\n\n";
            $h           = file_put_contents($filename, $clog, FILE_APPEND);

            return $data;
        }
    }
    public function paymentsuccess(Request $request){
        // dd($request->total);
        $id = auth()->user()->id;
        if($request->status == 'berhasil'){

            $saldo = auth()->user()->saldo + $request->total;

            $data = User::find($id);
            $data->status = 'silver';
            $data->saldo = $saldo;
            $data->save();

            return redirect()->route('vippost',$request->pin)->with('success', 'Top up berhasil');
        }else{
            return abort(404);
        }

        // return view('ipaymu.success');
    }
    public function notify(Request $request){
        $id = auth()->user()->id;
        if($request->status == 'berhasil'){

            $saldo = auth()->user()->saldo + $request->total;

            $data = User::find($id);
            $data->status = 'silver';
            $data->saldo = $saldo;
            $data->save();

            return redirect()->route('vippost',$request->pin)->with('success', 'Top up berhasil');
        }else{
            return abort(404);
        }
        //LOG ES
        // $logger =  New \App\Libs\Logger;

        // $log['type'] = 'merchant-premium-notify';
        // $log['subtype'] = 'notify';
        // $log['url']  = \request()->getHost();
        // $log['ip']   = request()->ip();
        // $log['date'] = date('Y-m-d H:i:s');
        // $log['requestheaders']  = \json_encode($request->headers->all());
        // $log['requestparams']   = \json_encode($request->all());

        // $logger->generate($log);
        //ENDLOG ES

        // if($request->sid) {
            // $transaction = Transaction::where('ipaymu_sid', $request->sid)->first();
            // if($transaction) {
// dd($request->status);
                // DB::beginTransaction();
                // try {
                //     if(strtolower($request->status) == 'berhasil') {
                //         $transaction->status         = 1;
                //         $transaction->ipaymu_id      = $request->trx_id;
                //         $transaction->save();


                //         $res['status'] = 'Success';
                //         $res['info']  = 'Success';

                //     } elseif(strtolower($request->status) == 'gagal') {
                //         $transaction->status         = 2;
                //         $transaction->save();

                //         $res['status'] = 'Gagal';
                //         $res['info']  = 'Gagal';

                //     } else {

                //         $res['status'] = 'Pending';
                //         $res['info']  = 'Pending';
                //     }

                //     DB::commit();
                // } catch (Exception $e) {
                //     \report($e);
                //     DB::rollBack();
                // }

                // return $request->status;
            // }
        // }

    }

    
    function generateRandomString($length) {
        $characters = '0123456789';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        return $randomString;
    }
}
