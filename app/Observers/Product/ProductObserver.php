<?php

namespace App\Observers\Product;

use App\Models\Product;
use App\Models\ProductVariant;

class ProductObserver
{
    public function created(Product $product)
    {
        ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Tamanho Único',
        ]);
    }
}
