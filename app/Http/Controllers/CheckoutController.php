<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses checkout
        $code = 'TRX' . mt_rand(000000,999999);
        // $code = 'STORE-' . mt_rand(000000,999999);
        $cart = Cart::with(['product', 'user'])
        ->where('users_id', Auth::user()->id)
        ->get();

        // dd($request->total_ongkir);
        //Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            // 'inscurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transactions_status' => 'PENDING',
            'code' => $code,
            'total_ongkir' => $request->total_ongkir,
        ]);

        foreach($cart as $cart) {
            $trx = 'TRX-' . mt_rand(000000,999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx,
                'kurir' => $request->kurir,
                'kurir_id' => $request->services,
                // 'kurir_id' => '0',

            ]);

        }

        //Hapus cart
        Cart::where('users_id', Auth::user()->id)->delete();


        // konfigurasi midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('services.midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('services.midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('services.midtrans.is3ds');

        // buat array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details'=> [
                'order_id'=> $code,
                'gross_amount'=> (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb'=> []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }

        // return dd($transaction);
    }

    public function callback(Request $request)
    {
        $transactionStatus = $request->input('transaction_status');
        $orderId = $request->input('order_id');

        // Proses sesuai dengan status transaksi
        if ($transactionStatus === 'settlement') {
            // Transaksi berhasil
            // Lakukan aksi yang sesuai, misalnya update status pesanan menjadi sukses
            Transaction::where('code', $orderId)->update([
                'transactions_status' => 'LUNAS',
            ]);
           $update =  DB::table('transactions')
            ->leftJoin('transaction_details', 'transactions.id', '=', 'transaction_details.transactions_id')
            ->where('transactions.code', $orderId)
            ->update(['transaction_details.shipping_status' => 'LUNAS']);
            // dd($update);
            // TransactionDetail::where('code', $orderId)->update([
            //     'shipping_status' => 'SAMPAI',
            // ]);
        } else if ($transactionStatus === 'cancel') {
            // Transaksi dibatalkan
            // Lakukan aksi yang sesuai, misalnya update status pesanan menjadi dibatalkan
            Transaction::where('code', $orderId)->update([
                'transactions_status' => 'Cancel',
            ]);
            
        } else if ($transactionStatus === 'deny') {
            // Transaksi ditolak
            // Lakukan aksi yang sesuai, misalnya update status pesanan menjadi ditolak
            Transaction::where('code', $orderId)->update([
                'transactions_status' => 'Ditolak',
            ]);
        }

        // Berikan respon kepada Midtrans agar callback berhasil
        return response()->json(['status' => 'success']);
    }
}
