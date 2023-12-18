<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerformanceCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $limit = 10000;

        for ($i = 1; $i <= $limit; $i++) {
            DB::table('product_brands')->insert($this->createBrandCategorySeason('Brand', $i));
            DB::table('product_categories')->insert($this->createBrandCategorySeason('Category', $i));
            if ($i <= $limit) {
                DB::table('product_seasons')->insert($this->createBrandCategorySeason('Season', $i));
            }
        }

        for ($i = 1; $i <= $limit; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'product_brand_id' => rand(1, 10),
                'product_category_id' => rand(1, 10),
                'product_season_id' => rand(1, 5),
                'active' => rand(0, 1),
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        for ($i = 1; $i <= $limit; $i++) {
            DB::table('product_variants')->insert([
                'product_id' => rand(1, 50),
                'product_size_id' => rand(1, 19),
                'sku' => 'SKU' . $i,
                'barcode' => 'BARCODE' . $i,
                'cost' => rand(100, 1000),
                'price' => rand(100, 1000),
                'active' => rand(0, 1),
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        for ($i = 1; $i <= $limit; $i++) {
            DB::table('customers')->insert([
                'name' => 'Customer ' . $i,
                'legal_name' => 'Legal Customer ' . $i,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        for ($i = 1; $i <= $limit; $i++) {
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => rand(1, 20),
                'date' => Carbon::now(),
                'total_cost' => $cost = rand(100, 1000),
                'discount' => $discount = rand(0, $cost),
                'total_price' => $cost - $discount,
                'observation' => 'Observation ' . $i,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            for ($j = 1; $j <= rand(1, 25); $j++) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_variant_id' => rand(1, 100),
                    'quantity' => $quantity = rand(1, 5),
                    'unit_price' => $unitPrice = rand(100, 1000),
                    'discount' => $itemDiscount = rand(0, $unitPrice),
                    'total_price' => ($unitPrice - $itemDiscount) * $quantity,
                    'created_by' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }

    private function createBrandCategorySeason($type, $i)
    {
        return [
            'name' => $type . ' ' . $i,
            'active' => rand(0, 1),
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
