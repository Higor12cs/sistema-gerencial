<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductSizeRequest;
use App\Models\ProductSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductSizeController extends Controller
{
    public function index(): View
    {
        $productSizes = ProductSize::all();

        return view('app.products.product-sizes.index', compact('productSizes'));
    }

    public function create(): View
    {
        return view('app.products.product-sizes.create');
    }

    public function store(ProductSizeRequest $request): RedirectResponse
    {
        ProductSize::create($request->validated());

        return to_route('app.product-sizes.index')->with('success', __('Tamanho criado com sucesso!'));
    }

    public function show(ProductSize $productSize): View
    {
        return view('app.products.product-sizes.show', compact('productSize'));
    }

    public function edit(ProductSize $productSize): View
    {
        return view('app.products.product-sizes.edit', compact('productSize'));
    }

    public function update(ProductSizeRequest $request, ProductSize $productSize): RedirectResponse
    {
        $productSize->update($request->validated());

        return to_route('app.product-sizes.index')->with('success', __('Tamanho atualizado com sucesso!'));
    }

    public function destroy(ProductSize $productSize)
    {
        if ($productSize->productVariants->count()) {
            return to_route('app.product-sizes.show', $productSize)->with('warning', __('Não foi possível excluir a categoria. Ainda existem produtos vinculados a ela.'));
        }

        try {
            $productSize->delete();
            return to_route('app.product-sizes.index')->with('success', __('Tamanho excluída com sucesso!'));
        } catch (\Exception $e) {
            return to_route('app.product-sizes.show', $productSize)->with('warning', __('Ocorreu um erro ao excluir a categoria selecionada.'));
        }
    }
}
