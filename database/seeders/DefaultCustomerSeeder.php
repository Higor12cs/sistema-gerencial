<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            'name' => 'Consumidor',
            'legal_name' => 'Consumidor',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
