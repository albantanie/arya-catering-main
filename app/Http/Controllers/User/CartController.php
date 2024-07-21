<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            'carts' => Cart::where('user_id', auth()->user()->id)->get(),
        ];
        return view('pages.user.cart.index', $data);
    }

    public function add(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'amount' => 'required|integer',
        ];

        $validated = $request->validate($rules);

        if ($validated) {
            if (Cart::where('user_id', $validated['user_id'])->where('menu_id', $validated['menu_id'])->exists()) {
                $cart = Cart::where('user_id', $validated['user_id'])->where('menu_id', $validated['menu_id'])->first();
                $cart->amount += $validated['amount'];
                $cart->save();
            } else {
                Cart::create($validated);
            }
        }

        return redirect()->route('index');
    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->route('cart.index');
    }
}
