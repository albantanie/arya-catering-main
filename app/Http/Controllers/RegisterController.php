<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ];

        $validated = $request->validate($rules);
        if ($validated) {
            $validated['password'] = bcrypt($validated['password']);
            User::create($validated);
        }

        return redirect()->route('login');
    }
}
