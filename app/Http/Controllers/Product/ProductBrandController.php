<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductBrandRequest;
use App\Models\ProductBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductBrandController extends Controller
{
    public function index(): View
    {
        $productBrands = ProductBrand::with('createdBy')->get();

        return view('app.products.product-brands.index', compact('productBrands'));
    }

    public function create(): View
    {
        return view('app.products.product-brands.create');
    }

    public function store(ProductBrandRequest $request): RedirectResponse
    {
        ProductBrand::create($request->validated());

        return to_route('app.product-brands.index')->with('success', __('Marca criada com sucesso!'));
    }

    public function show(ProductBrand $productBrand): View
    {
        return view('app.products.product-brands.show', compact('productBrand'));
    }

    public function edit(ProductBrand $productBrand): View
    {
        return view('app.products.product-brands.edit', compact('productBrand'));
    }

    public function update(ProductBrandRequest $request, ProductBrand $productBrand): RedirectResponse
    {
        $productBrand->update($request->validated());

        return to_route('app.product-brands.index')->with('success', __('Marca atualizada com sucesso!'));
    }

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
