<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $data = [
            'menus' => $menus
        ];
        return view('pages.user.menu.index', $data);
    }
}
