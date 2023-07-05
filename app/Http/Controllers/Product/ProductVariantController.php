<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductVariantRequest;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductVariantController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request): View
    {
        $request->validate(['product_id' => 'required']);

        $productId = $request->product_id;
        $productSizes = ProductSize::where('active', true)->get();

        return view('app.products.product-variants.create', compact('productId', 'productSizes'));
    }

    public function store(ProductVariantRequest $request): RedirectResponse
    {
        $productVariant = ProductVariant::create($request->validated());

        return to_route('app.products.show', $productVariant->product_id)->with('success', __('Variação cadastrada com sucesso!'));
    }

    public function show(ProductVariant $productVariant): View
    {
        $productSizes = ProductSize::where('active', true)->get();

        return view('app.products.product-variants.show', compact('productVariant', 'productSizes'));
    }

    public function edit(ProductVariant $productVariant): View
    {
        $productSizes = ProductSize::where('active', true)->get();

        return view('app.products.product-variants.edit', compact('productVariant', 'productSizes'));
    }

    public function update(ProductVariantRequest $request, ProductVariant $productVariant)
    {
        $productVariant->update($request->validated());

        return to_route('app.products.show', $productVariant->product_id)
            ->with('success', __('Variaçao atualizada com sucesso!'));
    }

    public function destroy(ProductVariant $productVariant)
    {
        //
    }
}
