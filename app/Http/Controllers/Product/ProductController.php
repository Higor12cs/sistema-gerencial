<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductSeason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::with('productBrand')->with('productCategory')->with('productSeason')->get();

        return view('app.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $productBrands = ProductBrand::where('active', true)->orderBy('name')->get();
        $productCategories = ProductCategory::where('active', true)->orderBy('name')->get();
        $productSeasons = ProductSeason::where('active', true)->orderBy('name')->get();

        return view('app.products.create', compact('productBrands', 'productCategories', 'productSeasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return to_route('app.products.index')->with('success', __('Produto criado com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $productBrands = ProductBrand::where('active', true)->orderBy('name')->get();
        $productCategories = ProductCategory::where('active', true)->orderBy('name')->get();
        $productSeasons = ProductSeason::where('active', true)->orderBy('name')->get();

        return view('app.products.show', compact('product', 'productBrands', 'productCategories', 'productSeasons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $productBrands = ProductBrand::where('active', true)->orderBy('name')->get();
        $productCategories = ProductCategory::where('active', true)->orderBy('name')->get();
        $productSeasons = ProductSeason::where('active', true)->orderBy('name')->get();

        return view('app.products.edit', compact('product', 'productBrands', 'productCategories', 'productSeasons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return to_route('app.products.index')->with('success', __('Produto atualizado com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
