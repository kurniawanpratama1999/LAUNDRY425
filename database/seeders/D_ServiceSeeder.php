<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class D_ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Cuci dan Gosok',
                'price' => 5000,
                'description' => '',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
