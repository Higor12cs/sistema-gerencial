<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class StockController extends Controller
{
    public function index(): View
    {
        $products = Product::select('products.*')
            ->with('productBrand', 'productCategory', 'productSeason')
            ->selectSub(function ($query) {
                $query->selectRaw('SUM(stocks.quantity)')
                    ->from('product_variants')
                    ->join('stocks', 'product_variants.id', '=', 'stocks.product_variant_id')
                    ->whereColumn('product_variants.product_id', 'products.id');
            }, 'total_stock')
            ->get();

        return view('app.stock.index', compact('products'));
    }
}
