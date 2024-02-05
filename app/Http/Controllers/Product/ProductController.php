<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductSeason;
use App\Models\ProductSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::select('products.*')
            ->with('productBrand', 'productCategory', 'productSeason')
            ->get();

        return view('app.products.products.index', compact('products'));
    }

    public function create(): View
    {
        $productBrands = ProductBrand::where('active', true)->orderBy('name')->get();
        $productCategories = ProductCategory::where('active', true)->orderBy('name')->get();
        $productSeasons = ProductSeason::where('active', true)->orderBy('name')->get();
        $productSizes = ProductSize::where('active', true)->orderBy('name')->get();

        return view('app.products.products.create', compact(
            'productBrands',
            'productCategories',
            'productSeasons',
            'productSizes'
        ));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        return to_route('app.products.index', $product)->with('success', __('Produto criado com sucesso!'));
    }

    public function show(Product $product): View
    {
        $productBrands = ProductBrand::where('active', true)->orderBy('name')->get();
        $productCategories = ProductCategory::where('active', true)->orderBy('name')->get();
        $productSeasons = ProductSeason::where('active', true)->orderBy('name')->get();
        $productSizes = ProductSize::where('active', true)->orderBy('name')->get();

        return view('app.products.products.show', compact('product', 'productBrands', 'productCategories', 'productSeasons', 'productSizes'));
    }

    public function edit(Product $product): View
    {
        $productBrands = ProductBrand::where('active', true)->orderBy('name')->get();
        $productCategories = ProductCategory::where('active', true)->orderBy('name')->get();
        $productSeasons = ProductSeason::where('active', true)->orderBy('name')->get();
        $productSizes = ProductSize::where('active', true)->orderBy('name')->get();

        return view('app.products.products.edit', compact('product', 'productBrands', 'productCategories', 'productSeasons', 'productSizes'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return to_route('app.products.index')->with('success', __('Produto atualizado com sucesso!'));
    }

    public function destroy(Product $product)
    {
        if ($product->isUsed()) {
            return redirect()->back()->with('danger', __('Este produto já foi utilizado e não pode ser excluído.'));
        }

        $product->delete();

        return to_route('app.products.index')->with('success', __('Produto atualizado com sucesso!'));
    }
}
