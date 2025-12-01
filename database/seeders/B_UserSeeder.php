<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class B_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'level_id' => 1,
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin#123'),
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
