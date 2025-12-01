<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class A_LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Admin',
            ],
        ];
        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
