<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use KobayashiIndo\RajaOngkir\Facades\RajaOngkir;


use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();

        // dd($carts);

        return view('pages.pembeli.cart', [
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
