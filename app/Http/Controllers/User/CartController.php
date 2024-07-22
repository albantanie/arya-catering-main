<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Alert; // Use the facade

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
                
                Alert::success('Success', 'Item quantity updated in your cart.'); // Use the facade
            } else {
                Cart::create($validated);
                
                Alert::success('Success', 'Item added to your cart.'); // Use the facade
            }
        }

        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        $cart = Cart::find($id);
    
        if (!$cart) {
            Alert::error('Error', 'Cart item not found.'); // Use the facade
            return redirect()->route('user.cart.index');
        }
    
        $cart->delete();
    
        Alert::success('Success', 'Cart item deleted successfully.'); // Use the facade
        return redirect()->route('user.cart.index');
    }
}
