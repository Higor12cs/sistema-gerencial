<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductBrand\ProductBrandStoreRequest;
use App\Http\Requests\Product\ProductBrand\ProductBrandUpdateRequest;
use App\Models\ProductBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $productBrands = ProductBrand::with('createdBy')->get();

        return view('app.products.product-brands.index', compact('productBrands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.products.product-brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductBrandStoreRequest $request): RedirectResponse
    {
        ProductBrand::create($request->validated());

        return to_route('app.product-brands.index')->with('success', __('Marca criada com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductBrand $productBrand): View
    {
        return view('app.products.product-brands.show', compact('productBrand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductBrand $productBrand): View
    {
        return view('app.products.product-brands.edit', compact('productBrand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductBrandUpdateRequest $request, ProductBrand $productBrand): RedirectResponse
    {
        $productBrand->update($request->validated());

        return to_route('app.product-brands.index')->with('success', __('Marca atualizada com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductBrand $productBrand)
    {
        if ($productBrand->products->count()) {
            return to_route('app.product-brands.show', $productBrand)->with('warning', __('Não foi possível excluir a marca. Ainda existem produtos vinculados a ela.'));
        }

        try {
            $productBrand->delete();
            return to_route('app.product-brands.index')->with('success', __('Marca excluída com sucesso!'));
        } catch (\Exception $e) {
            return to_route('app.product-brands.show', $productBrand)->with('warning', __('Ocorreu um erro ao excluir a marca selecionada.'));
        }
    }
}
