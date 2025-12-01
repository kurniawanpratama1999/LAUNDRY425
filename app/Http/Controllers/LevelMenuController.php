<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\LevelMenu;
use App\Models\Menu;
use DB;
use Illuminate\Http\Request;

class LevelMenuController extends Controller
{
    public function index()
    {
        $level = Level::first();

        return redirect()->route('permission.show', $level->id);
    }

    public function show(int $id)
    {
        $levels = Level::all();
        $menus = Menu::all();
        $levelMenus = LevelMenu::where('level_id', '=', $id)->get();

        return view('pages.permission', compact('levels', 'menus', 'id', 'levelMenus'));
    }

    public function update(Request $req, int $id)
    {
        DB::beginTransaction();
        try {
            LevelMenu::where('level_id', '=', $id)->delete();

            $datas = $req->input('datas');

            foreach ($datas as $data) {
                LevelMenu::create([
                    'level_id' => $data['level_id'],
                    'menu_id' => $data['menu_id'],
                ]);
            }
            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('permission.index'),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
