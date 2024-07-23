<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Search query
        $search = $request->input('search');
        
        // Fetch menus with pagination and search
        $menus = Menu::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(8); // Adjust the number of items per page as needed
        
        return view('pages.user.menu.index', compact('menus', 'search'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return view('pages.user.menu.show', compact('menu'));
    }
}

