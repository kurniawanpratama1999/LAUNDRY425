<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        return view('pages.menu', compact('menus'));
    }

    public function show(Request $req, int $id)
    {
        $menus = Menu::all();
        $menu = Menu::findOrFail($id);

        return view('pages.menu', compact('menus', 'menu'));
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'icon' => ['required', 'string'],
            'name' => ['required', 'string'],
            'link' => ['required', 'string'],
        ]);

        try {
            Menu::create($validated);

            return redirect()->route('menu.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        $menu = Menu::findOrFail($id);
        $validated = $req->validate([
            'icon' => ['required', 'string'],
            'name' => ['required', 'string'],
            'link' => ['required', 'string'],
        ]);

        try {
            $menu->update($validated);

            return redirect()->route('menu.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            Menu::destroy($id);

            return redirect()->route('menu.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }
}
