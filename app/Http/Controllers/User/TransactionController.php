<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = [
            'transactions' => Transaction::where('user_id', auth()->user()->id)->get(),
        ];
        return view('pages.user.transaction.index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer',
            'menu' => 'required|string',
            // 'payment_proof' => 'required|integer',
            'total_price' => 'required|integer',
        ];
        $validated = $request->validate($rules);

        if ($validated) {
            $validated['payment_proof'] = '';
            $validated['status'] = 'PENDING';
            Transaction::create($validated);
            Cart::where('user_id', auth()->user()->id)->delete();
        }

        return redirect()->route('index');
    }
}
