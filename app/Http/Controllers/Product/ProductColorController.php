<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductColor\ProductColorStoreRequest;
use App\Http\Requests\Product\ProductColor\ProductColorUpdateRequest;
use App\Models\ProductColor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $productColors = ProductColor::all();

        return view('app.products.product-colors.index', compact('productColors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.products.product-colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductColorStoreRequest $request): RedirectResponse
    {
        ProductColor::create($request->validated());

        return to_route('app.product-colors.index')->with('success', __('Cor criada com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductColor $productColor): View
    {
        return view('app.products.product-colors.show', compact('productColor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductColor $productColor): View
    {
        return view('app.products.product-colors.edit', compact('productColor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductColorUpdateRequest $request, ProductColor $productColor): RedirectResponse
    {
        $productColor->update($request->validated());

        return to_route('app.product-colors.index')->with('success', __('Cor atualizada com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductColor $productColor)
    {
        if ($productColor->productVariants->count()) {
            return to_route('app.product-colors.show', $productColor)->with('warning', __('Não foi possível excluir a categoria. Ainda existem produtos vinculados a ela.'));
        }

        try {
            $productColor->delete();
            return to_route('app.product-colors.index')->with('success', __('Cor excluída com sucesso!'));
        } catch (\Exception $e) {
            return to_route('app.product-colors.show', $productColor)->with('warning', __('Ocorreu um erro ao excluir a categoria selecionada.'));
        }
    }
}
