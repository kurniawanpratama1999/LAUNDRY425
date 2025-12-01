<?php

namespace Database\Seeders;

use App\Models\LevelMenu;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class F_LevelMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = Menu::all();

        foreach ($menus as $menu) {
            LevelMenu::create([
                'level_id' => 1,
                'menu_id' => $menu->id
            ]);
        }
    }
}
