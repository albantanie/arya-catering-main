<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = [
            'transactions' => Transaction::all(),
        ];
        return view('pages.admin.transaction.index', $data);
    }

    public function approve($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->status = 'APPROVED';
            $transaction->save();
        }

        return redirect()->route('admin.transaction.index')->with('success', 'Transaction approved successfully.');
    }

    public function reject($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->status = 'REJECTED';
            $transaction->save();
        }

        return redirect()->route('admin.transaction.index')->with('success', 'Transaction rejected successfully.');
    }
}
