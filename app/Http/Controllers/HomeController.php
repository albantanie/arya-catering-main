<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        // Fetch menus with search and pagination
        $menus = Menu::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(8); 


      
        return view('pages.index',compact('menus', 'search'));
    }

    public function add(Request $request)
{
    if (!auth()->check()) {
        // Redirect to the login page with a message
        return redirect()->route('login')->with('error', 'You need to log in first.');
    }

    // Proceed with adding the item to the cart

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Item added to cart successfully.');
}
}
