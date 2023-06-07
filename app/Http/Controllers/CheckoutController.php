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

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // //save user data
        // $user = Auth::user();
        // // $user->update($request->except('total_price'));

        // //proses checkout
        // $code = 'STORE-' . mt_rand(000000,999999);
        // $cart = Cart::with(['product', 'user'])
        // ->where('users_id', Auth::user()->id)
        // ->get();

        // //Transaction create
        // $transaction = Transaction::create([
        //     'users_id'=> Auth::user()->id,
        //     // 'inscurance_price' => 0,
        //     'shipping_price' => 0,
        //     'total_price' => $request->total_price,
        //     'transaction_status' => 'PENDING',
        //     'code' => $code
        // ]);

        // foreach($cart as $cart) {
        //     $trx = 'TRX-' . mt_rand(000000,999999);

        //     'TransactionDetail_id'::create([
        //         'transaction_id' => $transaction->id,
        //         'products_id' => $cart->product->id,
        //         'price' => $cart->product->price,
        //         'total_price'=> $request -> total_price,
        //         // 'transaction_status' => 'PENDING',
        //         'resi'=> '',
        //         'code' => $trx

        //     ]);

        // }

        // return dd($transaction);
    }

    public function callback(Request $request)
    {

    }
}
