<?php

namespace App\Http\Controllers\Trial;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Trial;
use App\Models\TrialItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrialController extends Controller
{
    public function index(): View
    {
        $trials = Trial::with('customer')->get();

        return view('app.trials.index', compact('trials'));
    }

    public function create(): View
    {
        $customers = Customer::where('active', true)->get();
        $products = Product::where('active', true)
            ->with('productVariants')
            ->with('productVariants.productSize')
            ->orderBy('name')
            ->get();

        return view('app.trials.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Trial $trial)
    {
        $trialItems = TrialItem::where('trial_id', $trial->id)
            ->with('productVariant')
            ->with('productVariant.product')
            ->get();

        return view('app.trials.show', compact('trial', 'trialItems'));
    }

    public function edit(Trial $trial): View
    {
        $customers = Customer::all();
        $products = Product::with('productVariants')
            ->with('productVariants.productSize')
            ->orderBy('name')
            ->get();

        return view('app.trials.edit', compact('trial', 'customers', 'products'));
    }

    public function update(Request $request, Trial $trial)
    {
        //
    }

    public function destroy(Trial $trial): RedirectResponse
    {
        TrialItem::where('trial_id', $trial->id)->delete();
        $trial->delete();

        return to_route('app.trials.index')->with('success', 'Condicional excluído com sucesso!');
    }
}
