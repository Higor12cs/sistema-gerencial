<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Preto', 'Branco', 'Vermelho', 'Azul', 'Amarelo', 'Verde', 'Rosa', 'Roxo', 'Laranja', 'Marrom', 'Cinza', 'Bege', 'Prata', 'Dourado'
        ];

        foreach ($colors as $color) {
            DB::table('product_colors')->insert([
                'name' => $color,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
