<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $menus = Menu::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(8); // Ensure this returns a LengthAwarePaginator instance
    
        return view('pages.admin.menu.index', [
            'menus' => $menus,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('pages.admin.menu.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'string|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
        $validated = $request->validate($rules);

        if ($validated) {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('images', 'public');
            }
            Menu::create($validated);
            return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
        }

        return redirect()->back()->withInput()->withErrors($validated);
    }

    public function edit($id)
    {
        $data = [
            'menu' => Menu::findOrFail($id),
        ];
        return view('pages.admin.menu.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'string|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
        $validated = $request->validate($rules);

        if ($validated) {
            $menu = Menu::findOrFail($id);
            $menu->name = $validated['name'];
            $menu->price = $validated['price'];
            $menu->description = $validated['description'];
            if ($request->hasFile('image')) {
                $menu->image = $request->file('image')->store('images', 'public');
            }
            $menu->save();
            return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
        }

        return redirect()->back()->withInput()->withErrors($validated);
    }

    public function destroy($id)
    {
        Menu::destroy($id);
        Cart::where('menu_id', $id)->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
