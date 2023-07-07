<?php

namespace App\Observers\Product;

use App\Models\ProductVariant;
use App\Models\Stock;

class ProductVariantObserver
{
    public function created(ProductVariant $productVariant): void
    {
        Stock::create([
            'product_variant_id' => $productVariant->id,
        ]);
    }
}
