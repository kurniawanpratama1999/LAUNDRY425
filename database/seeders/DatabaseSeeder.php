<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            A_LevelSeeder::class,
            B_UserSeeder::class,
            C_CustomerSeeder::class,
            D_ServiceSeeder::class,
            E_MenuSeeder::class,
            F_LevelMenuSeeder::class
        ]);
    }
}
