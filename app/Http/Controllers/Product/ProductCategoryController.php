<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    public function index(): View
    {
        $productCategories = ProductCategory::with('createdBy')->get();

        return view('app.products.product-categories.index', compact('productCategories'));
    }

    public function create(): View
    {
        return view('app.products.product-categories.create');
    }

    public function store(ProductCategoryRequest $request): RedirectResponse
    {
        ProductCategory::create($request->validated());

        return to_route('app.product-categories.index')->with('success', __('Categoria criada com sucesso!'));
    }

    public function show(ProductCategory $productCategory): View
    {
        return view('app.products.product-categories.show', compact('productCategory'));
    }

    public function edit(ProductCategory $productCategory): View
    {
        return view('app.products.product-categories.edit', compact('productCategory'));
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $productCategory->update($request->validated());

        return to_route('app.product-categories.index')->with('success', __('Categoria atualizada com sucesso!'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->products->count()) {
            return to_route('app.product-categories.show', $productCategory)->with('warning', __('Não foi possível excluir a categoria. Ainda existem produtos vinculados a ela.'));
        }

        try {
            $productCategory->delete();

            return to_route('app.product-categories.index')->with('success', __('Categoria excluída com sucesso!'));
        } catch (\Exception $e) {
            return to_route('app.product-categories.show', $productCategory)->with('warning', __('Ocorreu um erro ao excluir a categoria selecionada.'));
        }
    }
}
