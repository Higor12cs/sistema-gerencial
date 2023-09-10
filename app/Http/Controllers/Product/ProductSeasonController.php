<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductSeasonRequest;
use App\Models\ProductSeason;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductSeasonController extends Controller
{
    public function index(): View
    {
        $productSeasons = ProductSeason::with('createdBy')->get();

        return view('app.products.product-seasons.index', compact('productSeasons'));
    }

    public function create(): View
    {
        return view('app.products.product-seasons.create');
    }

    public function store(ProductSeasonRequest $request): RedirectResponse
    {
        ProductSeason::create($request->validated());

        return to_route('app.product-seasons.index')->with('success', __('Temporada criada com sucesso!'));
    }

    public function show(ProductSeason $productSeason): View
    {
        return view('app.products.product-seasons.show', compact('productSeason'));
    }

    public function edit(ProductSeason $productSeason): View
    {
        return view('app.products.product-seasons.edit', compact('productSeason'));
    }

    public function update(ProductSeasonRequest $request, ProductSeason $productSeason): RedirectResponse
    {
        $productSeason->update($request->validated());

        return to_route('app.product-seasons.index')->with('success', __('Temporada atualizada com sucesso!'));
    }

    public function destroy(ProductSeason $productSeason)
    {
        if ($productSeason->products->count()) {
            return to_route('app.product-seasons.show', $productSeason)->with('warning', __('Não foi possível excluir a temporada. Ainda existem produtos vinculados a ela.'));
        }

        try {
            $productSeason->delete();

            return to_route('app.product-seasons.index')->with('success', __('Temporada excluída com sucesso!'));
        } catch (\Exception $e) {
            return to_route('app.product-seasons.show', $productSeason)->with('warning', __('Ocorreu um erro ao excluir a temporada selecionada.'));
        }
    }
}
