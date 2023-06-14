<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductVariant\ProductVariantStoreRequest;
use App\Http\Requests\Product\ProductVariant\ProductVariantUpdateRequest;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $request->validate(['product_id' => 'required']);

        $productId = $request->product_id;
        $productColors = ProductColor::where('active', true)->get();
        $productSizes = ProductSize::where('active', true)->get();

        return view('app.products.product-variants.create', compact('productId', 'productColors', 'productSizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductVariantStoreRequest $request): RedirectResponse
    {
        $productVariant = ProductVariant::create($request->validated());

        return to_route('app.products.show', $productVariant->product_id)->with('success', __('Variação cadastrada com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant): View
    {
        $productColors = ProductColor::where('active', true)->get();
        $productSizes = ProductSize::where('active', true)->get();

        return view('app.products.product-variants.show', compact('productVariant', 'productColors', 'productSizes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $productVariant): View
    {
        $productColors = ProductColor::where('active', true)->get();
        $productSizes = ProductSize::where('active', true)->get();

        return view('app.products.product-variants.edit', compact('productVariant', 'productColors', 'productSizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductVariantUpdateRequest $request, ProductVariant $productVariant)
    {
        $productVariant->update($request->validated());

        return to_route('app.products.show', $productVariant->product_id)
            ->with('success', __('Variaçao atualizada com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $productVariant)
    {
        //
    }
}
