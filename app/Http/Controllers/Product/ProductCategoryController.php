<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCategory\ProductCategoryStoreRequest;
use App\Http\Requests\Product\ProductCategory\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $productCategories = ProductCategory::with('createdBy')->get();

        return view('app.products.product-categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.products.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryStoreRequest $request): RedirectResponse
    {
        ProductCategory::create($request->validated());

        return to_route('app.product-categories.index')->with('success', __('Categoria criada com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory): View
    {
        return view('app.products.product-categories.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory): View
    {
        return view('app.products.product-categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryUpdateRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $productCategory->update($request->validated());

        return to_route('app.product-categories.index')->with('success', __('Categoria atualizada com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
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
