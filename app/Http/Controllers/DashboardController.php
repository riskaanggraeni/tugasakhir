<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        });
        // $transactions = DB::table('transactions')
        //                 ->join('users','transactions.users_id','=','users.id','left')
        //                 ->join('products','users.id','=','products.users_id','left');
        // dd($transactions->get());  
        $revenue = $transactions->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();

        return view('pages.penjual.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer'=> $customer
        ]);
    }
}
