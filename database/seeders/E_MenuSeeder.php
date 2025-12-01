<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class E_MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [[
            'icon' => 'false',
            'name' => 'level',
            'master' => 'true',
            'link' => '/level',
        ], [
            'icon' => 'false',
            'name' => 'user',
            'master' => 'true',
            'link' => '/user',
        ], [
            'icon' => 'false',
            'name' => 'service',
            'master' => 'true',
            'link' => '/service',
        ], [
            'icon' => 'false',
            'name' => 'customer',
            'master' => 'true',
            'link' => '/customer',
        ], [
            'icon' => 'false',
            'name' => 'menu',
            'master' => 'true',
            'link' => '/menu',
        ], [
            'icon' => 'false',
            'name' => 'permission',
            'master' => 'true',
            'link' => '/permission',
        ], [
            'icon' => 'false',
            'name' => 'transaction',
            'master' => 'false',
            'link' => '/transaction',
        ], [
            'icon' => 'false',
            'name' => 'order',
            'master' => 'false',
            'link' => '/order',
        ], [
            'icon' => 'false',
            'name' => 'pickup',
            'master' => 'false',
            'link' => '/pickup',
        ], [
            'icon' => 'false',
            'name' => 'report',
            'master' => 'false',
            'link' => '/report',
        ]];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
