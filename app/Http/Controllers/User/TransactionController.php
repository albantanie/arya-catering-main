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
        $transactions = Transaction::where('user_id', auth()->user()->id)->get();
        
        return view('pages.user.transaction.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'menu' => 'required|string',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
            'total_price' => 'required|integer',
        ]);

        // Handle file upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            // Log the path for debugging
            \Log::info('Uploaded payment proof path: ' . $paymentProofPath);
        } else {
            return redirect()->back()->with('error', 'Bukti pembayaran tidak ditemukan.');
        }

        // Save transaction data
        $transaction = new Transaction();
        $transaction->user_id = $request->user_id;
        $transaction->menu = $request->menu;
        $transaction->payment_proof = $paymentProofPath; // Assign uploaded file path
        $transaction->total_price = $request->total_price;
        $transaction->status = 'PENDING';
        $transaction->save();

        // Clear shopping cart after checkout
        Cart::where('user_id', auth()->user()->id)->delete();

        return redirect()->route('user.index')->with('success', 'Pembelian berhasil! Mohon tunggu konfirmasi dari kami.');
    }
}

