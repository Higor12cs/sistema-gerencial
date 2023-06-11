<?php

namespace App\Http\Controllers\ProductSeason;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSeason\ProductSeasonStoreRequest;
use App\Http\Requests\ProductSeason\ProductSeasonUpdateRequest;
use App\Models\ProductSeason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductSeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $productSeasons = ProductSeason::with('createdBy')->get();

        return view('app.product-seasons.index', compact('productSeasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.product-seasons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSeasonStoreRequest $request): RedirectResponse
    {
        ProductSeason::create($request->validated());

        return to_route('app.product-seasons.index')->with('success', __('Temporada criada com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSeason $productSeason): View
    {
        return view('app.product-seasons.show', compact('productSeason'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductSeason $productSeason): View
    {
        return view('app.product-seasons.edit', compact('productSeason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductSeasonUpdateRequest $request, ProductSeason $productSeason): RedirectResponse
    {
        $productSeason->update($request->validated());

        return to_route('app.product-seasons.index')->with('success', __('Temporada atualizada com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
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
