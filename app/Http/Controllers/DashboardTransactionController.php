<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regency;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        })->get();
            
        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('users_id', Auth::user()->id);
                // $transaction->where('status','menunggu');
            })->get();

        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }
    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->findOrFail($id);
        $user = User::where('id', $transaction->transaction->users_id)->get();
        // dd($user);
        // dd($transaction->transaction->user->provinces_id);
        // dd($transaction->transaction->user->regencies_id, Regency::find($transaction->transaction->user->regencies_id));
        return view('pages.dashboard-transaction-details-penjual', [
            'transaction' => $transaction,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details-penjual', $id);
    }


    public function confirm($id)
    {
        // dd($id);
        $item = Transaction::findOrFail($id);
        $item->status = "diterima";
        $item->save();

        return redirect()->route('dashboard-transaction');
    }

    
}
