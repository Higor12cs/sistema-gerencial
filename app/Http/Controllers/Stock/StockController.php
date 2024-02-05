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
                $query->selectRaw('SUM(current_stock.quantity)')
                    ->from('stocks as current_stock')
                    ->whereColumn('current_stock.product_id', '=', 'products.id');
            }, 'total_stock')
            ->selectSub(function ($query) {
                $query->selectRaw('SUM(trials_stock.quantity_on_trials)')
                    ->from('stocks as trials_stock')
                    ->whereColumn('trials_stock.product_id', '=', 'products.id');
            }, 'total_on_trials')
            ->get();

        return view('app.stock.index', compact('products'));
    }
}
