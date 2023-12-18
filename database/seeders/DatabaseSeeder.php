<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        $this->call(ProductSizesSeeder::class);
        $this->call(DefaultCustomerSeeder::class);
        // $this->call(PerformanceCheckSeeder::class);
    }
}
