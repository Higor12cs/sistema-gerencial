<?php

namespace App\Http\Controllers\Trial;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Trial;
use App\Models\TrialItem;
use Illuminate\Http\RedirectResponse;
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
            ->orderBy('name')
            ->get();

        return view('app.trials.create', compact('customers', 'products'));
    }

    public function show(Trial $trial)
    {
        $trialItems = TrialItem::where('trial_id', $trial->id)
            ->with('product')
            ->get();

        return view('app.trials.show', compact('trial', 'trialItems'));
    }

    public function edit(Trial $trial): View
    {
        $customers = Customer::all();
        $products = Product::query()
            ->with('productSize')
            ->orderBy('name')
            ->get();

        return view('app.trials.edit', compact('trial', 'customers', 'products'));
    }

    public function destroy(Trial $trial): RedirectResponse
    {
        TrialItem::where('trial_id', $trial->id)->delete();
        $trial->delete();

        return to_route('app.trials.index')->with('success', 'Condicional excluído com sucesso!');
    }
}
