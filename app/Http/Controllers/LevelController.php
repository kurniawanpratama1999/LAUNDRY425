<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::where('deleted_at', '=', null)->get();

        return view('pages.level', compact('levels'));
    }

    public function show(Request $req, int $id)
    {
        $levels = Level::where('deleted_at', '=', null)->get();
        $level = Level::findOrFail($id);

        return view('pages.level', compact('levels', 'level'));
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'string'],
        ]);

        try {
            Level::create($validated);

            return redirect()->route('level.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        $level = Level::findOrFail($id);
        $validated = $req->validate([
            'name' => ['required', 'string'],
        ]);

        try {
            $level->update($validated);

            return redirect()->route('level.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            Level::destroy($id);

            return redirect()->route('level.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }
}
