<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            'Único', 'PP', 'P', 'M', 'G', 'GG', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46',
        ];

        foreach ($sizes as $size) {
            DB::table('product_sizes')->insert([
                'name' => $size,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
