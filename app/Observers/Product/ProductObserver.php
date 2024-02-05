<?php

namespace App\Observers\Product;

use App\Models\Product;
use App\Models\Stock;

class ProductObserver
{
    public function created(Product $product): void
    {
        Stock::create([
            'product_id' => $product->id,
        ]);
    }
}
