<?php

namespace App\Observers\Product;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Stock;

class ProductObserver
{
    public function created(Product $product): void
    {
        ProductVariant::create([
            'product_id' => $product->id,
            'product_size_id' => 1,
        ]);
    }
}
