<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class C_CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer =
            [
                'name' => 'Customer',
                'phone' => '0876XXXXXXX',
                'address' => 'Jalan lorem ipsum dolor sit amet No ',
            ];

        for ($i = 1; $i <= 2; $i++) {
            Customer::create([
                'name' => $customer['name'].$i,
                'phone' => $customer['phone'].$i,
                'address' => $customer['address'].$i,
            ]);
        }
    }
}
